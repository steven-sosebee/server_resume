<?php
    class Skill extends API {

        function __construct (){
            parent::__construct();
            $this->db = Database::getInstance();
            $this->connection = $this->db->connection;
            $this->output['status'] = 'not started';
            $this->table = 'tblSkills';
            $this->createFields = array(
                ':skillsName'=>NULL, 
                ':skillsType'=>NULL, 
                ':skillsLevel'=>NULL
            );
            $this->defaultValues = array();
        }

    }
?>