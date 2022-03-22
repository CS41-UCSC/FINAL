<?php

class leave extends Controller{
	
	function __construct(){
		parent::__construct();
		session_start();
		$this->view->annual = 14;
		$this->view->casual = 4;
		$this->view->sick = 10;

		$date = date_create();
		$this->cur_month = date_format($date, "Y-m");
		$this->cur_year = date_format($date, "Y");
		
	}
	
	function index(){
		// $this->view->render('empLeave');
	}
	
	function myleaveApproved(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		$status = "Approved";
		
		if (isset($_POST['filterbtn'])){
			$this->view->data = $this->model->getmyLeave($status,$_POST['month']);
			$this->view->month_val = $_POST['month'];
			$filter_date = date_create($_POST['month'].="-01");
			$year = date_format($filter_date, "Y");
			$this->view->taken_annual = $this->model->getApprovedCount("Annual",$year);
			$this->view->taken_casual = $this->model->getApprovedCount("Casual",$year);
			$this->view->taken_sick = $this->model->getApprovedCount("Sick",$year);
		}
		else{
			$this->view->data = $this->model->getmyLeave($status,$this->cur_month);
			$this->view->month_val = $this->cur_month;
			$this->view->taken_annual = $this->model->getApprovedCount("Annual",$this->cur_year);
			$this->view->taken_casual = $this->model->getApprovedCount("Casual",$this->cur_year);
			$this->view->taken_sick = $this->model->getApprovedCount("Sick",$this->cur_year);
		}
		$this->view->render('myleaveApproved');
	}
	
	function myleavePending(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		
		$status = "Pending";
		if(isset($_GET['ID'])){
			$return1 = $this->model->delete($_GET['ID']);
			$lastval = $this->model->getLeaveRowCount();
			$val = $lastval[0][0];
			$number = 1;
			if($val == NULL){
				$number = 1;
			}
			else{
				$number = $val + 1;
			}
			$return2 = $this->model->setAutoIncrement($number);

			echo "<script>alert('Request Cancelled Successfully')</script>";
		}

		if (isset($_POST['filterbtn'])){
			$this->view->data = $this->model->getmyLeave($status,$_POST['month']);
			$this->view->month_val = $_POST['month'];
			$this->view->render('myleavePending');
		}
		else{
			$this->view->data = $this->model->getmyLeave($status,$this->cur_month);
			$this->view->month_val = $this->cur_month;
			$this->view->render('myleavePending');
		}
		// $this->view->render('myleavePending');
	}
	
	function myleaveRequest(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

		$this->taken_annual = $this->model->getApprovedCount("Annual",$this->cur_year);
		$this->taken_casual = $this->model->getApprovedCount("Casual",$this->cur_year);
		$this->taken_sick = $this->model->getApprovedCount("Sick",$this->cur_year);
		$this->deptManID = $this->model->deptManagerID();
		$this->dept_ManID = $this->deptManID['0']['0'];
		
		$this->taken_Annual = 0;
		$this->taken_Casual = 0;
		$this->taken_Sick = 0;

		if(!empty($this->taken_annual)){
			if($this->taken_annual['0']['0']==NULL){
				$taken_Annual = 0;
			}
			else{
				$taken_Annual = $this->taken_annual['0']['0'];
			}
		}

		if(!empty($this->taken_casual)){
			foreach($this->taken_casual as $count){
				if($count['0']==NULL){
					$taken_Casual = 0;
				}
				else{
					$taken_Casual = $count['0'];
				}
			}
		}

		if(!empty($this->taken_sick)){
			foreach($this->taken_sick as $count){
				if($count['0']==NULL){
					$taken_Sick = 0;
				}
				else{
					$taken_Sick = $count['0'];
				}
			}
		}

		if(isset($_POST['request_submit'])){
			if((!empty($_POST["start"]))&&(!empty($_POST["end"]))&&(!empty($_POST["leavetype"]))){

				if($_POST["end"] < $_POST["start"]){
					echo "<script>alert('Invalid End date')</script>";
				}
				else{
					if($_POST["leavetype"]=="Annual"){
						if(($this->taken_Annual)==($this->view->annual)){
							echo "<script>alert('Maximum Annual Leave count reached')</script>";
						}
						else{
							$this->model->insert($_POST["start"],$_POST["end"],$_POST["leavetype"]);
							$msg = 'Annual Leave Request from '.$_SESSION['login_user'] ;
							$this->model->notify($msg,"Leave",$this->dept_ManID);
							echo "<script>alert('Requested Successfully')</script>";
						}
					}
					elseif($_POST["leavetype"]=="Casual"){
						if(($this->taken_Casual)==($this->view->casual)){
							echo "<script>alert('Maximum Casual Leave count reached')</script>";
						}
						else{
							$this->model->insert($_POST["start"],$_POST["end"],$_POST["leavetype"]);
							$msg = 'Casual Leave Request from '.$_SESSION['login_user'] ;
							$this->model->notify($msg,"Leave",$this->dept_ManID);
							echo "<script>alert('Requested Successfully')</script>";
						}
					}
					else{
						if(($this->taken_Sick)==($this->view->sick)){
							echo "<script>alert('Maximum Sick Leave count reached')</script>";
						}
						else{
							$this->model->insert($_POST["start"],$_POST["end"],$_POST["leavetype"]);
							$msg = 'Sick Leave Request from '.$_SESSION['login_user'] ;
							$this->model->notify($msg,"Leave",$this->dept_ManID);
							echo "<script>alert('Requested Successfully')</script>";
						}
					}
				}
			}
			else{
				echo "<script>alert('Empty Fields')</script>";
			}
		}
		$this->view->render('myleaveRequest');
	}
	
