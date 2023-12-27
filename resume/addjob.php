<?php
    require_once __DIR__."/index.php";
    $SQL = "INSERT INTO resumeJobs (title, description, resumeId, start, end) VALUES (:title, :description, :resumeId, :start, :end)";
    $data = create($connection, $SQL, $inputs);
    echo json_encode([
        "data"=>$data
    ]);
?>