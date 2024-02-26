<?php
    require_once "../api.php";

    class Resume extends Record {

        private $id;
        public $template;
        public $application;

        public function __construct($id = null){
            if(isset($id)){
                $this->id = $id;
                $job = (new ResumeMapper)->getOne($id);
                $this->template = $job[0]['template'];
                $this->applicationId = $job[0]['applicationId'];
                $this->application = new Application($job[0]['applicationId']);
                $this->jobs = (new JobMapper)->getResumeJobs($id);
            }
        }

        public function getApplication($id){
            $mapper = new ApplicationMapper;
            return $mapper->getLinked($id);
        }


    }

    class ResumeMapper extends Mapper {

        public $table = 'resumeTemplates';

        public function __construct(){
            parent::__construct();
        }

        protected function dupe(Resume $obj){
            $dupe = new ResumeMapper().create($obj);
            foreach($obj->jobs as $job){

            }


        }
        public function create(Resume $obj){
            $arr = $obj->convertToArray();
            // return $arr;
            return $this->createOne($arr, $this->table);

        }

        public function duplicateTemplate(Resume $obj) {
            // array_map('function',)
        }
    }
?>


