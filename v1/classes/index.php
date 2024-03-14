<?php
    require_once __DIR__."/Activity.php";
    require_once __DIR__."/Job.php";
    require_once __DIR__."/Resume.php";
    require_once __DIR__."/Application.php";
    require_once __DIR__."/ResumeJSON.php";
    require_once __DIR__."/Qualification.php";
    require_once __DIR__."/QualificationActivity.php";
    require_once __DIR__."/Skill.php";
    require_once __DIR__."/Responsibility.php";

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
            try{
                $inputs = simpleFilter(["id"=>$id]);
                $SQL = SELECTQuery($this->table,'*',$inputs['filter']);
                $params = $inputs['filterParams'];
                return read($this->conn, $SQL, $params);
            } catch (Exception $e){
                return $e->getMessage();
            }
        }

        public function getFiltered($filter, $fields='*'){
            try{
                $SQL = SELECTQuery($this->table, $fields,$filter['filter']);
                return read($this->conn,$SQL, $filter['filterParams']);
            } catch (Exception $e){
                return $e->getMessage();
            }
        }
        public function getAll(){
            $SQL = "SELECT * FROM $this->table";
            return read($this->conn,$SQL);
        }
        
        public function getLastId(){
            return $this->conn->lastInsertId();
        }

        
        public function createOne($values, $table=null){
            if(
                !isset($table)
                ){
                    $table=$this->table;
                };
            $inputs = setInputs($values);
            $SQL = INSERTQuery($inputs,$table);
            // return ['sql'=>$SQL, 'inputs'=>$inputs];
            return create($this->conn,$SQL,$inputs['params']);
        }

        public function deleteRecords($filter){
            try {
            $SQL = "DELETE FROM ".$this->table." WHERE ".$filter['filter'];
            // return $SQL;
            return delete($this->conn, $SQL, $filter['filterParams']);
            } catch (Exception $e) {
                return $e->getMessage();
            }

        }

        public function updateRecords($filter, $updates){
            try{
                $SQL = UPDATEQuery($updates, $this->table, $filter['filter'], $filter['filterParams']);
                return update($this->conn, $SQL['SQL'], $SQL['params']);
            } catch (Exception $e){
                return $e->getMessage();
            }
        }
        // protected function read();  
    }
?>