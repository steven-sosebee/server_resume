<?php
require_once __DIR__."/index.php";

    $SQL = "INSERT INTO resumeTemplates (template) VALUES (:template)";
    
    $data = create($connection, $SQL, $inputs);
    // $data=$inputs;
    echo json_encode($data);
?>