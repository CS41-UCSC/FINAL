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

        $res1 =null ;

        if($_SESSION['emprole'] == "Dept_Manager"){

            $sql1= "SELECT StartDate FROM dept_manager  WHERE EmpID='$_SESSION[login_user]' ";
            $res1 = $this->db->runQuery($sql1);

        }
        else if($_SESSION['emprole'] == "Team_Leader"){

            $sql1= "SELECT StartDate FROM team_leader  WHERE EmpID='$_SESSION[login_user]' ";
            $res1 = $this->db->runQuery($sql1);

        }else if($_SESSION['emprole'] == "Team_Member"){

            $sql1= "SELECT StartDate FROM team_member  WHERE EmpID='$_SESSION[login_user]' ";
            $res1 = $this->db->runQuery($sql1);

        }

        $res2 = $this->db->runQuery("SELECT * from SystemUser WHERE EmpID in ('$empID')");

        return array_merge($res2, $res1);

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
    function insertSkill($skill,$percentage,$r){
		
		// $sql="";
	
			$sql = "INSERT INTO star_rate ( `skill_name`,`percent`,`EmpID`) VALUES ('$skill','$percentage','$r')";
            // $sql = "INSERT INTO star_rate ( `skill_name`) VALUES ('$skill')";
            $this->db->query($sql);
            // if (($this->db->query($sql)) == TRUE) {
            //     return true;
            // } else {
            //     return false;
            // }

            if($percentage == "10%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "20%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "30%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "40%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "50%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "60%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "70%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "80%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            elseif($percentage == "90%"){
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            else{
                $sqlk ="INSERT INTO star_rate (`star_rating` ) VALUES ('$percentage')";
                $this->db->query($sqlk);
            }
            
           
           
            
		// if($this->db->query($sql) == true){
        //         $_SESSION['my-profile'] = "yes";
        // }else{
        //         $_SESSION['my-profile'] = "no";
        // }
       

    
        // try{
        //     $this->db->exec($sql);
        //         $_SESSION['error-msg'] = "New record created successfully";
        //     }
        // catch(PDOException $e)
        // {

    	//     $_SESSION['error-msg'] = $e->getMessage();
        // }

    }
    function getSkillData($temp){
        $r = $_SESSION['login_user'];
        $sql1 = "SELECT skill_name,percent FROM star_rate WHERE EmpID in ('$temp')";
        return $this->db->runQuery($sql1);

    }

}

