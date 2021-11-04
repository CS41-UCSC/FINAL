<?php

class Task extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
    function showpage_deptManageTask(){
        $this->view->task = $this->model->getTask($_SESSION['login_user']);
        $this->view->render('deptManageTask');
    }

    function showpage_assignTasksTeam(){
        $this->view->users = $this->model->getTeam($_SESSION['login_user']);
        $this->view->render('assignTasksTeam');
    }

    function showpage_assignTasksMember(){
        $this->view->users = $this->model->getTaskProgress($_SESSION['teamID']);
        $this->view->render('assignTasksMember');
    }
    
    function addTask(){
        
        $this->model->insertTask();

        header('location: http://localhost/FINAL/manager/showpage_deptManageTask');

    }

    function loadTeam($teamId){

        $_SESSION['teamID'] = $teamId;

        header('location: http://localhost/FINAL/Task/showpage_assignTasksMember');
        
        
    }
}