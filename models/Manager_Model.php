<?php

class Manager_Model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAssignTasksforMember($empid)
    {
        $sql = "SELECT task.TaskID, task.TaskName, task_assign.AssignedTime, task_assign.RequiredTime, task_assign.DueDate, task_assign.TaskStatus
        FROM task_assign INNER JOIN task ON task_assign.TaskID=task.TaskID WHERE task_assign.AssignedTo= '$empid' ";

        return $this->db->runQuery($sql);
    }

    function getTaskProgressChart($empid){
        
        $sql2 ="SELECT task_assign.TaskStatus, SUM(task_assign.RequiredTime) AS totaltime FROM task_assign 
            WHERE task_assign.AssignedTo = '$empid' GROUP BY task_assign.TaskStatus ;" ;

            return $this->db->runQuery($sql2);  
    }

    function AssignTasksforMember($empid, $taskid, $desc, $ddate, $rhours)
    {

        try{

            $this->db->beginTransaction();

            $sql = "INSERT task_assign (TaskID, AssignedTo, AssignedBy, RequiredTime, DueDate, TaskStatus, Description ) 
            VALUES ('$taskid','$empid','$_SESSION[login_user]','$rhours','$ddate','Pending','$desc' )";

            $this->db->query($sql);

            $sqlgetsubtasks = "SELECT * FROM subtask WHERE TaskID= '$taskid' ";
            $result = $this->db->runQuery($sqlgetsubtasks);

            if (count($result) > 0) {

                foreach ($result as $row) {

                    $sqlassignsubtasks = "INSERT INTO `subtask_assign`(`TaskID`, `SubTaskID`, `AssignedTo`) VALUES ('$row[1]','$row[0]','$empid')";

                    $this->db->query($sqlassignsubtasks);
                }
            }
            $this->db->commit();
            return true;

         }
         catch(Exception $e){

            $this->db->rollback();
            return false;

         }
    }
}

/*
 //try{
            //$this->db->beginTransaction();

            $sql1 = "INSERT task_assign (TaskID, AssignedTo, AssignedBy, RequiredTime, DueDate, TaskStatus, ) 
            VALUES ('$taskid','$empid','$_SESSION[login_user]','$rhours','$ddate','Pending' )";

            $this->db->query($sql1);

            //f$sql2 = "UPDATE task SET Description = '$desc' WHERE TaskID= '$taskid' ";

            //$this->db->query($sql2);

            $sqlgetsubtasks = "SELECT * FROM subtask WHERE TaskID= '$taskid' ";

            $result = $this->db->runQuery($sqlgetsubtasks);

            if(count($result) > 0 ){

                foreach ($result as $row){
                    
                    $sqlassignsubtasks = "INSERT INTO `subtask_assign`(`TaskID`, `SubTaskID`, `AssignedTo`) VALUES ('$row[1]','$row[0]','$empid')" ;

                    $this->db->query($sqlassignsubtasks);
                }
            }

            return true;
       // }

        //catch(PDOException $e){

            //$this->db->rollback();
            //return false;
       // }    

*/