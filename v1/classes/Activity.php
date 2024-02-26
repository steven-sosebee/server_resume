<?php
    require_once "../api.php";

    class Activity extends Record {

        private $id;
        public $activity;
        
        public function __construct ($activity){
            $this->activity = $activity;
        }

        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }
    }

    class ActivityMapper extends Mapper{
        public $table = 'activities';

        public function __construct(){
            parent::__construct();
        }
        public function create(Activity $activity){
            $arr = $activity->convertToArray();
            // return $arr;
            return $this->createOne($arr, $this->table);
        }

        // public function linkToJob(Activity $activity,$jobId);

        public function getJobActivities($jobId){
            $filter = simpleFilter(['jobId'=>$jobId]);
            
            $SQL = "SELECT activities.id id, activity FROM activities JOIN jobActivities ON jobActivities.activityId = activities.id WHERE ".$filter['filter'];
            return read($this->conn, $SQL, $filter['params']);


        }
    }
?>