<?php

class Job extends API {

    function __construct (){
        parent::__construct();
        $this->db = Database::getInstance();
        $this->connection = $this->db->connection;
        $this->output['status'] = 'not started';
        $this->table = 'applicationResumesJobs';
        $this->createFields = array();
        $this->defaultValues = array();
    }


}
?>