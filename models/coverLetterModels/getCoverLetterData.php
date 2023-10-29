<?php

class GetCoverLetterData {

    function __construct($connection){
        $this->connection=$connection;
    }

    public function list($inputs) {
        $SQL = "SELECT * FROM tblCoverLetterSegments";
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

    public function select($inputs) {
        $SQL = "SELECT * FROM tblCoverLetterSegments WHERE id = ?";
        $params = array(
            $inputs['id']
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