<?php
    require_once "../api.php";

    class Qualification extends Record {
        private $id;
        public $qualification;
        public $applicationId;
        public $qualificationType;

        public function __construct($id=null){
            if(isset($id)){
                $this->id = $id;
                $qualification = 
                $this->qualification;
                $this->applicationId;
                $this->qualificationType;
            }
        }
    }

    class QualificationMapper extends Mapper {

        public $table = 'applicationQualifications';

        public function __construct(){
            parent::__construct();
        }

        public function getQualifications($applicationId){
            $filter = simpleFilter(['applicationId'=>$applicationId]);
            
            $SQL = "SELECT * FROM applicationQualifications WHERE ".$filter['filter'];
            return read($this->conn, $SQL, $filter['params']);
    }
}
?>