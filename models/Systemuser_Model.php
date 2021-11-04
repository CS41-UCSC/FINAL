<?php

class Systemuser_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function loadData(){

        if($_SESSION['emprole'] == "Dept_Manager"){

            $sql1 ="SELECT COUNT(CASE WHEN task_assign.TaskStatus = 'InProgress' THEN 1 END) AS inprogress,
            COUNT(CASE WHEN task_assign.TaskStatus = 'Completed' THEN 1 END) AS completed,
            COUNT(CASE WHEN task_assign.TaskStatus = 'Approved' THEN 1 END) AS approved,
            COUNT(CASE WHEN task_assign.TaskStatus = 'Pending' THEN 1 END) AS pending
            FROM task_assign INNER JOIN task ON task_assign.TaskID = task.TaskID INNER JOIN team ON task.TeamID = team.TeamID 
            INNER JOIN dept ON team.DeptID = dept.DeptID WHERE dept.Dept_Manager = '$_SESSION[login_user]' ";

            return $this->db->runQuery($sql1);

        }elseif($_SESSION['emprole'] == "Team_Leader" || $_SESSION['emprole'] == "Team_Member" ){

            $sql1 ="SELECT COUNT(CASE WHEN task_assign.TaskStatus = 'InProgress' THEN 1 END) AS inprogress,
            COUNT(CASE WHEN task_assign.TaskStatus = 'Completed' THEN 1 END) AS completed,
            COUNT(CASE WHEN task_assign.TaskStatus = 'Approved' THEN 1 END) AS approved,
            COUNT(CASE WHEN task_assign.TaskStatus = 'Pending' THEN 1 END) AS pending
            FROM task_assign WHERE task_assign.AssignedTo = '$_SESSION[login_user]' ";

            return $this->db->runQuery($sql1);  

        }

    }

    function loadHours(){

        if($_SESSION['emprole'] == "Dept_Manager"){

            $sql2 = "SELECT task_assign.TaskStatus, SUM(task_assign.RequiredTime) AS totaltime FROM task_assign 
            INNER JOIN task ON task_assign.TaskID = task.TaskID INNER JOIN team ON task.TeamID = team.TeamID 
            INNER JOIN dept ON team.DeptID = dept.DeptID WHERE dept.Dept_Manager = '$_SESSION[login_user]' GROUP BY task_assign.TaskStatus ;";
    
            return $this->db->runQuery($sql2);

        }

        elseif($_SESSION['emprole'] == "Team_Leader" || $_SESSION['emprole'] == "Team_Member" ){

            $sql2 ="SELECT task_assign.TaskStatus, SUM(task_assign.RequiredTime) AS totaltime FROM task_assign 
            WHERE task_assign.AssignedTo = '$_SESSION[login_user]' GROUP BY task_assign.TaskStatus ;" ;

            return $this->db->runQuery($sql2);  

        }
    }

    function getData($empID){

        return $this->db->runQuery("SELECT * from SystemUser WHERE EmpID in ('$empID')");

    }

    function setDataPhoto($empID,$Empimg){

        $sql = ("UPDATE systemuser SET Userimg = '$Empimg' WHERE EmpID = ('$empID') ;");

        if (($this->db->query($sql)) == TRUE) {
            $_SESSION['user_img'] = $Empimg;
            $_SESSION['photo']="yes";
        } else {
            $_SESSION['photo']="no";
        }

    }

    function setNewPassword($empID,$npass){

        $sql = ("UPDATE systemuser SET PASSWORD = '$npass' WHERE EmpID = ('$empID') ;");

        if (($this->db->query($sql)) == TRUE) {
            return true;
        } else {
            return false;
        }
    }

}

