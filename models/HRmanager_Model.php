<?php

class HRmanager_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }

    function getEmployeeData(){
        $sql = "SELECT * FROM systemuser";
        return $this->db->runQuery($sql);
    }

    function removeRestoreEmployee($empid,$empStatus){

        // $sql = "UPDATE systemuser SET EmpName='$empname' , EmpEmail='$empemail' , EmpRole='$emprole' WHERE EmpID=('$empid') " ;

        if($empStatus == 'Active'){
            $sql = "UPDATE systemuser SET EmpStatus='Inactive' WHERE EmpID=('$empid') " ;
            return $this->db->runQuery($sql);
        }else{
            $sql = "UPDATE systemuser SET EmpStatus='Active' WHERE EmpID=('$empid') " ;
            return $this->db->runQuery($sql);
        }



        // getData();


        // $result = $this->temp;

        // foreach ($result as $row) {
        //     if($row['EmpStatus']== "Active"){
        //         $sql = "UPDATE systemuser SET EmpStatus='Inactive' WHERE EmpID=('$empid') " ;
        //         return $this->db->runQuery($sql);
        //     }else{
        //         $sql = "UPDATE systemuser SET EmpStatus='Active' WHERE EmpID=('$empid') " ;
        //         return $this->db->runQuery($sql);
        //     }

        // }


    }


    function insertEmployee($empid,$empname,$empemail,$team,$dept,$emprole,$hash,$password){
        try{
            $this->db->beginTransaction();
        
            $sql1 = "INSERT INTO systemuser (`EmpID`, `EmpName`, `EmpEmail`, `EmpRole`, `PASSWORD`) VALUES ('$empid','$empname','$empemail','$emprole','$hash') " ;
            $insert = $this->db->query($sql1);

            if($emprole == "Team_Member"){
                $sql3 ="INSERT INTO team_member (`EmpID`, `TeamID`,`EndDate` ) VALUES ('$empid','$team', null)";
                $this->db->query($sql3);
            }
            elseif($emprole == "Team_Leader"){
                $sql3 ="INSERT INTO team_Leader (`EmpID`, `TeamID`,`EndDate` ) VALUES ('$empid','$team', null)";
                $this->db->query($sql3);
            }elseif($emprole == "Dept_Manager"){
                $sql3 ="INSERT INTO dept_manager (`EmpID`, `DeptID`,`EndDate` ) VALUES ('$empid','$dept', null)";
                $this->db->query($sql3);
            }
           

            $mail_subject = 'Message from Co-WMS website';
            $email_body = "Hello {$empname},Welcome to the Co-WMS Company \n" ;
            $email_body .= "Your User Id : {$empid} \n";
            $email_body .= "Your Password : {$password} \n";
            $email_body .= "Thank you.";
            $from = 'From: cowmsofficial@gmail.com';
                    
            $send_mail_result = mail($empemail, $mail_subject, $email_body, $from);

            if($send_mail_result){
                $this->db->commit();
                return true;
            }
           
            else{
                $this->db->rollback();
                return false;
            }
     
        }
        
        catch(PDOException $e)
        {
            $this->db->rollback();
    	    $_SESSION['add-emp-msg'] = $e->getMessage();
            return false;
        }

        /*try{
            $this->db->exec($sql);
                $_SESSION['add-emp-msg'] = "New record created successfully";
                return true;
            }
        catch(PDOException $e)
        {

    	    $_SESSION['add-emp-msg'] = $e->getMessage();
            return false;
        }*/

    }

    function editEmployee($empid,$empname,$empemail,$emprole){

        $sql = "UPDATE systemuser SET EmpName='$empname' , EmpEmail='$empemail' , EmpRole='$emprole' WHERE EmpID=('$empid') " ;

        // return $this->db->query($sql);


        // if($this->db->query($sql) == true){
        if($this->db->query($sql)){
                $_SESSION['edit-employee'] = "yes";
        }else{
                $_SESSION['edit-employee'] = "no";
        }


    }


    function getEmployeeEditDeleteData($empId){

        $sql = "SELECT * FROM systemuser WHERE EmpID=('$empId')";
        return $this->db->runQuery($sql);

    }

    function getDepartmentData(){

        $sql = "SELECT * FROM dept";
        return $this->db->runQuery($sql);

    }

    function insertDepartment($dName,$dId,$dManagerId){
		
		$sql="";
		if($dManagerId == NULL){
			$sql = "INSERT INTO `dept`( `DeptID`, `DeptName`) VALUES ('$dId','$dName')";
            
		}
        else{
			$sql = "INSERT INTO `dept`( `DeptID`, `DeptName`,`Dept_Manager`) VALUES ('$dId','$dName','$dManagerId')";
            
		}


        if($this->db->query($sql) == true){
                $_SESSION['add-department'] = "yes";
        }else{
                $_SESSION['add-department'] = "no";
        }

    
        // try{
        //     $this->db->exec($sql);
        //         $_SESSION['error-msg'] = "New record created successfully";
        //     }
        // catch(PDOException $e)
        // {

    	//     $_SESSION['error-msg'] = $e->getMessage();
        // }

    }

    function getDepartmentEditDeleteData(){

        $sql = "SELECT * FROM dept";
        return $this->db->runQuery($sql);

    }

    function getTeamData(){

        // $sql = "SELECT * FROM team";
        // return $this->db->runQuery($sql);

        $sql = "SELECT t.*,tl.* FROM team t,team_leader tl where t.TeamID = tl.TeamID  ";
        return $this->db->runQuery($sql);


    }

    // function insertTeamLeader($LeaderId){
    //     $sql = "INSERT INTO `team_leader`( `EmpID`) VALUES ('$LeaderId') " ;

    //     return $this->db->query($sql);
    // }

    function insertTeam($teamName,$DeptId,$LeaderId){

        try{
            $this->db->beginTransaction();

            $sql = "INSERT INTO `team`( `TeamName`, `DeptID`) VALUES ('$teamName','$DeptId') " ;
            $res = $this->db->query($sql);

            $sqltid = "SELECT TeamID FROM team WHERE TeamName = '$teamName' ";
            $gettid = $this->db->runQuery($sqltid);

            $tid = $gettid[0][0];

            $sql1 = "INSERT INTO `team_leader`(`EmpID`, `TeamID`) VALUES ('$LeaderId','$tid')" ;
            $res2 = $this->db->query($sql1);

            $sql2 = "DELETE FROM `team_member` WHERE EmpID='$LeaderId' ";
            $res3 = $this->db->query($sql2);

            if($res && $res2 && $res3){
                    $_SESSION['add-team'] = "yes";
                    $this->db->commit();
                    return true;
            }else{
                    $_SESSION['add-team'] = "no";
                    $this->db->rollback();
                    return false;
            }
        }

        catch(PDOException $e){
            $this->db->rollback();
            return false;
        }


    }

    function getTeamEditDeleteData(){

        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);

    }

    function getData($tId){

        // $sql = "SELECT * FROM team";
        $sql = "SELECT * FROM team WHERE TeamID=('$tId')";
        return $this->db->runQuery($sql);

    }

    function editTeam($tName,$tId,$LeaderId,$preLeaderId){
        // $sql = "UPDATE team,team_leader SET team.TeamName='$tName',team_leader.EmpID='$format' FROM team t,team_leader tl  WHERE t.TeamID=('$tId') OR tl.TeamID=('$tId') " ;
        // $sql = "UPDATE team SET TeamName='$tName' where TeamID=('$tId')";
        
        // if($this->db->query($sql)){
        //     $_SESSION['edit-team'] = "yes";
        // }else{
        //     $_SESSION['edit-team'] = "no";
        // }





        try{
            $this->db->beginTransaction();


            $sql = "UPDATE team SET TeamName='$tName' where TeamID=('$tId')";
            $res = $this->db->query($sql);

            // $sql1 = "UPDATE team_leader SET EmpID='$LeaderId' where TeamID=('$tId')";
            // $res1 = $this->db->query($sql1);
            
            $sql2 = "INSERT INTO `team_leader` VALUE  WHERE TeamID=('$LeaderId')";
            $res2 = $this->db->query($sql2);

            $sql3 = "DELETE FROM `team_leader` WHERE EmpID='$preLeaderId'";
            $res3 = $this->db->query($sql3);


            // INSERT INTO `team_leader`(`EmpID`, `TeamID`) VALUES ('$LeaderId','$tid')

            $sql4 = "INSERT INTO `team_member` WHERE TeamID=('$preLeaderId')";
            $res4 = $this->db->query($sql4);

            $sql5 = "DELETE FROM `team_member` WHERE EmpID='$LeaderId' ";
            $res5 = $this->db->query($sql5);


            if($res && $res1 && $res2 && $res3 && $res4 && $res5){
                $_SESSION['edit-team'] = "yes";
                $this->db->commit();
                return true;
            }else{
                $_SESSION['edit-team'] = "no";
                $this->db->rollback();
                return false;
            }

            // $sql1 = "UPDATE team_Member SET EmpID='$LeadreId' where TeamID=('$tId')";
            // $res1 = $this->db->query($sql1);

        }

        catch(PDOException $e){
            $this->db->rollback();
            return false;
        }
    }

    function getMembers($tId){
        $sql = "SELECT t.*,tm.* FROM team_member tm,team t WHERE t.TeamID=tm.TeamID && t.TeamID=('$tId')";
        return $this->db->runQuery($sql);
    }

     function getemployeeWorkProgressData(){
         
        $sql = "SELECT * FROM systemuser";
        return $this->db->runQuery($sql);

    }

    function notify($msg,$type,$receiver){
		$empID = $_SESSION['login_user'];
		$sql = "INSERT INTO notification (Notification,Notype,SentDT,NotStatus,Sender,Receiver)
		VALUES ('$msg','$type',CURRENT_TIMESTAMP,'Pending','$empID','$receiver')";
		return $this->db->runQuery($sql);
	}

	function getNotifications(){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT NotID, Notification, Notype FROM notification 
		WHERE Receiver = '$empID' AND NotStatus = 'Pending' LIMIT 5";
		return $this->db->runQuery($sql);
	}

	function getNotificationCount(){
		$empID = $_SESSION['login_user'];
		$sql = "SELECT COUNT(*) FROM notification 
		WHERE Receiver = '$empID' AND NotStatus = 'Pending'";
		return $this->db->runQuery($sql);
	}

	function notificationEmail($msg,$empID){
		$sql = "SELECT EmpName, EmpEmail FROM systemuser WHERE EmpID = '$empID'";
		$result = $this->db->runQuery($sql);
		$empName = $result['0']['EmpName'];
		$empEmail = $result['0']['EmpEmail']; 

		$mail_subject = "Notification from Co-WMS";
		$email_body = "Dear {$empName},\n";
		$email_body .= $msg;
		$from = "From: cowmsofficial@gmail.com";

		$mail_result = mail($empEmail, $mail_subject, $email_body, $from);
		
		if($mail_result){
			return true;
		}
		else{
			return false;
		}

	}


}