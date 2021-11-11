<?php


class Team_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function  getTeams(){

        $sql = "SELECT TeamID, TeamName FROM team ";
        return $this->db->runQuery($sql);
    }

    function getdeptTeams(){
        $sql = "SELECT TeamID, TeamName FROM team INNER JOIN dept ON team.DeptID = dept.DeptID 
        WHERE dept.Dept_Manager = '$_SESSION[login_user]' ";

        return $this->db->runQuery($sql);
    }

}