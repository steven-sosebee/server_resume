<?php
    // require_once __DIR__."/index.php";
    // $SQL = "INSERT INTO jobActivities (description, jobId) VALUES (:description, :jobId)";
    $data = create($connection, $SQL, $inputs);
    echo json_encode([
        "data"=>$data
    ]);
?>