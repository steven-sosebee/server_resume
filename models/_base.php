<?php
    class API {
        protected $connection;

// utility functions to generate queries
        function __construct(){
            $this->db = Database::getInstance();
            $this->connection = $this->db->connection;
            $this->output['status'] = 'not started';
            $this->SQLType = array(
                'SELECT'=>0,
                'INSERT'=>1,
                'DELETE'=>2,
                'UPDATE'=>3
            );
        }

        function getKeys(array $array){
            $keys=array_keys($array);
            
            return $keys;
        }

        function setConditions(array $conditions) {
            
            $ORconstraints = array();
            $params = array();

            foreach ($conditions as $OR){
                $ANDconstraints = array();
                foreach ($OR as $AND) {
                    $ANDconstraints[] = $AND['constraint'];
                    $params[$AND['key']] = $AND['param'];
                }

            $ORconstraints[] = implode(' AND ', $ANDconstraints);

        }
            $constraints = "(".implode(") OR (", $ORconstraints).")";

            return array('conditions'=>$conditions, 'constraints'=>$constraints, 'params'=>$params);
        }

        function setParams(array $params) {
            $return=array();
            foreach ($params as $key=>$value) {
                $return[":".$key] = $value;
            }
            return $return;
        }

        function setValues(array $fields){
            $return = array();
            foreach ($fields as $key=>$values){
                $return[]=":".$values;
            }
            $return = implode(", ",$return);
            return $return;
        }

        function setUpdates (array $updates){
            $return = array();
            foreach($updates as $update){
                $return = $field."=:".$field;
            }
            return $return;
        }        

        function setSQL(int $queryType, string $table, array $fields=array('*'), array $values=NULL, string $conditions=NULL){
            $SQLfields = implode(", ",$fields);
            
            
            switch ($queryType) {
                case 0:
                    $SQL = "SELECT ".$SQLfields." FROM ".$table;
                    if($conditions){$SQL = $SQL." WHERE ".$conditions;};
                    break;
                case 1:
                    $values = $this->setValues($fields);
                    $SQL = "INSERT INTO ".$table." (".$SQLfields.") VALUES (".$values.")";
                    break;
                case 2:
                    $SQL = "DELETE FROM ".$table." WHERE ".$conditions;
                    break;
                case 3:
                    $updates = $this->setUpdates($fields);
                    $SQL = "UPDATE ".$table." SET ".$updates." WHERE ".$conditions;
                    break;
                default:
                    $SQL = "SELECT ".$SQLfields." FROM ".$table;
                    break;
            };

            return $SQL;
        }

// Execute a query on the database...

        function startTransaction($commit = true) {
            try{
                if(!$this->db->inTransaction){
                    $this->connection->beginTransaction();
                    $this->db->inTransaction=true;
                }
                if($commit) {
                    $this->db->commit = $commit;
                }
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
        }

        function endTransaction() {
            try{
                if ($this->db->inTransaction) {
                    // $this->connection->beginTransaction();
                    $this->db->inTransaction=false;
                };
                if ($this->db->commit) {
                    $this->connection->commit();
                    $this->db->commit = false;
                };
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
        }

        function executeQuery($SQL, $params) {
            try{
                $stmt = $this->connection->prepare($SQL);
                $stmt->execute($params);
                
            }
            catch (Exception $e){
                $error = $e->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            return $stmt;
        }

        function executeInsert($SQL, $params) {
            try {
                $stmt = $this->executeQuery($SQL, $params);
                $this->output['$stmt']=$stmt;
                
            }
            catch (Exception $e){
                $error = $e->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            $data = array(
                'stmt' => $stmt,
                'rows inserted' => $this->getAffectedRows($stmt),
                'ID' => $this->getNewID($stmt)
            );
            return $data;
        }

        function executeDelete($SQL, $params) {
            try {
                $stmt = $this->executeQuery($SQL, $params);
                $data = array(
                    'rows deleted' => $this->getAffectedRows($stmt)
                );
            }
            catch (Exception $e){
                $error = $e->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            return $data;
        }

// Get data outputs from executed statement...

        function getData($stmt){
            try{
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            return $data;
        }

        function getnewID($stmt){
            return $this->connection->lastInsertId();
        }

        function getAffectedRows($stmt){
            try{
            $return = $stmt->rowCount();
            }
            catch (Exception $e){
                $error = $e->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            return $return;
        }
        
        function getOutput(){
            return $this->output;
        }

        function getInsertedId(){
            return $this->output['newRecords']['IDs'][0];
        }

        function groupBy($data, $groupBy){
            $result = [];
            foreach ($data as $i){
                $result[$i[$groupBy]][]=$i;
            }
            return $result;
        }

        function uuid ($length){
            $bytes = random_bytes($length/2);
            $bytes = bin2hex($bytes);
            return $bytes;
        }

        function getInputs($inputs) {
            return $inputs;
        }
// API Access functions

    public function getRecords ($inputs){
        $where=array('constraints'=>NULL,'params'=>array());

        if(array_key_exists('conditions',$inputs)){
            $where=$this->setConditions($inputs['conditions']);
        }
        // create SQL queries for call...
        $SQL = $this->setSQL(
            queryType:$this->SQLType['SELECT'],
            table:$this->table,
            conditions:$where['constraints']
        );
        $records = $this->read($SQL,$where['params']);  
        
        if(array_key_exists('groupBy',$inputs)){
            $records = $this->groupBy($records,$inputs['groupBy']);
        }
        $this->output['data']=$records;
        $this->output['status']='complete';    
    }

    public function updateRecords ($inputs,$entry=true){
        $records = $inputs['records'];
        $where=$this->setConditions($inputs['conditions']);
        foreach ($records as $record){
            $updateFields = array_merge($this->defaultValues,$record);
            $params = $this->setParams($updateFields);
            $fields = $this->getKeys($updateFields);
            $updateSQL = $this->setSQL(
                queryType:$this->queryType('UPDATE'),
                table:$this->table,
                fields:$updateFields
            );

        }
    }
    
    public function insertRecords ($inputs,$entry=true){
        $records = $inputs['records'];
        $newRecords = array();
        $recordsAdded = 0;
            
        if($entry){$this->startTransaction();};
        foreach ($records as $record) {
            $insertFields = array_merge($this->defaultValues,$record);
            $params = $this->setParams($insertFields);
            $fields = $this->getKeys($insertFields);
            $SQL = $this->setSQL(queryType:$this->SQLType['INSERT'],table:$this->table,fields:$fields);
            $insert = $this->create($SQL,$params);
            if(array_key_exists('ID',$insert) && array_key_exists('rows inserted',$insert)){
                $recordsAdded += $insert['rows inserted'];
                $newRecords[]=$insert['ID'];
            }
        };
        if($entry){$this->endTransaction();};
        $data = array(
            'inputs'=>$records,
            'IDs' => $newRecords,
            'records' => $recordsAdded
        );
        $this->output['newRecords'] = $data;
        $this->output['status']='complete';
    }

public function deleteRecords ($inputs,$entry=true){
    
    // set variables for the function...
    $deletedRecords = array();
    $recordsDeleted = 0;
    $where=$this->setConditions($inputs['conditions']);

    // // create SQL queries for call...
    $deleteSQL = $this->setSQL(
        queryType:$this->SQLType['DELETE'],
        table:$this->table,
        conditions:$where['constraints']
    );
    $selectSQL = $this->setSQL(
        queryType:$this->SQLType['SELECT'],
        table:$this->table,
        conditions:$where['constraints']
    );

    // begin transaction...
    if($entry){$this->startTransaction();};
    
    $records = $this->read($selectSQL,$where['params']);
    $delete = $this->delete($deleteSQL,$where['params']);
    if(array_key_exists('rows deleted',$delete)){
        $recordsDeleted += $delete['rows deleted'];
    }

    if($entry){$this->endTransaction();};
    
    $data = array(
        'records' => $records,
        'records deleted' => $recordsDeleted
    );

    // set output for API calls...

    $this->output['data'] = $data;
    $this->output['status']='complete';    
}

// CRUD functions
                
        function create ($SQL,$params=array()) {
            
            $data = $this->executeInsert($SQL,$params);
            return $data;
        }


        function read ($SQL, $params=array()) {
            try{
            $stmt = $this->executeQuery($SQL,$params);
            $data = $this->getData($stmt);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            catch (PDOException $pdo){
                $error = $pdo->getMessage();
                $this->output['error'] = $error;
                return $error;
            }
            return $data;
        }


        function delete ($SQL, $params=array()) {
            $data = $this->executeDelete($SQL, $params);
            return $data;
        }


        function update ($SQL, $params=array()) {
            $stmt = $this->executeQuery($SQL, $params);
            $data = $this->getData($stmt);

            return $data;
        }
    }
?>