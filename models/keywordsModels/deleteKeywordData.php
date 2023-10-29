<?php

class DeleteKeywordData extends KeywordData {

    function __construct($connection) {
        $this->connection = $connection;
    }

    public function delete($inputs) {
        $SQL = "DELETE FROM tblKeywords WHERE id = ?";
        $params = array($inputs['id']);

        try{
            $stmt = $this->connection->prepare($SQL);
            $stmt->execute($params);
            $affected_rows = $stmt->rowCount();
            // $newIDs[] = $this->connection->lastInsertId();
            $this->output = array(
                'rows deleted' => $affected_rows,
                'ID' => $params['id']
            );}
        catch (Exception $e){
            $this->output = $e->getMessage();

        }
        
    }

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
}

?>