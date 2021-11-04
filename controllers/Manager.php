<?php

class Manager extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
}