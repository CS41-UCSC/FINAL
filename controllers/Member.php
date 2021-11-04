<?php

class Member extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
}