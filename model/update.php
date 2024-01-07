<?php
    require_once __DIR__."/index.php";

    $SQL = "UPDATE jobActivities SET description=:description";
    if(!$query->{'criteria'}){
        die;
    };
    $WHERE = setCriteria($query->{'criteria'});
    $SQL = $SQL." WHERE ".$WHERE['criteria'];
    $data = update($connection, $SQL, array_merge($inputs, $WHERE['params']));
    echo json_encode([
        "data"=>$data,
        // "SQL"=>$SQL,
        // "inputs"=>array_merge($inputs,$WHERE['params'])        
    ]);
?>