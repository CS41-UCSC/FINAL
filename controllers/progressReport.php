<?php

class progressReport extends Controller{
	
	function __construct()
	{
		parent::__construct();
		session_start();

		$date = date_create();
		$this->current_month = date_format($date, "Y-m");

		$this->annual = 14;
		$this->casual = 4;
		$this->sick = 10;

		if(!(isset($_SESSION['login_user']))){
			header('location: http://localhost/FINAL/login');
		}
		
	}
	
	function index(){

		if($_SESSION['hraccess']==0){
			echo "<script>alert('No Access provided for the requested Page');</script>";
			echo '<script> history.back();</script>';
		}

		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

		$empID = $_GET['ID'];
		$this->view->userdata = $this->model->getUserData($empID);
		$this->view->assignedTask = $this->model->getTaskData($empID, $this->current_month, NULL);
		$this->view->pendingTask = $this->model->getTaskData($empID, $this->current_month, "Pending");
		$this->view->inprogressTask = $this->model->getTaskData($empID, $this->current_month, "InPRogress");
		$this->view->completedTask = $this->model->getTaskData($empID, $this->current_month, "Completed");
		$this->view->approvedLeaves = $this->model->getLeaveData($empID, $this->current_month, NULL);
		$this->view->remainingLeaves['sick'] = $this->sick - $this->model->getLeaveData($empID, $this->current_month, "Sick")[0][0];
		$this->view->remainingLeaves['annual'] = $this->annual - $this->model->getLeaveData($empID, $this->current_month, "Annual")[0][0];
		$this->view->remainingLeaves['casual'] = $this->casual - $this->model->getLeaveData($empID, $this->current_month, "Casual")[0][0];

		$this->view->render('progressReport');
	}
	
}

?>