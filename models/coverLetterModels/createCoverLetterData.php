<?php

class CreateCoverLetterData {

    function __construct($connection){
        $this->connection=$connection;
    }

    public function submit($inputs) {
        $SQL = "INSERT INTO tblCoverLetterSegments (topic, segment, type) VALUES (?,?,?)";
        $params = array(
            $inputs['topic'],
            $inputs['segment'],
            $inputs['type']
        );
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

    public function linkSegment($inputs) {
        $SQL = "";
        $params = array();
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