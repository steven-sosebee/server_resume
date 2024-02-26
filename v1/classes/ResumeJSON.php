<?php
    require_once "../api.php";

    class ResumeJSON extends Record {

        private $id;
        public $resume;
        public $name;
        protected $uuid;

        public function __construct($id=null){
            if(isset($id)){
                $this->id=$id;
                $resume = (new ResumeJSONMapper)->getOne($id);
                $this->name = $resume[0]['name'];
                $this->resume = json_decode($resume[0]['resume']);
            }
        }

        public function setValues($resume,$name){
            $this->resume = json_encode($resume);
            $this->name = $name;
            $this->uuid = uuid(36);
        }

        public function createResume(){
            return (new ResumeJSONMapper)->createOne($this->convertToArray(),'resumes');
        }
    }


    class ResumeJSONMapper extends Mapper {
        protected $table = 'resumes';

        public function __construct(){
            parent::__construct();
        }
        
        public function get(){
            $SQL = "SELECT * FROM resumes";
            $arr = read($this->conn,$SQL);
            return array_map(function($item){
                return ['id'=>$item['id'], 'name'=>$item['name'],'resume'=>json_decode($item['resume']), 'uuid'=>$item['uuid']];
                // return (new ResumeJSON())->setValues($item['resume'],$item['name']);
            },$arr);
        }

        public function copy($oldId,$newName){
            $oldResume = new ResumeJSON($oldId);
            $newResume = new ResumeJSON;
            $newResume->setValues(json_encode($oldResume->resume),$newName);
            $newResume = $newResume->convertToArray();
            $newRecord = (new ResumeJSONMapper())->createOne($newResume,'resumes');
            // return $newResume;
            return $newRecord;
            
        }   
    }
?>