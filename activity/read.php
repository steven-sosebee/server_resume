<?php
require_once __DIR__."/index.php";

    $SQL = "SELECT * FROM jobActivities";
    if ($query->{'criteria'}){
        $WHERE = setCriteria($query->{'criteria'});
        $SQL = $SQL." WHERE ".$WHERE['criteria'];
    }
    $data = read($connection, $SQL,$WHERE['params']);
    echo json_encode([
        "data"=>$data
        
    ]);
?>