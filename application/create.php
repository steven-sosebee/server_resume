<?php
    require_once __DIR__."/index.php";
    $SQL = "INSERT INTO applications (title, organization, link, status) VALUES (:title, :organization, :link, :status)";
    $data = create($connection, $SQL, $inputs);
    echo json_encode([
        "data"=>$data
    ]);
?>