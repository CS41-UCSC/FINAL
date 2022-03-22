<?php

class notification_Model extends Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getdata($NotID){
		$sql="SELECT * FROM notification WHERE NotID = '$NotID'";
		return $this->db->runQuery($sql);
	}
	
	function getSenderRole($empID){
		$sql="SELECT EmpRole FROM systemuser WHERE EmpID = '$empID'";
		return $this->db->runQuery($sql);
	}

	function changeNotStatus($NotID){
		$sql = "UPDATE notification SET NotStatus = 'Accessed', AccessedDT = CURRENT_TIMESTAMP 
		WHERE NotID = '$NotID'";
		return $this->db->runQuery($sql);
	}

}

?>