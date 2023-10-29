<?php

class GetKeywordData {

    // function __construct($connection){
    //     $this->connection=$connection;
    // }

    public function list($inputs) {
        $SQL = "SELECT * FROM tblKeywords";
        $params = array();
        try{
            $stmt = $this->connection->prepare($SQL);
            $stmt->execute($params);
            $this->output = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            $this->output = $e->getMessage();

        }
    }

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

    
    public function getKeywords($inputs) {
        
    }
}
?>