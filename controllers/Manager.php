<?php

include_once('controllers/team.php');

class Manager extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }

    function showpage_assignTasksMember(){
        
        $team = new Team();

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->teamTasks = $team->getTaskSet($_SESSION['memberteamID']);
        $this->view->leave = $this->model->getLeaves($_SESSION['memberID']);
        $this->view->tasks = $this->model->getAssignTasksforMember($_SESSION['memberID']);
        $this->view->alltasks = $this->model->getAllAssignTasksforMember($_SESSION['memberID']);
        $this->view->chart = $this->model->getTaskProgressChart($_SESSION['memberID']);
        $this->view->skills = $this->model->getmembersskills($_SESSION['memberID']);
        $this->view->render('assignTasksMember');
    }
    
    function AssignTasksforMember(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
        
        $empid = $_SESSION['memberID'];
        $taskid = $_POST['taskname'];
        $desc = $_POST['desc'];
        $ddate = $_POST['ddate'];
        $rhours = $_POST['rhours'];

        $result = false;
        
        if($empid == NULL){
            $result = false;
        }else if(is_numeric($rhours)){
            $result = $this->model->AssignTasksforMember($empid, $taskid, $desc, $ddate, $rhours);
            $msg = 'TaskID'.$taskid.' assigned by '.$_SESSION['login_user'] ;
			$this->model->notify($msg,"Task",$empid);
        }

        echo json_encode($result== false ? "false" : "true"); 

    }

    function DeleteAssignTask(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['delid'];
            $del = $this->model->DeleteAssignTask($id,$_SESSION['memberID']);

            if($del == true){
                echo '<script>alert("Deleted Successfully");
                window.location.href="http://localhost/FINAL/Manager/showpage_assignTasksMember" ;</script>';
            }else{
                echo '<script>alert("Failed! Not Delete");
                window.location.href="http://localhost/FINAL/Manager/showpage_assignTasksMember" ;</script>';
            }

            
        }
        
    }
    
}