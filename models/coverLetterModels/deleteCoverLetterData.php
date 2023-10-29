<?php

class DeleteCoverLetterData extends KeywordData {

    function __construct($connection) {
        $this->connection = $connection;
    }

    public function delete($inputs) {
        $SQL = "DELETE FROM tblCoverLetterSegments WHERE id = ?";
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


}

?>