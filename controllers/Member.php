<?php

class Member extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    function showpage_myprogressAccepted(){
        $this->view->users =  $this->model->getAcceptedData();
        $this->view->render('myprogressAccepted');
    }
    function showpage_myprogressCompleted(){
         $this->view->users =  $this->model->getCompletedData();
         $this->view->render('myprogressCompleted');

       
    }
    function showpage_myprogressOverdue(){
       $this->view->users =  $this->model->getOverdueData();
       $this->view->render('myprogressOverdue');
    }
    function showpage_myprogressPending(){
       $this->view->users =  $this->model->getPendingData();
       $this->view->render('myprogressPending');
    }
    function showpage_myprogressInprogressSelect(){
       $this->view->users =  $this->model->getInprogressSelectData();
       $this->view->users1 =  $this->model->getSubTaskData($taskid);
       $this->view->render('myprogressInprogressSelect');

    }

    function myprogressInprogressSelectid(){
        $taskid = $_GET['ID'];
        $this->view->users =  $this->model->getData($taskid);
        $this->view->users1 =  $this->model->getSubTaskData($taskid);
        //$this->view->users2 =  $this->model->updateSubTaskData();
        $this->view->render('myprogressInprogressSelect');
    }

    function savesubtasks(){

        if(isset($_POST['submit'])){

            if(isset($_POST['task'])) {

                /*foreach($_POST['task'] as $value){
                    echo "Chosen colour : ".$value.'<br/>';
                }*/

                $res =  $this->model->updateSubTaskData($_POST['task']);

                if($res == true){
                    echo '<script>alert("Updated Successfully");
                    window.location.href="http://localhost/FINAL/Member/showpage_myProgressAccepted" ;</script>';
                }else{
                    echo '<script>alert("Failed! Not Delete");
                    window.location.href="http://localhost/FINAL/Member/showpage_myProgressAccepted" ;</script>';
                }
        
            }

        }
    }
    
}