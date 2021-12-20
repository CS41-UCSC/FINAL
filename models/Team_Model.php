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

    function getTeamMembers(){

        /*$mem = "SELECT team_member.EmpID FROM team_member WHERE TeamID = '$tid' ";
        $led = "SELECT team_leader.EmpID FROM team_leader WHERE TeamID = '$tid' ";

        $sql1 = "SELECT EmpID, EmpName FROM systemuser WHERE systemuser.EmpID = ANY ($mem) " ;
        $sql2 = "SELECT EmpID, EmpName FROM systemuser WHERE systemuser.EmpID = ANY ($led) " ;
        
        $res1 = $this->db->runQuery($sql1);
        $res2 = $this->db->runQuery($sql2);


        return array_merge($res1, $res2);*/

        $sql1 = "SELECT systemuser.EmpID, systemuser.EmpName, team_member.TeamID FROM systemuser INNER JOIN team_member ON systemuser.EmpID = team_member.EmpID";
        $sql2 = "SELECT systemuser.EmpID, systemuser.EmpName, team_leader.TeamID FROM systemuser INNER JOIN team_leader ON systemuser.EmpID = team_leader.EmpID";

        $res1 = $this->db->runQuery($sql1);
        $res2 = $this->db->runQuery($sql2);

        return array_merge($res1, $res2);

    }

    function getTaskSet($teamid){


        $sql = "SELECT TaskID, TaskName FROM task WHERE TeamID = '$teamid' ";
        $res = $this->db->runQuery($sql);

        return $res;
    }

}