<?php
    class API {
        protected $connection;
// Execute a query on the database...
        function executeQuery($SQL, $params) {
            $stmt = $this->connection->prepare($SQL);
            $stmt->execute($params);
            return $stmt;
        }
// Get data outputs from executed statement...

        function getData($stmt){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function getnewID($stmt){
            return $this->connection->lastInsertId();
        }

        function getAffectedRows($stmt){
            return $stmt->rowCount();
        }
        
        function output(){
            return $this->output;
        }

        // Create Data

        public function submit($inputs) {
            
            try{
                $stmt = self::executeQuery($SQL,$params);
                $this->output = array(
                    'rows inserted' => self::getAffectedRows($stmt),
                    'ID' => self::getNewID($stmt)
                );}
            catch (Exception $e){
                $this->output = $e->getMessage();
            }
        }

// Get Data
        public function list($inputs) {
            $SQL = "SELECT * FROM ".self::TABLE;
            $params = array();
            try{
                $stmt = self::executeQuery($SQL, $params);
                $this->output = self::getData($stmt);
            }
            catch (Exception $e){
                $this->output = $e->getMessage();

            }
        }

        public function select($inputs) {
            $SQL = "SELECT * FROM ".self::TABLE." WHERE id = ?";
            $params = array(
                $inputs['id']
            );
            try{
                $stmt = self::executeQuery($SQL, $params);
                $this->output = self::getData($stmt);
            }
            catch (Exception $e){
                $this->output = $e->getMessage();

            }
        }

// Delete Data

        public function delete($inputs) {
            $SQL = "DELETE FROM ".self::TABLE." WHERE id = ?";
            $params = array(
                $inputs['id']
            );
            try{
                $stmt = self::executeQuery($SQL,$params);
                $this->output = array(
                    'rows deleted' => self::getAffectedRows($stmt)
                );}
            catch (Exception $e){
                $this->output = $e->getMessage();
            }
        }
}
?>