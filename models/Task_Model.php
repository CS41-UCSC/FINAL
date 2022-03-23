<?php

class Task_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function getTask($empId){

        //echo $_SESSION['emprole'];

        //$sql = "SELECT tk.TeamID, tm.TeamName, tk.TaskName FROM Task tk, Team tm  WHERE tk.TeamID  IN ( SELECT teamID FROM Team WHERE DeptID IN ( SELECT DeptID FROM dept_manager WHERE EmpID =  '$empId' ) ) ; ";

        /* 

        */
        if($_SESSION['emprole'] == "Dept_Manager"){

            $sql1 = "SELECT DeptID FROM dept WHERE Dept_Manager = ('$empId') ;";
            $dept= $this->db->runQuery($sql1);

            $dept_ID = $dept[0]['DeptID'];

            //$sql = "SELECT tk.TeamID, tm.TeamName, tk.TaskName FROM Team tm INNER JOIN Task tk ON tk.TeamID = tm.TeamID  WHERE tm.DeptID = ('$dept_ID')  ; " ;
            
            $sql = "SELECT tk.TeamID, tm.TeamName, tk.TaskName, tk.TaskID FROM Team tm INNER JOIN Task tk ON tk.TeamID = tm.TeamID  
            WHERE tm.DeptID = ('$dept_ID') AND NOT EXISTS  (select 1 FROM task_assign ts WHERE ts.TaskID = tk.TaskID) ORDER BY tm.TeamName; " ;

            return $this->db->runQuery($sql);

        }

        else if($_SESSION['emprole'] == "Team_Leader"){

            $sql1 = "SELECT TeamID FROM team_leader WHERE EmpID = ('$empId') ;";
            $dept= $this->db->runQuery($sql1);

            //get team id

            $team_ID = $dept[0]['TeamID'];

            $sql = "SELECT tk.TeamID,tm.TeamName, tk.TaskName, tk.TaskID FROM Team tm INNER JOIN Task tk ON tk.TeamID = tm.TeamID 
            WHERE tm.TeamID = ('$team_ID') AND NOT EXISTS  (select 1 FROM task_assign ts WHERE ts.TaskID = tk.TaskID)" ;

            //send remaining task array to controller
           
            return $this->db->runQuery($sql);
        }
        /*
        */

