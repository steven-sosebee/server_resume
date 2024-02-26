<?php
    require_once __DIR__."/Activity.php";
    require_once __DIR__."/Job.php";
    require_once __DIR__."/Resume.php";
    require_once __DIR__."/Application.php";
    require_once __DIR__."/ResumeJSON.php";
    require_once __DIR__."/Qualification.php";
    require_once __DIR__."/Skill.php";
    class Record {

        public function convertToArray(){
            return get_object_vars($this);
        }
    }

    class Mapper {
        protected $conn;

        public function __construct(){
            $this->conn = Database::getInstance();
        }

        public function getOne($id){
            $inputs = simpleFilter(["id"=>$id]);
            $SQL = SELECTQuery($this->table,'*',$inputs['filter']);
            $params = $inputs['params'];
            return read($this->conn, $SQL, $params);
        }

        public function getAll(){
            $SQL = "SELECT * FROM $this->table";
            return read($this->conn,$SQL);
        }
        
        public function getLastId(){
            return $this->conn->lastInsertId();
        }

        // public function getMany($filter)
        public function createOne($values, $table){
            $inputs = setInputs($values);
            $SQL = INSERTQuery($inputs,$table);
            // return ['sql'=>$SQL, 'inputs'=>$inputs];
            return create($this->conn,$SQL,$inputs['params']);
        }

        // protected function read();  
    }
?>