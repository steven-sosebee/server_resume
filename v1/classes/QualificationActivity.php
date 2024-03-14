<?php
    require_once "../api.php";

    class QualificationActivity extends Record {
        private $id;
        public $qualification;
        public $applicationId;
        public $qualificationType;
        public $activities;

        public function __construct(){
        }

    }

    class QualificationActivityMapper extends Mapper {

        public $table = 'qualificationActivities';

        public function __construct(){
            parent::__construct();
        }
       
        public function getActivities($qualificationId){
            $filter = simpleFilter(['qualificationId'=>$qualificationId]);
            
            $SQL = "SELECT * FROM qualificationActivities WHERE ".$filter['filter'];
            return read($this->conn, $SQL, $filter['filterParams']);
    }
}


?>