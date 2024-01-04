<?php
    require_once __DIR__."/index.php";
    $SQL = "DELETE FROM applicationQualifications";
    if(!$query->{'criteria'}){
        die;
    };
    $WHERE = setCriteria($query->{'criteria'});
    $SQL = $SQL." WHERE ".$WHERE['criteria'];
    $data = delete($connection, $SQL, $WHERE['params']);
    
    echo json_encode([
        "data"=>$data
    ]);
?>