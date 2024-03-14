<?php
    require_once "../api.php";


    class Application extends Record {
        private $id;
        public $title;
        public $organization;
        public $link;
        public $status;
        public $uuid; 

        public function __construct($id, $title, $organization, $link, $status, $resume_id, $uuid){
            // if(isset($id)){
                $this->id = $id;
                // $application = (new ApplicationMapper)->getOne($id);
                $this->title = $title;
                $this->organization = $organization;
                $this->link = $link;
                $this->status = $status;
                $this->resume_id = $resume_id;
                $this->uuid = $uuid;
                $this->resume = (new ResumeJSONMapper)->getResumes(simpleFilter(['id'=>$resume_id]));
                $this->qualifications = (new QualificationMapper)->getQualifications($id);
            // }
        }

        public function getQualifications($applicationId){
            $mapper = new ApplicationMapper;
            return $mapper->getQualifications($applicationId);
        }

    }

    class ApplicationMapper extends Mapper {
        public $table = 'applications';
        private $JSON_OBJECT = 
            "SELECT JSON_OBJECT(".
                "'qualifications', JSON_ARRAYAGG(SELECT * FROM applicationQualifications WHERE applicationId=),".
                "'key2', 'value2'".
            ") FROM your_table";
        
        public function __construct(){
            parent::__construct();
        }
        
        public function linkResume($resumeId,$id){
            $updateArray = ['resume_id'=>$resumeId];
            $filterArray = ['id'=>$id];
            $filter = setFilter($filterArray);
            // $updates = setUpdates($updateArray);
            $query = UPDATEQuery($updateArray,$this->table,$filter['filter'],$filter['filterParams']);
            return update($this->conn,$query['SQL'],$query['params']);
        }

        public function getQualifications($applicationId){
            $filter = simpleFilter(['applicationId'=>$applicationId]);

            $array = read($this->conn, $SQL, $filter['params']);          
        }

        public function getApplications($filter){
            try{
           $records = parent::getFiltered($filter);
            // $data = $records;
           foreach($records as $application){
                $data[] = (new Application($application['id'], $application['title'], $application['organization'],$application['link'],$application['status'],$application['resumes_id'], $application['uuid']));
           }
           return $data;
        } catch (Exception $e){
            return $e->getMessage();
        }
        }
    }
?>