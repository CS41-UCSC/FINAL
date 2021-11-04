<?php

require 'controllers/Manager.php';

class HRmanager extends Manager{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
}