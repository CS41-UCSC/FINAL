<?php

class Manager extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }

    function showpage_assignTasksMember(){
        $this->view->render("assignTasksMember");
    }
    
}