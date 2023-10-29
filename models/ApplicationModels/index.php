<?php
    // require 'getApplicationData.php';
    // require 'createApplicationData.php';
    // require_once 'deleteApplicationData.php';
    
    class ApplicationData extends API {
        private const TABLE = 'tblApplications';
        private static $submit_SQL = "INSERT INTO ".self::TABLE." (title, company, link, status) VALUES (?,?,?,?)";         

        function __construct($connection){
            $this->connection = $connection;
        }

// Create Data

        public function submit($inputs) {
            $SQL = "INSERT INTO ".self::TABLE." (title, company, link, status) VALUES (?,?,?,?)";
            $params = array(
                $inputs['title'],
                $inputs['company'],
                $inputs['link'],
                'Not Submitted'
            );
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
            $SQL = "SELECT * FROM ".self::TABLE." ORDER BY title" ;
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