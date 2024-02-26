<?php

    require_once "../api.php";
    class Job {

        private $id;
        public $description;
        public $start;
        public $end;
        public $organization;
        public $title;
        
        public function __construct($id = null){
            if(isset($id)){
                $this->id = $id;
                $job = (new JobMapper)->getOne($id);
                $this->start = $job[0]['start'];
                $this->end = $job[0]['end'];
                $this->organization = $job[0]['organization'];
                $this->title = $job[0]['title'];
                $this->activities = (new ActivityMapper)->getJobActivities($id);
            }
        }

        public function new($title, $organization,$start,$end){
            $this->title = $title; 
            $this->organization = $organization;
            $this->start = $start;
            $this->end = $end;
        }

        public function setActivities ($id) {
            $this->activities = $this->getActivities($id);
        }
        public function getActivities ($id) {
            $mapper = new ActivityMapper;
            return $mapper->getJobActivities($id);
            // $this->activities = $mapper;
        }
        
    }

    class JobMapper extends Mapper {
        public $table = "resumeJobs";

        public function __construct(){
            parent::__construct();
        }

        public function getResumejobs($resumeId){
            $filter = simpleFilter(['resumeId'=>$resumeId]);
            $SQL = "SELECT * from resumeJobs WHERE ".$filter['filter'];
            $jobsArray = read($this->conn,$SQL,$filter['params']);
            $res=[];
            foreach ($jobsArray as $job){
                $res[] = new Job($job['id']);
            };
            return $res;


        }

    }
?>