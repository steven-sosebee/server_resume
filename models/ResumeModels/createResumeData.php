<?php

class CreateResumeData {
        protected $connection;

        function __construct($connection, $inputs){
            $this->connection=$connection;
            $SQL = "INSERT INTO tblApplications (job, company, link, status) VALUES (?,?,?,?)";
            $params = array(
                $inputs['job'],
                $inputs['company'],
                $inputs['link'],
                'Not Submitted'
            );
            $stmt = $connection->prepare($SQL);
            $stmt->execute($params);
            $this->affected_rows = $this->affected_rows + $this->stmt->rowCount();
            $this->newIDs[] = $this->connection->lastInsertId();
        }

        
}