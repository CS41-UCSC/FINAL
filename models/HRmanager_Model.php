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
	function getDatadept($dId){

        // $sql = "SELECT * FROM team";
        // $sql = "SELECT * FROM team WHERE TeamID=('$tId')";
        // return $this->db->runQuery($sql);

        $sqld = "SELECT * FROM dept WHERE DeptID=('$dId')";
        return $this->db->runQuery($sqld);

    }
	function editDepartment($dId,$ManagerId){

        echo $dId;
        echo $ManagerId;

        $sql = "UPDATE `dept` SET `Dept_Manager`='$ManagerId' WHERE DeptID='$dId' " ;
        $sql1 = "UPDATE `dept_manager` SET `EmpID`='$ManagerId' WHERE DeptID='$dId' " ;

        $res = $this->db->query($sql);
        $res1 = $this->db->query($sql1);
        
        if($res && $res1){
            $_SESSION['edit-team'] = "yes";
            return true;
        }else{
             $_SESSION['edit-team'] = "no";
             return false;
        }

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

    function getTeamLeaderID($tId){

        $sql = "SELECT * FROM team_leader WHERE TeamID=('$tId')";
        return $this->db->runQuery($sql);

    }

    function editTeam($tName,$tId,$LeaderId,$preLeaderId){

        try{
            $this->db->beginTransaction();

            $preleader = $preLeaderId[0][0];

            $sql = "UPDATE `team_leader` SET `EmpID`='$LeaderId' WHERE EmpID='$preleader' ";
            $sql1 = "INSERT INTO `team_member`(`EmpID`, `TeamID`) VALUES ('$preleader','$tId')";
            $sql2 = "DELETE FROM `team_member` WHERE EmpID='$LeaderId'";

            $res = $this->db->query($sql);
            $res1 = $this->db->query($sql1);
            $res2 = $this->db->query($sql2);

            if($res && $res1 && $res2){
                    $_SESSION['edit-team'] = "yes";
                    $this->db->commit();
                    return true;
            }else{
                    $_SESSION['edit-team'] = "no";
                    $this->db->rollback();
                    return false;
            }
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
	function getDepartmentManagers(){

        $sql = "SELECT systemuser.EmpID FROM systemuser LEFT JOIN dept_manager USING(EmpID) 
        WHERE dept_manager.EmpID IS NULL AND systemuser.EmpRole='Dept_Manager'";

        return $this->db->runQuery($sql);
    }


}
