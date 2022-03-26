<?php

require 'controllers/Manager.php';
// require 'controllers/team.php';
require 'controllers/department.php';
// include_once('controllers/team.php');
// include_once('controllers/department.php');

class HRmanager extends Manager{

    public $msg;

    function __construct()
    {
        parent::__construct();
        //session_start();
    }

    function showpage_manageEmployee(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users =  $this->model->getEmployeeData();
        $this->view->render('manageEmployee');

    }

    function removeRestoreEmployee($empid,$empStatus){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->model->removeRestoreEmployee($empid,$empStatus);
        //     }

        // }

       
        // $empStatus = $_POST['EmpStatus'];

        // $this->model->removeRestoreEmployee($empid,$empStatus);
        header('location: http://localhost/FINAL/HRmanager/showpage_manageEmployee');
        
        // $this->model->temp = $this->model->getData();
        // $this->view->temp1 = $this->model->removeRestoreEmployee();
        // header('location: http://localhost/CO-WMS/manageEmployee');

    }

    function showpage_manageEmployeeAdd(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $team = new Team();
        $this->view->teams = $team->getTeams(); 
        $team = new Department();
        $this->view->depts = $team->getDepartments(); 
        $this->view->render('manageEmployeeAdd');


    }

    function setEmployeeData(){
        
        //session_start();

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
        
        $empid = $_POST['epmId'];
        $empname= $_POST['Ename'];
        $empemail = $_POST['email'];
        $team = $_POST['team'];
        $dept = $_POST['dept'];
        $emprole = $_POST['role'];
        $password = $_POST['password'];
        $Cpassword = $_POST['Cpassword'];

       if($password == $Cpassword){

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $res = $this->model->insertEmployee($empid,$empname,$empemail,$team,$dept,$emprole,$hash,$password);

            if($res){
                /*$to = '$empemail';
                $mail_subject = 'Message from Co-WMS website';
                $email_body = "Hello {$empname},Welcome to the Co-WMS Company \n" ;
                $email_body .= "Your User Id : {$empid} \n";
                $email_body .= "Your Password : {$password} \n";
                $email_body .= "Thank you.";
                $from = 'From: cowmsofficial@gmail.com';
                
                $send_mail_result = mail($empemail, $mail_subject, $email_body, $from);

                if($send_mail_result){
                    $_SESSION['add-emp-msg'] = "New record created successfully and Email sent";
                }else{
                    $_SESSION['add-emp-msg'] = "New record created successfully and Email was not sent";
                }*/

                $msg = 'Permit'.$emprole.' access for '.$empid ;
			    $this->model->notify($msg,"Access",'CM-AD-100');

                if(strcmp($emprole,"Team_Member") || strcmp($emprole,"Team_Leader")){
                    $msg = 'Permit'.$emprole.' access for '.$empid ;
			        $this->model->notify($msg,"Task",'CM-AD-100');
                }

                $_SESSION['add-emp-msg'] = "New record created successfully";
                header('http://localhost/FINAL/HRmanager/showpage_manageEmployeeAdd');


            }else{
                $_SESSION['add-emp-msg'] = "Fialed to add New Employee";
                header('http://localhost/FINAL/HRmanager/showpage_manageEmployeeAdd');

            }

        }
        
        else{
            $_SESSION['add-emp-msg'] = "Fialed to add New Employee password";
            header('http://localhost/FINAL/HRmanager/showpage_manageEmployeeAdd');

        }
        

    }
    
    function showpage_manageEmployeeEditDelete(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users =  $this->model->getEmployeeEditDeleteData($_GET['epmId']);
        $this->view->employee=0;
        $this->view->render('manageEmployeeEditDelete');

    }

    function editData(){
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $empid = $_POST['epmId'];
            $empname= $_POST['Ename'];
            $empemail = $_POST['email'];
            $emprole = $_POST['role'];
            // $empstatus=$_POST['Estatus'];
            // $password = $_POST['password'];
            // $Cpassword = $_POST['Cpassword'];

            $this->model->editEmployee($empid,$empname,$empemail,$emprole);

            //$this->view->users =  $this->model->getData($_POST['epmId']);
           // $this->view->employee=0;
            //$this->view->render('manageEmployeeEditDelete');
            header('location: http://localhost/FINAL/HRmanager/showpage_manageEmployeeEditDelete');

        // $this->index();
         //header('location: http://localhost/CO-WMS/manageEmployeeEditDelete');

        // }
    }

    function showpage_manageDepartment(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users =  $this->model->getDepartmentData();
        $this->view->render('manageDepartment');

    }
    function showpage_manageDepartmentAdd(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->department = 0;
        
        // $this->view->users =  $this->model->getData();
        $this->view->render('manageDepartmentAdd');

    }

    function setDepartmentData(){
        $dName = $_POST['dname'];
        $dId = $_POST['dId'];
		$dManagerId = NULL;
		
        if(!empty($_POST['dMId'])){
			$dManagerId = $_POST['dMId'];
		}
		else{
			$dManagerId = NULL;
		}
		
        $this->model->insertDepartment($dName,$dId,$dManagerId);
		
        header('location: http://localhost/FINAL/HRmanager/showpage_manageDepartmentAdd');
		
    }
    
    function showpage_manageDepartmentEditDelete(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users =  $this->model->getDepartmentEditDeleteData();
        $this->view->render('manageDepartmentEditDelete');

    }

    function showpage_manageTeam(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users =  $this->model->getTeamData();
        $this->view->render('manageTeam');

    }
    function showpage_manageTeamAdd(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->team=0;
        $this->view->render('manageTeamAdd');

    }

    function setTeamData(){
        
      
        $teamName= $_POST['tname'];
        $DeptId = $_POST['dId'];
        $LeaderId = $_POST['lId'];

        // $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->model->insertTeam($teamName,$DeptId,$LeaderId);

        header('location: http://localhost/FINAL/HRmanager/showpage_manageTeamAdd');

    }
    
    function showpage_manageTeamEditDelete(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        // $this->view->users =  $this->model->getTeamEditDeleteData();
        // $this->view->render('manageTeamEditDelete');


        $this->view->users =  $this->model->getData($_GET['tId']);
        $this->view->team=0;

        $this->view->members =  $this->model->getMembers($_GET['tId']);
        $this->view->render('manageTeamEditDelete');

        // $this->view->users =  $this->model->getTeamEditDeleteData();
        // $this->view->render('manageTeamEditDelete');

        // $this->view->members =  $this->model->getMembers($_GET['tId']);


    }

    function editTeam(){
        $tName = $_POST['tName'];
        $tId= $_POST['tId'];
        $LeaderId = $_POST['LId'];
        // $format = $_POST['format'];

        // $this->model->editTeam($tName,$tId,$format);
        // $this->view->members =  $this->model->getMembers($tId);

        $preLeaderId = $this->model->getData($tId);
        $this->model->editTeam($tName,$tId,$LeaderId,$preLeaderId);
        header('location: http://localhost/FINAL/HRmanager/showpage_manageTeam');
    }

    function showpage_employeeWorkProgress(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users =  $this->model->getemployeeWorkProgressData();
        $this->view->render('employeeWorkProgress');

    }
}
