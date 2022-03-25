<?php

class progressReport_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }

	function getUserData($empID){
		$sql = "SELECT systemuser.EmpID, systemuser.EmpName FROM systemuser 
		WHERE systemuser.EmpID = '$empID'";
		return $this->db->runQuery($sql);
	}

	function getTaskData($empID, $month, $status){

		if($status == NULL){
			$sql = "SELECT COUNT(*), SUM(RequiredTime) FROM task_assign 
			WHERE task_assign.AssignedTo = '$empID' 
			AND DATE_FORMAT(task_assign.AssignedTime, '%Y-%m')='$month'";
		}
		elseif(($status == "Pending") || ($status == "InProgress")){
			$sql = "SELECT COUNT(*), SUM(RequiredTime) FROM task_assign 
			WHERE task_assign.AssignedTo = '$empID' 
			AND DATE_FORMAT(task_assign.AssignedTime, '%Y-%m')<='$month' 
			AND DATE_FORMAT(task_assign.DueDate, '%Y-%m')>='$month' AND task_assign.TaskStatus = '$status'";
		}
		else{
			$sql = "SELECT COUNT(*), SUM(RequiredTime) FROM task_assign 
			WHERE task_assign.AssignedTo = '$empID' 
			AND DATE_FORMAT(task_assign.CompletedDate, '%Y-%m')='$month'";
		}
		
		return $this->db->runQuery($sql);
	}

	function getLeaveData($empID, $month, $type){
		$status = "Approved";
		if($type == NULL){
			$sql = "SELECT COUNT(*) FROM empleave
			WHERE empleave.EmpID = '$empID' 
			AND DATE_FORMAT(empleave.StartDate, '%Y-%m')<='$month' 
			AND DATE_FORMAT(empleave.EndDate, '%Y-%m')>='$month' AND empleave.LStatus = 'Approved'";
		}
		else{
			$sql = "SELECT COUNT(*) FROM empleave
			WHERE empleave.EmpID = '$empID' 
			AND DATE_FORMAT(empleave.StartDate, '%Y-%m')<='$month' 
			AND DATE_FORMAT(empleave.EndDate, '%Y-%m')>='$month' AND empleave.LStatus = 'Approved'
			AND empleave.LeaveType = '$type'";
		}

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
	
}
?>