<?php

class Systemuser extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
    function showpage_landingpage(){
        
        $this->view->data = $this->model->loadData();
        $this->view->hours = $this->model->loadHours();

        $this->view->render('landingpage');
        
    }

}