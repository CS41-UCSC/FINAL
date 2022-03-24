<?php

class Member extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    function showpage_myprogressAccepted(){
        // $this->view->users =  $this->model->getAcceptedData();
        // $this->view->render('myprogressAccepted');

        $loginuser = $_SESSION['login_user'];
        $this->view->users =  $this->model->getDataA($loginuser);
        $this->view->render('myprogressAccepted');

    }

    function sendRemarkA($empId){
        $taskId = $_POST['taskId'];
        $remark = $_POST['remark'];
        $this->model->sendRemarkA($taskId,$empId,$remark);
        header('location: http://localhost/FINAL/Member/showpage_myprogressAccepted');
    }

    function showpage_myprogressCompleted(){
        //  $this->view->users =  $this->model->getCompletedData();
        //  $this->view->render('myprogressCompleted');


         $loginuser = $_SESSION['login_user'];
         $this->view->users =  $this->model->getDataC($loginuser);
         $this->view->render('myprogressCompleted');

       
    }

    function sortDate(){
        $sDate = $_POST['startDate'];
        $eDate = $_POST['endDate'];

        $this->view->users = $this->model->sortDate($sDate,$eDate);
        // header('location: http://localhost/CO-WMS/myprogressCompleted');
        $this->view->render('myprogressCompleted');
    }

    function showpage_myprogressOverdue(){
    //    $this->view->users =  $this->model->getOverdueData();
    //    $this->view->render('myprogressOverdue');


        $loginuser = $_SESSION['login_user'];
        $this->view->users =  $this->model->getDataO($loginuser);
        $this->view->render('myprogressOverdue');

    }

    function sendRemarkO($empId){
        $taskId = $_POST['taskId'];
        $remark = $_POST['remark'];
        $this->model->sendRemarkO($taskId,$empId,$remark);
        header('location: http://localhost/FINAL/Member/showpage_myprogressOverdue');
    }

    function showpage_myprogressPending(){

        $loginuser = $_SESSION['login_user'];
    //    $this->view->users =  $this->model->getPendingData();
    //    $this->view->render('myprogressPending');


    //    $loginuser = $_SESSION['login_user'];
        $this->view->users =  $this->model->getData($loginuser);
        $this->view->users1 =  $this->model->getDatasubTask($loginuser);
        $this->view->user2 = $this->model->getRemarks();
        $this->view->render('myprogressPending');
    }

    function acceptTask($taskId){
        $this->model->acceptTask($taskId);

        $loginuser = $_SESSION['login_user'];

        $this->view->users =  $this->model->getData($loginuser);
        header('location: http://localhost/FINAL/Member/showpage_myprogressPending');
        // $this->view->render('myprogressPending');
    }

    // function sendRemark($taskId,$empId){
    function sendRemark($empId){
        $taskId = $_POST['taskId'];
        $remark = $_POST['remark'];
        $this->model->sendRemark($taskId,$empId,$remark);
        header('location: http://localhost/FINAL/Member/showpage_myprogressPending');
        // header('location: http://http://localhost/Co-WMS/myprogressPending');
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
