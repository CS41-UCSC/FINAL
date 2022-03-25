<?php

class progressReport extends Controller{
	
	function __construct()
	{
		parent::__construct();
		session_start();
	}
	
	function index(){
		$this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

		

		$this->view->render('progressReport');
	}
	
}

?>