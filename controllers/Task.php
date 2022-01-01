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
        $team = new Team();
        $this->view->members = $team->getTeamMembers();
        $this->view->render('assignTasksTeam');
    }

    function showpage_taskProgress(){
        $this->view->users = $this->model->getTaskProgress($_SESSION['teamID'],$_SESSION['startmonthyear'],$_SESSION['endmonthyear']);
        $this->view->render('taskProgress');
    }

    function showpage_assignTasksMember(){
        $this->view->teamTasks = 
        $this->view->tasks = $this->model->getAssignTasksforMember($_SESSION['memberID']);
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

    function showsubtaskview(){

        $taskid = $_POST['taskid'];
        $result = $this->model->showsubtaskview($taskid);

        echo json_encode(count($result)==0 ? null : $result);

    }

    function loadTeam($teamId,$date){

        $_SESSION['teamID'] = $teamId;
        $ts = strtotime($date);
        $startmonthyear = date('Y-m-01',$ts);
        $_SESSION['startmonthyear'] = $startmonthyear;
        $endmonthyear = date('Y-m-t' ,$ts);
        $_SESSION['endmonthyear'] = $endmonthyear;

        header('location: http://localhost/FINAL/Task/showpage_taskProgress');
           
    }

    function monthfilter(){

        $date = $_GET['Date'];
        $date_arr = explode("-", $date);
        $month_num = $date_arr[1];
        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
        $_SESSION['monthname'] = $month_name;

        $ts = strtotime($date);

        $startmonthyear = date('Y-m-01',$ts);
        $_SESSION['startmonthyear'] = $startmonthyear;
        $endmonthyear = date('Y-m-t' ,$ts);
        $_SESSION['endmonthyear'] = $endmonthyear;

        header('location: http://localhost/FINAL/Task/showpage_taskProgress');
    }

    function loadMembers($memberId, $memberteamId){

        $_SESSION['memberID'] = $memberId;
        $_SESSION['memberteamID'] = $memberteamId;
        header('location: http://localhost/FINAL/Manager/showpage_assignTasksMember');

    }

    function editAssignTask(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['tid'];
            $assignedmember = $_POST['assignedmember'];
            $rtime = $_POST['rtime'];
            $ddate = $_POST['ddate'];
            $stts = $_POST['stts'];

            $edit = $this->model->editAssignTask($id,$assignedmember,$rtime,$ddate,$stts);

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
        $assignedmember = $_POST['assignedmember'];
        $subtask = $this->model->getSubTasks($tid,$assignedmember);
        
        echo json_encode(count($subtask)==0 ? null : $subtask);

    }

    function getAssignTasksforMember(){

        $empid = $_POST['empid'];
        $assignTask = $this->model->getAssignTasksforMember($empid);

        echo json_encode(count($assignTask) == 0 ? null : $assignTask);
    }

    function AssignTasksforMember(){
        
        $empid = $_SESSION['memberID'];
        $taskid = $_POST['taskname'];
        $ddate = $_POST['ddate'];
        $rhours = $_POST['rhours'];

        $result = 0;
        
        if($empid == NULL){
            $result = 0;
        }else{
            $result = $this->model->AssignTasksforMember($empid, $taskid, $ddate, $rhours);
        }

        echo json_encode($result==0 ? "false" : "true"); 

    }

}