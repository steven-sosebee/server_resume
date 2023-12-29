<?php
    require_once __DIR__."/index.php";
    $SQL = "INSERT INTO resumeJobs (title, description, organization, resumeId, start, end) VALUES (:title, :description, :organization, :resumeId, :start, :end)";
    $data = create($connection, $SQL, $inputs);
    echo json_encode([
        "data"=>$data
    ]);
?>