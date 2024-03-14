<?php
    require_once "../api.php";

    class Qualification extends Record {
        public $id;
        public $qualification;
        public $applicationId;
        public $qualificationType;

        public function __construct($id, $qualification, $applicationId){
            $this->id = $id;
            $this->qualification=$qualification;
            $this->applicationId=$applicationId;
            $this->activities = (new QualificationActivityMapper)->getActivities($id);

        }

    }
    
    class QualificationMapper extends Mapper {

        public $table = 'applicationQualifications';

        public function __construct(){
            parent::__construct();
        }
       
        public function getQualifications($applicationId){
            $filter = simpleFilter(['applicationId'=>$applicationId]);
            $records = parent::getFiltered($filter);      

            foreach ($records as $qualification) {
                $data[] = new Qualification($qualification['id'],$qualification['qualification'],$qualification['applicationId']);
            }
            return $data;
        }

        // public function getActivities($qualificationId){
        //     // $filter = simpleFilter(['qualificationId'=>$qualificationId]);
        //     $records = (new QualificationActivityMapper)->getQualificationActivities($qualificationId)
            
        //     foreach ($records as $activity) {
        //         $return[]=[
        //             "id"=>$record['id'],
        //             "qualification"=>$record['qualification'],
        //             "activities"=>(new QualificationActivityMapper)->getQualificationActivities($record['id'])
        //         ];
        //     }
        // }
    }