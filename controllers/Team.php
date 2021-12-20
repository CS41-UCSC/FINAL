<?php

include_once('models/Team_Model.php');

class Team extends Controller{


    function __construct()
    {
        parent::__construct();
        //session_start();
    }

    function getTeams(){

        $models = new Team_Model();
        $res = $models->getTeams();
        return $res;

    }

    function getdeptTeams(){

        $models = new Team_Model();
        $res = $models->getdeptTeams();
        return $res;

    }

    function getTeamMembers(){

        $models = new Team_Model();
        $res = $models->getTeamMembers();
        return $res;

    }

    function getTaskSet($teamid){

        $models = new Team_Model();
        $res = $models->getTaskSet($teamid);
        return $res;

    }

}

