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
        $this->view->teamTasks = $team->getTaskSet($_SESSION['memberteamID']);
        $this->view->tasks = $this->model->getAssignTasksforMember($_SESSION['memberID']);
        $this->view->chart = $this->model->getTaskProgressChart($_SESSION['memberID']);
        $this->view->render('assignTasksMember');
    }
    
    function AssignTasksforMember(){
        
        $empid = $_SESSION['memberID'];
        $taskid = $_POST['taskname'];
        $desc = $_POST['desc'];
        $ddate = $_POST['ddate'];
        $rhours = $_POST['rhours'];


        $result = 0;
        
        if($empid == NULL){
            $result = 0;
        }else{
            $result = $this->model->AssignTasksforMember($empid, $taskid, $desc, $ddate, $rhours);
        }

        echo json_encode($result==0 ? "false" : "true"); 

    }

    function DeleteAssignTask(){

        
    }

}