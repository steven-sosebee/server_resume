<?php

class Resume extends API {

    function __construct (){
        parent::__construct();
        $this->db = Database::getInstance();
        $this->connection = $this->db->connection;
        $this->output['status'] = 'not started';
        $this->table = 'applicationResumes';
        $this->defaultValues = array(
            'uniqueId'=>$this->uuid(30)
        );
    }

    
}
?>