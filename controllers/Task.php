<?php

include_once('controllers/team.php');

class Task extends controller{

    function __construct()
    {
        parent::__construct();
        session_start();
    }
    
    function showpage_deptManageTask(){
        $team = new Team();
        $this->view->deptteams = $team->getdeptTeams(); 
        $this->view->task = $this->model->getTask($_SESSION['login_user']);
        $this->view->render('deptManageTask');
    }

    function showpage_assignTasksTeam(){
        $this->view->users = $this->model->getTeam($_SESSION['login_user']);
        $this->view->render('assignTasksTeam');
    }

    function showpage_taskProgress(){
        $this->view->users = $this->model->getTaskProgress($_SESSION['teamID']);
        $this->view->render('taskProgress');
    }

    function showpage_assignTasksMember(){
        $team = new Team();
        $this->view->members = $team->getTeamMembers($_SESSION['teamID']);
        $this->view->render('assignTasksMember');
    }
    
    function showpage_teamProgress(){
        $this->view->users = $this->model->getTeamProgress();
        $this->view->render('teamProgress');
    }

    function showpage_checkRemarks(){

        $taskid = $_GET['TaskID'];
        $this->view->tname=$_GET['Name'];
        $this->view->users = $this->model->getTaskRemarks($taskid);
        $this->view->render('checkRemarks');
    }

    function getEmployeeProgress(){
        $eid = $_POST['empid'];
        $task = $this->model->getEmployeeProgress($eid);
        
        echo json_encode(count($task)==0 ? null : $task);
    }

    function addTask(){
        
        $this->model->insertTask();

        header('location: http://localhost/FINAL/Task/showpage_deptManageTask');

    }

    function EditTask(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['ttid'];
            $tteam = $_POST['tteam'];
            $ttitle = $_POST['ttitle'];

            $edit = $this->model->EditTask($id,$tteam,$ttitle);

            if($edit == true){
                echo '<script>alert("Changed Successfully");
                window.location.href="http://localhost/FINAL/Task/showpage_deptManageTask" ;</script>';
            }else{
                echo '<script>alert("Failed! Not changed");
                window.location.href="http://localhost/FINAL/Task/showpage_deptManageTask" ;</script>';
            }

            
        }
    }

    function DeleteTask(){
       
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['delid'];
            echo $id;
            $del = $this->model->DeleteTask($id);

            if($del == true){
                echo '<script>alert("Deleted Successfully");
                window.location.href="http://localhost/FINAL/Task/showpage_deptManageTask" ;</script>';
            }else{
                echo '<script>alert("Failed! Not Delete");
                window.location.href="http://localhost/FINAL/Task/showpage_deptManageTask" ;</script>';
            }

            
        }
        
    }

    function loadTeam($teamId){

        $_SESSION['teamID'] = $teamId;

        header('location: http://localhost/FINAL/Task/showpage_taskProgress');
           
    }

    function loadMembers($teamId){

        $_SESSION['teamID'] = $teamId;

        header('location: http://localhost/FINAL/Task/showpage_assignTasksMember');

    }

    function editAssignTask(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['tid'];
            $rtime = $_POST['rtime'];
            $ddate = $_POST['ddate'];
            $stts = $_POST['stts'];

            $edit = $this->model->editAssignTask($id,$rtime,$ddate,$stts);

            if($edit == true){
                echo '<script>alert("Changed Successfully");
                window.location.href="http://localhost/FINAL/Task/showpage_taskProgress" ;</script>';
            }else{
                echo '<script>alert("Failed! Not changed");
                window.location.href="http://localhost/FINAL/Task/showpage_taskProgress" ;</script>';
            }

        }

    }

    function editRemarks(){

        $id = $_GET['RemarkID'];
        $st = $_GET['Status'];

        $edit = $this->model->editTaskRemarks($id,$st);

        if($edit == true){
            echo '<script>alert("Changed Successfully");
            window.location.href="http://localhost/FINAL/Task/showpage_taskProgress" ;</script>';
        }else{
            echo '<script>alert("Failed! Not changed");
            window.location.href="http://localhost/FINAL/Task/showpage_taskProgress" ;</script>';
        }

    }

    function getSubTasks(){

        $tid = $_POST['taskid'];
        $subtask = $this->model->getSubTasks($tid);
        
        echo json_encode(count($subtask)==0 ? null : $subtask);

        /* $eid = $_POST['empid'];
        $task = $this->model->getEmployeeProgress($eid);
        
        echo json_encode(count($task)==0 ? null : $task);*/
    }
}