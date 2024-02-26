<?php
    require_once "../api.php";


    class Application extends Record {
        private $id;
        public $title;
        public $organization;
        public $link;
        public $status;

        public function __construct($id=null){
            if(isset($id)){
                $this->id = $id;
                $application = (new ApplicationMapper)->getOne($id);
                $this->title = $application[0]['title'];
                $this->organization = $application[0]['organization'];
                $this->link = $application[0]['link'];
                $this->status = $application[0]['status'];
                $this->qualifications = (new QualificationMapper)->getQualifications($application[0]['id']);
            }
        }

        public function getQualifications($applicationId){
            $mapper = new ApplicationMapper;
            return $mapper->getQualifications($applicationId);
        }
    }

    class ApplicationMapper extends Mapper {
        public $table = 'applications';

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