<?php

class Member extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    function showpage_myprogressAccepted(){
        $this->view->users =  $this->model->getAcceptedData();
        $this->view->render('myprogressAccepted');
    }
    function showpage_myprogressCompleted(){
         $this->view->users =  $this->model->getCompletedData();
         $this->view->render('myprogressCompleted');

       
    }
    function showpage_myprogressOverdue(){
       $this->view->users =  $this->model->getOverdueData();
       $this->view->render('myprogressOverdue');
    }
    function showpage_myprogressPending(){
       $this->view->users =  $this->model->getPendingData();
       $this->view->render('myprogressPending');
    }
    function showpage_myprogressInprogressSelect(){
       $this->view->users =  $this->model->getInprogressSelectData();
       $this->view->render('myprogressInprogressSelect');

    }
    
}