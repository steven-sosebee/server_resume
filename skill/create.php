<?php
    require_once __DIR__."/index.php";
    $SQL = "INSERT INTO $table (skill, skillType, level) VALUES (:skill, :skillType, :level)";
    // $data = $SQL;
    include __DIR__."/../model/create.php";
    // $data = create($connection, $SQL, $inputs);
    // echo json_encode([
    //     "data"=>$data,
    //     "inputs"=>$inputs
    // ]);
?>