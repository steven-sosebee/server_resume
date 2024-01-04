<?php
     require_once __DIR__."/index.php";
    $SQL = "UPDATE applications SET ";
    $SQL = setInputs($SQL, $inputs);
    $WHERE = setCriteria($query->{'criteria'});
    $SQL = $SQL." WHERE ".$WHERE['criteria'];

    $data = update($connection, $SQL, array_merge($inputs,$WHERE['params']));

    echo json_encode([
        "data"=>$data,
        "key"=>$SQL
        // "value"=>get_object_vars($inputs)
    ]);
?>