<?php

class leave_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }
	
	function getmyLeave($status,$month){
		$empID = $_SESSION['login_user'];
		$sql="SELECT LeaveID, LeaveType, StartDate, EndDate, LStatus FROM empLeave 
		WHERE EmpID='$empID' AND LStatus='$status' AND DATE_FORMAT(StartDate, '%Y-%m')='$month'";
		return $this->db->runQuery($sql);
	}

	function getApprovedCount($type,$year){
		$empID = $_SESSION['login_user'];
		$status = "Approved";
		$sql="SELECT SUM(EndDate - StartDate + 1) FROM empLeave WHERE EmpID='$empID' 
		AND LStatus='$status' AND LeaveType='$type' AND DATE_FORMAT(StartDate, '%Y')='$year'";
		return $this->db->runQuery($sql);
	}
	
	function insert($start, $end, $leavetype){
		$empID = $_SESSION['login_user'];
		$status = "Pending";
		$sql="INSERT INTO empleave (StartDate,EndDate,LeaveType,LStatus,EmpID) 
		VALUES ('$start','$end','$leavetype','$status','$empID')";
		return $this->db->runQuery($sql);	
	}
	
	function delete($leaveId){
		$empID = $_SESSION['login_user'];
		$status = "Pending";
		$sql="DELETE FROM empleave WHERE LeaveID='$leaveId'";
		return $this->db->runQuery($sql);
	}

	function getLeaveRowCount(){
		$sql="SELECT MAX(`LeaveID`) FROM empleave";
		return $this->db->runQuery($sql);
	}

	function setAutoIncrement($number){
		$sql="ALTER TABLE `empleave` AUTO_INCREMENT = $number";
		return $this->db->runQuery($sql);
	}

	function getdeptLeave($status, $leaveId, $month){
		$empID = $_SESSION['login_user'];
		if($leaveId == NULL){
		$sql="SELECT empleave.LeaveID, empleave.EmpID, empleave.LeaveType, empleave.StartDate, empleave.EndDate, empleave.LStatus 
		FROM empleave, team_member, dept_manager, team 
		WHERE empleave.EmpID = team_member.EmpID 
		AND team_member.TeamID = team.TeamID AND team.DeptID = dept_manager.DeptID 
		AND dept_manager.EmpID = '$empID' AND empleave.LStatus='$status'
		AND DATE_FORMAT(empleave.StartDate, '%Y-%m')='$month'";
		}
		else{
		$sql="SELECT empleave.LeaveID, empleave.EmpID, empleave.LeaveType, empleave.StartDate, 
		empleave.EndDate, empleave.LStatus, systemuser.EmpName  
		FROM empleave, team_member, dept_manager, team, systemuser 
		WHERE empleave.EmpID = team_member.EmpID 
		AND empleave.EmpID = systemuser.EmpID 
		AND team_member.TeamID = team.TeamID AND team.DeptID = dept_manager.DeptID 
		AND dept_manager.EmpID = '$empID' AND empleave.LStatus='$status' AND empleave.LeaveID='$leaveId'";
		}
		return $this->db->runQuery($sql);
	}

	function getTeamLeave($status, $month){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT empleave.EmpID, empleave.LeaveID, empleave.LeaveType, empleave.StartDate, 
		empleave.EndDate, empleave.LStatus FROM empleave, team_member, team_leader 
		WHERE team_leader.EmpID = '$empID' AND team_leader.TeamID = team_member.TeamID 
		AND team_member.EmpID = empleave.EmpID AND empleave.LStatus = '$status' 
		AND DATE_FORMAT(empleave.StartDate, '%Y-%m')='$month'";
		return $this->db->runQuery($sql);
	}

	function getEmpLeave($status, $month){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT empleave.EmpID, empleave.LeaveID, empleave.LeaveType, empleave.StartDate, 
		empleave.EndDate, empleave.LStatus FROM empleave WHERE empleave.LStatus = '$status' 
		AND DATE_FORMAT(empleave.StartDate, '%Y-%m')='$month'";
		return $this->db->runQuery($sql);	
	}

	function getApprovedTeamCount($status,$year){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT team.TeamName, COUNT(empleave.LeaveID) FROM empLeave, team_member, dept_manager, team 
		WHERE empleave.EmpID = team_member.EmpID
        AND team_member.TeamID = team.TeamID AND team.DeptID = dept_manager.DeptID 
        AND dept_manager.EmpID = '$empID'
		AND LStatus='$status' AND DATE_FORMAT(empleave.StartDate, '%Y')='$year'
        GROUP BY team.TeamName";
		return $this->db->runQuery($sql);
	}

	function setLeaveStatus($leaveId,$status){
		$empID = $_SESSION['login_user'];
		$date = date("Y-m-d");
		$sql = "UPDATE empleave SET LStatus = '$status', ApprovedBy = '$empID', ApprovedDate = '$date'
		WHERE LeaveID = '$leaveId'";
		return $this->db->runQuery($sql);
	}

	function getTaskData($empID, $date, $status){
		$sql = "SELECT COUNT(*) FROM task_assign 
		WHERE task_assign.AssignedTo = '$empID' 
		AND DATE_FORMAT(task_assign.AssignedTime, '%Y-%m-%d')<='$date' 
		AND DATE_FORMAT(task_assign.DueDate, '%Y-%m-%d')>='$date' AND task_assign.TaskStatus = '$status'";
		
		return $this->db->runQuery($sql);
	}

	function deptManagerID(){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT dept_manager.EmpID FROM dept_manager, team_member, team 
		WHERE team_member.EmpID = '$empID' AND team_member.TeamID = team.TeamID AND team.DeptID = dept_manager.DeptID";
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
	
}
?>