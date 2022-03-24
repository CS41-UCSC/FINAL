<?php

class Manager_Model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAssignTasksforMember($empid)
    {

        $startdate = date('Y-m-01'); 
        $enddate  = date('Y-m-t');

        $sql = "SELECT task.TaskID, task.TaskName, task_assign.AssignedTime, task_assign.RequiredTime, task_assign.DueDate, task_assign.TaskStatus
        FROM task_assign INNER JOIN task ON task_assign.TaskID=task.TaskID WHERE task_assign.AssignedTo= '$empid' AND 
        task_assign.DueDate BETWEEN '$startdate' AND '$enddate' ORDER BY task_assign.DueDate DESC";

        return $this->db->runQuery($sql);
    }

    function getAllAssignTasksforMember($empid){

        $sql = "SELECT task.TaskID, task.TaskName, task_assign.AssignedTime, task_assign.RequiredTime, task_assign.DueDate, task_assign.TaskStatus
        FROM task_assign INNER JOIN task ON task_assign.TaskID=task.TaskID WHERE task_assign.AssignedTo= '$empid' ";

        return $this->db->runQuery($sql);

    }

    function getTaskProgressChart($empid)
    {

        $date = date("Y/m/d");
        $ts = strtotime($date);
        $startdate = date('Y-m-01',$ts);
        $enddate = date('Y-m-t' ,$ts);


        $sql2 = "SELECT task_assign.TaskStatus, SUM(task_assign.RequiredTime) AS totaltime FROM task_assign 
            WHERE task_assign.AssignedTo = '$empid' AND DueDate BETWEEN '$startdate' AND '$enddate' GROUP BY task_assign.TaskStatus ;";

        return $this->db->runQuery($sql2);
    }

    function AssignTasksforMember($empid, $taskid, $desc, $ddate, $rhours)
    {

        try {

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
        } catch (Exception $e) {

            $this->db->rollback();
            return false;
        }
    }

    function getLeaves($empid)
    {

        $sql = "SELECT StartDate, EndDate FROM empleave WHERE EmpID = '$empid' AND LStatus='Approved' ";
        $result = $this->db->runQuery($sql);
        return $result;
    }

    function DeleteAssignTask($taskid, $empid)
    {

        $sql = "DELETE FROM task_assign WHERE TaskID='$taskid' AND AssignedTO='$empid' ";
        if ($this->db->query($sql) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function getmembersskills($memberID){

       $sql = "SELECT EmpID, skill_name, percent FROM star_rate WHERE EmpID='$memberID' ";

       $res = $this->db->runQuery($sql);

       return $res;
       
    }

    function notify($msg,$type,$receiver){
		$empID = $_SESSION['login_user'];
		$sql = "INSERT INTO notification (Notification,Notype,SentDT,NotStatus,Sender,Receiver)
		VALUES ('$msg','$type',CURRENT_TIMESTAMP,'Pending','$empID','$receiver')";
		return $this->db->runQuery($sql);
	}

    function getNotifications(){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT NotID, Notification, Notype FROM notification 
		WHERE Receiver = '$empID' AND NotStatus = 'Pending' LIMIT 5";
		return $this->db->runQuery($sql);
	}

	function getNotificationCount(){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT COUNT(*) FROM notification 
		WHERE Receiver = '$empID' AND NotStatus = 'Pending'";
		return $this->db->runQuery($sql);
	}

    function notificationEmail($msg,$empID){
        
		$sql = "SELECT EmpName, EmpEmail FROM systemuser WHERE EmpID = '$empID'";
		$result = $this->db->runQuery($sql);
		$empName = $result['0']['EmpName'];
		$empEmail = $result['0']['EmpEmail']; 

		$mail_subject = "Notification from Co-WMS";
		$email_body = "Dear {$empName},\n";
		$email_body .= $msg;
		$from = "From: cowmsofficial@gmail.com";

		$mail_result = mail($empEmail, $mail_subject, $email_body, $from);
		
		if($mail_result){
			return true;
		}
		else{
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