	function dptleaveApproved(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		$status = "Approved";

		if (isset($_POST['filterbtn'])){
			$this->view->data = $this->model->getdeptLeave($status,NULL,$_POST['month']);
			$this->view->month_val = $_POST['month'];
		}
		else{
			$this->view->data = $this->model->getdeptLeave($status,NULL,$this->cur_month);
			$this->view->month_val = $this->cur_month;
		}
		$teamResult = $this->model->getApprovedTeamCount($status,$this->cur_year);
		$teamName = array();
		$approvedCount = array();
		if(!empty($teamResult)){
			foreach($teamResult as $result){
				array_push($teamName,$result[0]);
				array_push($approvedCount,$result[1]);
			}
		}
		else{
			array_push($teamName,"No Data Available");
			array_push($approvedCount,'0');
		}
		$this->view->teamName = $teamName;
		$this->view->approvedCount = $approvedCount;
		$this->view->render('dptleaveApproved');
	}
	
	function dptleavePending(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		$status = "Pending";

		if (isset($_POST['filterbtn'])){
			$this->view->data = $this->model->getdeptLeave($status,NULL,$_POST['month']);
			$this->view->month_val = $_POST['month'];
		}
		else{
			$this->view->data = $this->model->getdeptLeave($status,NULL,$this->cur_month);
			$this->view->month_val = $this->cur_month;
		}
		$this->view->render('dptleavePending');
	}
	
	function dptleavePendingview(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		$status = "Pending";
		$leaveID = $_GET['ID'];
		$this->view->data = $this->model->getdeptLeave($status,$leaveID,$this->cur_month);
		$leavetype = $this->view->data['0']['LeaveType'];
		$date = $this->view->data['0']['StartDate'] . ' to ' .$this->view->data['0']['EndDate'];

		if(isset($_POST['approvebtn'])){
			$return = $this->model->setLeaveStatus($leaveID,"Approved");
				echo "<script>alert('Leave Request Approved Successfully')</script>";
				$msg = "$leavetype Leave Request from $date is Approved";
				$this->model->notify($msg,"Leave",$this->view->data['0']['EmpID']);
				echo "<script>alert('Notification Sent Successfully')</script>";
			// else{
			// 	echo "<script>alert('Leave Request Approval Unsuccessfull')</script>";
			// }
			echo '<script> window.location.replace("http://localhost/Co-WMS/leave/dptleavePending"); </script>';
		}
		elseif(isset($_POST['declinebtn'])){
			$return = $this->model->setLeaveStatus($leaveID,"Declined");
				echo "<script>alert('Leave Request Declined Successfully')</script>";
				$msg = "$leavetype Leave Request from $date is Declined";
				$this->model->notify($msg,"Leave",$this->view->data['0']['EmpID']);
				echo "<script>alert('Notification Sent Successfully')</script>";
			// else{
			// 	echo "<script>alert('Leave Request Decline Unsuccessfull')</script>";
			// }
			echo '<script> window.location.replace("http://localhost/Co-WMS/leave/dptleavePending"); </script>';
		}
		else{
			$this->view->render('dptleavePendingview');
		}
	}
	
	function empLeave(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		$this->view->render('empLeave');
	}
	
	function teamLeave(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
		$this->view->render('teamLeave');
	}
	
}
?>