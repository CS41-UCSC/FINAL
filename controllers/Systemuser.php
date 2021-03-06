<?php

class Systemuser extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }

    function showpage_home(){

        $this->view->render('home');

    }
    
    function showpage_landingpage(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();
        
        $this->view->data = $this->model->loadData();
        $this->view->hours = $this->model->loadHours();

        $this->view->render('landingpage');
        
    }

    function showpage_myprofile(){

        $this->view->notifications = $this->model->getNotifications();
		$this->view->notificationCount = $this->model->getNotificationCount();

        $this->view->users = $this->model->getData($_SESSION['login_user']);
        $this->view->users_skill =  $this->model->getSkillData($_SESSION['login_user']);
        $this->view->render('myprofile');
    }

    function saveform(){

        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $npass = $_POST['npass'];

        if($pass == $_SESSION['password']){

            $hash = password_hash($npass, PASSWORD_DEFAULT);

            if($cpass == $npass){
                $pass = $this->model->setNewPassword($_SESSION['login_user'],$hash); 
                if($pass == 1)
                    $_SESSION['pass']="yes";
                else
                    $_SESSION['pass']="no";
            }
            else{
                $_SESSION['pass']="no";
            }
        }else{
            $_SESSION['pass']="no";
        }

        $this->showpage_myprofile();

    }

    function savephoto(){

        $image_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = "../FINAL/Asserts/".$image_name;

        $this->model->setDataPhoto($_SESSION['login_user'],$image_name);

        if (move_uploaded_file($tempname, $folder))  {
            $_SESSION['photo']="yes";
            
        }else{
            $_SESSION['photo']="no";
            
        }

        $this->showpage_myprofile();
        
    }
    function setSkillData(){
        $skill = $_POST['skillname'];
        $percentage = $_POST['percent'];
        $r = $_SESSION['login_user'];
        $this->model->insertSkill($skill,$percentage,$r);
        
        
        
		
        header('location: http://localhost/FINAL/Systemuser/showpage_myprofile');
		
    }

}
