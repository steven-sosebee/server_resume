<?php

require "getResumeData.php";
require "updateResumeData.php";
require "createResumeData.php";

class ResumeModel {

    function __construct() {
    }

    function execute($SQL, $params){
        $stmt=$this->connection->prepare($SQL);
        $stmt->execute($params);    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function list($connection){
        $SQL = "SELECT id FROM tblResume";
        $params = array();
        $resumes = $this->execute($SQL,$params);

        foreach ($resume as $key => $value) {
        }
    }
}
// require "deleteResumeData";

?>