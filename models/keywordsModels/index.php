<?php
// require_once "createKeywordData.php";
// require_once "getKeywordData.php";
// require_once "deleteKeywordData.php";
    class KeywordData extends API {
        private const TABLE = 'tblKeywords';
        protected $connection;

        function __construct($connection) {
            $this->connection = $connection;
        }

    // Create Data

        public function applicationKeywords($inputs) {
            $SQL = "SELECT * FROM applicationKeywords WHERE applicationId = ?";
            $params = array(
                $inputs['applicationId']
            );
            try{
                $stmt = $this->connection->prepare($SQL);
                $stmt->execute($params);
                $this->output = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (Exception $e){
                $this->output = $e->getMessage();

            }
        }
    // Delete or unlink data

        public function unlink($inputs) {
            $SQL = "DELETE FROM applicationKeywords WHERE applicationId = ? AND keywordId = ?";
            $params = array($inputs['applicationId'], $inputs['keywordId']);

            try{
                $stmt = $this->connection->prepare($SQL);
                $stmt->execute($params);
                $affected_rows = $stmt->rowCount();
                // $newIDs[] = $this->connection->lastInsertId();
                $this->output = array(
                    'rows deleted' => $affected_rows,
                    'ID' => $params['keywordId']
                );}
            catch (Exception $e){
                $this->output = $e->getMessage();

            }
        }

    // Add or update data

        public function submit($inputs) {
            $SQL = "INSERT INTO tblKeywords (keyword, type) VALUES (?,?)";
            $params = array($inputs['keyword'], $inputs['type']);

        }

        public function link($inputs) {
            $SQL = "INSERT INTO applicationKeywords (keywordId, applicationId) VALUES (?,?)";
            $params = array($inputs['keywordId'], $inputs['applicationId']);

            try{
                $stmt = $this->connection->prepare($SQL);
                $stmt->execute($params);
                $affected_rows = $stmt->rowCount();
                $newIDs[] = $this->connection->lastInsertId();
                $this->output = array(
                    'rows inserted' => $affected_rows,
                    'ID' => $newIDs
                );}
            catch (Exception $e){
                $this->output = $e->getMessage();

            }
        }
    }
?>