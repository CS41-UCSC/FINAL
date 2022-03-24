<?php

class Member_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }
    function getAcceptedData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='InProgress'";
        return $this->db->runQuery($sql);

    }
    function getCompletedData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Completed'";
        return $this->db->runQuery($sql);
    }
    function getOverdueData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Approved'";
        return $this->db->runQuery($sql);
    }
    function getPendingData(){
        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='Pending'";
        return $this->db->runQuery($sql);
    }
    function getInprogressSelectData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);
    }
    function getData($taskid){

        $sql = "SELECT t.TaskName, tA.* FROM task t, task_assign tA where t.TaskID = tA.TaskID && tA.TaskStatus='InProgress'
        AND t.TaskID = '$taskid' ";
        return $this->db->runQuery($sql);

    }
    function getSubTaskData($taskid){

        $sql1 = "SELECT SubTaskID, SubTaskName,status FROM subtask where TaskID = '$taskid'";
        return $this->db->runQuery($sql1);

    }

    function updateSubTaskData($data){

        foreach($data as $row){
        
            $sql2 = "UPDATE subtask SET status ='Completed' WHERE SubTaskID='$row' " ;
            $this->db->query($sql2);

        }

        return true;
        
    }

}

?>