        /*$sql1 = "SELECT DeptID FROM dept WHERE Dept_Manager = ('$empId') ;";
        $dept= $this->db->runQuery($sql1);

        $dept_ID = $dept[0]['DeptID'];

        //$sql = "SELECT tk.TeamID, tm.TeamName, tk.TaskName FROM Team tm INNER JOIN Task tk ON tk.TeamID = tm.TeamID  WHERE tm.DeptID = ('$dept_ID')  ; " ;
        $sql = "SELECT tk.TeamID, tm.TeamName, tk.TaskName, tk.TaskID FROM Team tm INNER JOIN Task tk ON tk.TeamID = tm.TeamID  
        WHERE tm.DeptID = ('$dept_ID') AND NOT EXISTS  (select 1 FROM task_assign ts WHERE ts.TaskID = tk.TaskID) ORDER BY tm.TeamName; " ;

        return $this->db->runQuery($sql);*/

    }

    function getTeam($empID){

        if($_SESSION['emprole'] == "Dept_Manager"){

            $sql1 = "SELECT DeptID FROM dept WHERE Dept_Manager = ('$empID') ;";
            $dept= $this->db->runQuery($sql1);

            $dept_ID = $dept[0]['DeptID'];

            $sql2 = "SELECT T.TeamID, T.TeamName, L.EmpID, S.EmpName FROM team T INNER JOIN team_leader L ON T.TeamID = L.TeamID INNER JOIN 
            systemuser S ON S.EmpID = L.EmpID WHERE T.DeptID = ('$dept_ID')  ; " ;

            return $this->db->runQuery($sql2);

        }

        else if($_SESSION['emprole'] == "Team_Leader"){

            $sql = "SELECT TeamID FROM team_leader WHERE team_leader.EmpID = ('$empID') ";

            return $this->db->runQuery($sql);

        }

    }

    function getTaskProgress($teamid,$startdate,$enddate){

        /*$sql="SELECT T.TaskName,  T.TaskID,  TA.*, COUNT(RM.TaskID) AS remarks FROM Task T LEFT JOIN Task_Assign TA ON TA.TaskID = T.TaskID 
        LEFT JOIN Remark RM ON RM.EmpID = TA.AssignedTo WHERE T.TeamID = '$teamid'
        AND TA.DueDate BETWEEN '$startdate' AND '$enddate' GROUP BY TA.TaskID, TA.AssignedTo  ORDER BY TA.DueDate DESC ";*/

        $sql="SELECT T.TaskName,  T.TaskID,  TA.* FROM Task T LEFT JOIN Task_Assign TA ON TA.TaskID = T.TaskID WHERE T.TeamID = '$teamid'
        AND TA.DueDate BETWEEN '$startdate' AND '$enddate'  ORDER BY TA.DueDate DESC ";

        return $this->db->runQuery($sql);
    }

    function getTeamProgress($startdate,$enddate){

        if($_SESSION['emprole'] == "Dept_Manager"){

            $sql = "SELECT systemuser.EmpID , SUM(task_assign.RequiredTime ) AS totaltime FROM systemuser LEFT JOIN task_assign ON 
            systemuser.EmpID=task_assign.AssignedTo WHERE systemuser.EmpID = ANY ( SELECT team_member.EmpID FROM team_member INNER JOIN team ON 
            team_member.TeamID = team.TeamID INNER JOIN dept ON team.DeptID = dept.DeptID WHERE dept.Dept_Manager = '$_SESSION[login_user]' 
            OR (SELECT team_leader.EmpID FROM `team_leader` INNER JOIN `team` ON team_leader.TeamID = team.TeamID INNER JOIN `dept` 
            ON team.DeptID = dept.DeptID WHERE dept.Dept_Manager = '$_SESSION[login_user]'  AND NOT EXISTS  
            (SELECT systemuser.EmpID FROM `systemuser` WHERE systemuser.EmpRole = 'Dept_Manager' )) ) GROUP BY systemuser.EmpID ;" ;

            return $this->db->runQuery($sql);
        }

        else if($_SESSION['emprole'] == "Team_Leader" ){
    
            $sql = "SELECT systemuser.EmpID , 
            SUM(CASE WHEN task_assign.DueDate BETWEEN '".$startdate."' AND  '".$enddate."'  THEN task_assign.RequiredTime ELSE 0 END ) AS totaltime 
            FROM systemuser LEFT JOIN task_assign ON 
            systemuser.EmpID=task_assign.AssignedTo WHERE systemuser.EmpID = ANY ( (SELECT team_member.EmpID FROM team_member INNER JOIN team ON 
            team_member.TeamID = team.TeamID WHERE team.TeamID = (SELECT TeamID FROM team_leader WHERE EmpID = '$_SESSION[login_user]' ) )
            UNION (SELECT team_leader.EmpID FROM `team_leader` INNER JOIN `team` ON team_leader.TeamID = team.TeamID 
            WHERE team.TeamID = (SELECT TeamID FROM team_leader WHERE EmpID = '$_SESSION[login_user]' )  EXCEPT  
            (SELECT systemuser.EmpID FROM `systemuser` WHERE systemuser.EmpID = '$_SESSION[login_user]' )) ) GROUP BY systemuser.EmpID ;" ;

            return $this->db->runQuery($sql);

        }

        else if($_SESSION['emprole'] == "Team_Member"){

            $sql = "SELECT systemuser.EmpID , SUM(task_assign.RequiredTime ) AS totaltime FROM systemuser LEFT JOIN task_assign ON 
            systemuser.EmpID=task_assign.AssignedTo WHERE systemuser.EmpID = ANY ( (SELECT team_member.EmpID FROM team_member INNER JOIN team ON 
            team_member.TeamID = team.TeamID WHERE team.TeamID = (SELECT TeamID FROM team_member WHERE EmpID = '$_SESSION[login_user]' ) )
            UNION (SELECT team_leader.EmpID FROM `team_leader` INNER JOIN `team` ON team_leader.TeamID = team.TeamID 
            WHERE team.TeamID = (SELECT TeamID FROM team_member WHERE EmpID = '$_SESSION[login_user]' ) ) EXCEPT  
            (SELECT systemuser.EmpID FROM `systemuser` WHERE systemuser.EmpID = '$_SESSION[login_user]' ) ) GROUP BY systemuser.EmpID ;" ;

            return $this->db->runQuery($sql);

        }

        /*else if($_SESSION['emprole'] == "Team_Leader" || $_SESSION['emprole'] == "Team_Member"){


            $sql = "SELECT task_assign.AssignedTo, SUM(task_assign.RequiredTime ) AS totaltime FROM task_assign 
            INNER JOIN task ON task_assign.TaskID = task.TaskID INNER JOIN team ON task.TeamID = team.TeamID 
            INNER JOIN team_member ON team.TeamID = team_member.TeamID WHERE team_member.EmpID = '$_SESSION[login_user]'GROUP BY task_assign.AssignedTo ;" ;

            return $this->db->runQuery($sql);

        }*/

    }

    function getEmployeeProgress($eid){

        $startdate = date('Y-m-01');
        $enddate = date('Y-m-t');

        $sql = "SELECT task.TaskName, task_assign.AssignedTo, task_assign.RequiredTime, task_assign.DueDate, task_assign.TaskStatus 
        FROM task_assign INNER JOIN task ON task_assign.TaskID = task.TaskID WHERE task_assign.AssignedTo = '$eid' AND 
        TA.DueDate BETWEEN '$startdate' AND '$enddate'";

        return $this->db->runQuery($sql);
    }

    function insertTask(){

        $id = $_POST['tid'];
        $name = $_POST['tname'];

        $sql = "INSERT INTO task (TeamID, TaskName) VALUES ('$id', '$name')" ;

        if ($this->db->query($sql) == TRUE) {
            $_SESSION['addTask'] = "yes";
          } else {
            $_SESSION['addTask'] = "no";
        }

        $gettaskid = "SELECT TaskID FROM task WHERE TaskName='$name' ";
        $taskid = $this->db->runQuery($gettaskid);

        $tid = $taskid[0][0];

        $a = array();
        $sub1 = $_POST['sub1'];
        $sub2 = $_POST['sub2'];
        $sub3 = $_POST['sub3'];
        $sub4 = $_POST['sub4'];
        array_push($a,$sub1,$sub2,$sub3,$sub4);
        
        
        for ($i = 0; $i <4; $i++){

            if($a[$i]){
                
                //echo $a[$i];

                $sql = "INSERT INTO subtask (TaskID, SubTaskName) VALUES ('$tid', '$a[$i]')" ;
    
                if ($this->db->query($sql) == TRUE) {
                    $_SESSION['addTask'] = "yes";
                } else {
                    $_SESSION['addTask'] = "no";
                }
                
            }
            

        }
                
    }


    function leaderInsertTask(){

        $getteamidsql = "SELECT TeamID FROM team_leader WHERE EmpID= ('$_SESSION[login_user]') ";
        $idarray = $this->db->runQuery($getteamidsql);
        $id = $idarray[0][0];
        
        $name = $_POST['tname'];

        $sql = "INSERT INTO task (TeamID, TaskName) VALUES ('$id', '$name')" ;

        if ($this->db->query($sql) == TRUE) {
            $_SESSION['addTask'] = "yes";
          } else {
            $_SESSION['addTask'] = "no";
        }

        $gettaskid = "SELECT TaskID FROM task WHERE TaskName='$name' ";
        $taskid = $this->db->runQuery($gettaskid);

        $tid = $taskid[0][0];

        $a = array();
        $sub1 = $_POST['sub1'];
        $sub2 = $_POST['sub2'];
        $sub3 = $_POST['sub3'];
        $sub4 = $_POST['sub4'];
        array_push($a,$sub1,$sub2,$sub3,$sub4);
        
        
        for ($i = 0; $i <4; $i++){

            if($a[$i]){
                
                //echo $a[$i];

                $sql = "INSERT INTO subtask (TaskID, SubTaskName) VALUES ('$tid', '$a[$i]')" ;
    
                if ($this->db->query($sql) == TRUE) {
                    $_SESSION['addTask'] = "yes";
                } else {
                    $_SESSION['addTask'] = "no";
                }
                
            }
            

        }

    }

    function EditTask($tid,$tteam,$ttitle){

        $sql = "UPDATE task SET TeamID='$tteam', TaskName='$ttitle' WHERE TaskID='$tid' ";

        if ($this->db->query($sql) == TRUE) {
            return true;
          } else {
            return false;
          }
    }

    function DeleteTask($tid){

        $sql = "DELETE FROM task WHERE TaskID='$tid' ";

        if ($this->db->query($sql) == TRUE) {
            return true;
          } else {
            return false;
          }
    }

    function showsubtaskview($taskid){

        $sql = "SELECT SubTaskName FROM subtask WHERE TaskID = '$taskid' ";
        return $this->db->runQuery($sql);
    }

    function editAssignTask($id,$assignedmember,$rtime,$ddate,$stts){

        $sql = "UPDATE task_assign SET RequiredTime='$rtime' , DueDate='$ddate'  , TaskStatus='$stts' WHERE TaskID='$id' AND AssignedTo = '$assignedmember' ";

        if ($this->db->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }

    }

    function getTaskRemarksCounts($startdate,$enddate){

        $sql = "SELECT TaskID, EmpID, count(EmpID) FROM remark WHERE RStatus= '' GROUP BY TaskID, EmpID";

        return $this->db->runQuery($sql);

    }

    function getTaskRemarks($empid,$taskid){

        $sql = "SELECT * FROM remark WHERE TaskID='$taskid' AND EmpID='$empid' ";

        return $this->db->runQuery($sql);
    }

    function editTaskRemarks($id,$st){
        
        $sql = "UPDATE remark SET RStatus='$st' WHERE RemarkID='$id'";

        if ($this->db->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }
    
    }

    function getSubTasks($taskid,$assignedmember){

        //$sql = "SELECT COUNT(CASE WHEN subtask.status = 'Completed' THEN 1 END) AS completed, COUNT (TaskID) FROM subtask WHERE TaskID = '$taskid' " ;

        /*$sql = "SELECT TaskID, SubTaskName, COUNT(SubTaskID) as tasks, COUNT(CASE WHEN subtask.status = 'Completed' THEN 1 END) AS completed
        FROM subtask GROUP BY TaskID  " ;*/

        $sql = "SELECT SubTaskName, Status FROM subtask INNER JOIN subtask_assign 
        ON subtask.SubTaskID = subtask_assign.SubTaskID WHERE (subtask_assign.TaskID = '$taskid' AND subtask_assign.AssignedTO = '$assignedmember') ";

        return $this->db->runQuery($sql);
    }

    function getAssignTasksforMember($empid){
        $sql = "SELECT task.TaskName, task_assign.AssignedTime, task_assign.RequiredTime, task_assign.DueDate, task_assign.TaskStatus
        FROM task_assign INNER JOIN task ON task_assign.TaskID=task.TaskID WHERE task_assign.AssignedTo= '$empid' ";

        return $this->db->runQuery($sql);
    }

    function AssignTasksforMember($empid, $taskid, $ddate, $rhours)
    {

        //$date = date('d-m-y h:i:s');

        $sql = "INSERT task_assign (TaskID, AssignedTo, AssignedBy, RequiredTime, DueDate, TaskStatus ) 
        VALUES ('$taskid','$empid','$_SESSION[login_user]','$rhours','$ddate','Pending' )";

        $sqlgetsubtasks = "SELECT * FROM subtask WHERE TaskID= '$taskid' ";
        $result = $this->db->runQuery($sqlgetsubtasks);

        if(count($result) > 0 ){

            foreach ($result as $row){
                
                $sqlassignsubtasks = "INSERT INTO `subtask_assign`(`TaskID`, `SubTaskID`, `AssignedTo`) VALUES ('$row[1]','$row[2]','$empid')" ;

                $this->db->query($sqlassignsubtasks);
            }
            
           /* if ($this->db->query($sql) == TRUE) {
                return true;
            } else {
                return false;
            }*/
        }

        
    }
}
