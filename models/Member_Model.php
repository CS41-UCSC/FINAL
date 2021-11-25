<?php

class Member_Model extends Model{

    function __construct()
    {
        parent::__construct();
    }
    function getAcceptedData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);

    }
    function getCompletedData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);
    }
    function getOverdueData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);
    }
    function getPendingData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);
    }
    function getInprogressSelectData(){
        $sql = "SELECT * FROM team";
        return $this->db->runQuery($sql);
    }

}