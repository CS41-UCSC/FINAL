<?php

class Member_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }
    function getAcceptedData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='InProgress'";
        return $this->db->runQuery($sql);

    }
    function getDataA($loginuser){

        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='InProgress' && tA.AssignedTo=('$loginuser')";
        return $this->db->runQuery($sql);

    }

    function sendRemarkA($taskId,$empId,$remark){
        $sql = "INSERT INTO `remark`( `EmpID`, `TaskID`, `Remark`,`AddedDate`) VALUES ('$empId','$taskId' ,'$remark',CURRENT_TIMESTAMP)";
        return $this->db->runQuery($sql);
    }


    function getCompletedData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Completed'";
        return $this->db->runQuery($sql);
    }

    function getDataC($loginuser){

        // $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Completed' && tA.AssignedTo=('$loginuser')";
        // $sql = "SELECT t.TaskName, tA.*, s.*, sA.* FROM task t, task_assign tA, subtask s, subtask_assign sA where  t.TaskID = tA.TaskID && s.SubTaskID = sA.SubTaskID  && (sA.Status='Completed' OR tA.TaskStatus='Completed') && tA.AssignedTo=('$loginuser')";
        $sql = "SELECT t.TaskName, tA.*, sA.*, s.* FROM task t, task_assign tA, subtask_assign sA, subtask s where sA.SubTaskID = s.SubTaskID && sA.TaskID = t.TaskID &&  t.TaskID = tA.TaskID && (tA.TaskStatus='Completed' OR sA.Status='Completed') && tA.AssignedTo=('$loginuser') && tA.DueDate > tA.CompletedDate";
        return $this->db->runQuery($sql);

    }

    function sortDate($sDate,$eDate){
        // $sql = "SELECT t.TaskName, tA.*, sA.*, s.* from task t, task_assign tA, subtask_assign sA, subtask s where tA.CompletedDate between '$sDate' and '$eDate' and t.TaskID = tA.TaskID && tA.TaskStatus='Completed'";
        $sql = "SELECT t.TaskName, tA.*, sA.*, s.* from task t, task_assign tA, subtask_assign sA, subtask s where tA.CompletedDate between '$sDate' and '$eDate' and sA.SubTaskID = s.SubTaskID && sA.TaskID = t.TaskID && t.TaskID = tA.TaskID && (tA.TaskStatus='Completed' OR sA.Status='Completed')";
        return $this->db->runQuery($sql);
    }

    function getOverdueData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Approved'";
        return $this->db->runQuery($sql);
    }

    function getDataO($loginuser){

        // $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Approved' && tA.AssignedTo=('$loginuser')";
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.DueDate < tA.CompletedDate && tA.AssignedTo=('$loginuser')";
        return $this->db->runQuery($sql);

    }

    function sendRemarkO($taskId,$empId,$remark){
        $sql = "INSERT INTO `remark`( `EmpID`, `TaskID`, `Remark`,`AddedDate`) VALUES ('$empId','$taskId' ,'$remark',CURRENT_TIMESTAMP)";
        return $this->db->runQuery($sql);
    }



    function getPendingData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Pending'";
        return $this->db->runQuery($sql);
    }



    function getData($loginuser){

        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Pending' && tA.AssignedTo=('$loginuser')";
        return $this->db->runQuery($sql);

    }

    function acceptTask($taskId){
        $sql = "UPDATE task_assign SET TaskStatus='InProgress' WHERE TaskID=('$taskId') " ;
        return $this->db->runQuery($sql);

        // $sql1 = INSERT INTO `task_assign`( `AcceptedDate`) VALUES (CURRENT_TIMESTAMP) WH;
    }


    function sendRemark($taskId,$empId,$remark){
        $sql = "INSERT INTO `remark`( `EmpID`, `TaskID`, `Remark`,`AddedDate`) VALUES ('$empId','$taskId' ,'$remark', CURRENT_TIMESTAMP)";
        return $this->db->runQuery($sql);
    }

    function getDatasubTask($loginuser){
        // $sql = "SELECT * From `subtask`";
        $sql = "SELECT s.*, sA.* From subtask s,subtask_assign sA where s.SubTaskID = sA.SubTaskID && sA.Status='Pending' && sA.AssignedTo=('$loginuser') ";
        return $this->db->runQuery($sql);
    }

    // function getsubTask($taskId){
    //     $sql = "SELECT * From `subtask` where TaskID=('$taskId')";
    //     return $this->db->runQuery($sql);
    // }

    function getRemarks(){
        $sql = "SELECT * From remark";
        return $this->db->runQuery($sql);
    }
    function getInprogressSelectData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);
    }
    function getTaskData($taskid){

        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='InProgress'
        AND t.TaskID = '$taskid' ";
        return $this->db->runQuery($sql);

    }
    function getSubTaskData($taskid){

        $sql1 = "SELECT SubTaskID, SubTaskName,status FROM subtask where TaskID = '$taskid'";
        return $this->db->runQuery($sql1);

    }

    function updateSubTaskData($data){

        foreach($data as $row){
        
            $sql2 = "UPDATE subtask SET status ='Completed' WHERE SubTaskID='$row' " ;
            $this->db->query($sql2);

        }

        return true;
        
    }

    function senderID($taskId){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT task_assign.AssignedBy FROM task_assign WHERE task_assign.TaskID = '$taskId' AND task_assign.AssignedTo = '$empID'";
		return $this->db->runQuery($sql);
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

    function getDataApproved($loginuser){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Approved' && tA.AssignedTo=('$loginuser')";
        return $this->db->runQuery($sql);
    }

}
