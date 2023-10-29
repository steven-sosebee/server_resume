<?php

class CreateKeywordData extends KeywordData {

    function __construct($connection) {
        $this->connection = $connection;
    }

    public function submit($inputs) {
        $SQL = "INSERT INTO tblKeywords (keyword, type) VALUES (?,?)";
        $params = array($inputs['keyword'], $inputs['type']);

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