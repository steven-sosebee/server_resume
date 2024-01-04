<?php
    require_once __DIR__."/index.php";
    $SQL = "INSERT INTO applicationQualifications (qualification, qualificationType) VALUES (:qualification, :qualificationType)";
    $data = create($connection, $SQL, $inputs);
    echo json_encode([
        "data"=>$data
    ]);
?>