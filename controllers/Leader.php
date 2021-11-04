<?php

require 'controllers/Member.php';

class Leader extends Member{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
}