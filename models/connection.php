<?php

    class DBConnection {

        function __construct($db = DB, $host = DB_HOST, $port = DB_PORT, $userName = DB_USERNAME, $password = DB_PASSWORD){
            $this->connected = 'not connected';
            $this->password = $password;
            $this->userName = $userName;
            $this->db = $db;
            $this->port = $port;
            $this->host = $host;        
            $this->execParams = [];    
        }
        function __destruct(){
            $this->disconnect();
        }

// standard connectivity
        public function connect(){
            try{
                $this->connection= new PDO(
                    "mysql:host=".$this->host.
                    ";port=".$this->port.
                    ";dbname=".$this->db
                    , $this->userName
                    , $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $this->connected = 'connected';
            } catch (PDOException $e) {                 
                $this->connected = $e->getMessage();
            }
        }
        public function getConnectionDetails(){
            return $this->connected;
        }
// close connection to DB.  TODO add more code for error monitoring.
        public function disconnect(){
            $this->connection = NULL;
        }

        function create () {
            $this->res = 'Create request';
            $this->affected_rows = $this->affected_rows + $this->stmt->rowCount();
                $this->newIDs[] = $this->connection->lastInsertId();
        }
    
        function runQueries (array $queries) {
            $data = array();

            foreach ($queries as $query){
                is_array($query)($this->runQueries($query));
            try{
                $stmt=$this->connection->prepare($query['query']);
                $stmt->execute($query['params']);    

                switch ($query['method']) {
                    case 'READ':
                        $data[] = $this->read($stmt);
                        break;
                    
                    default:
                        # code...
                        break;
                }
                // $data[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ;
            }
            catch( Exception $e){
                $data[] = $e->getMessage();
            };
        }
            return $this->output($data);
        }
    
        function update () {
            $this->res = 'Update request';
        }
    
        function delete () {
            $this->res = 'Delete request';
        }
    
        function read($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function output ($data) {
            return $data;
        }
    }
?>