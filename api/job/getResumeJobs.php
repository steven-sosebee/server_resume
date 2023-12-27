<?php
    require_once __DIR__."/index.php";
    
    $SQL = "SELECT * FROM resumeJobs";
    if ($query->{'criteria'}){
        $WHERE = setCriteria($query->{'criteria'});
        $SQL = $SQL." WHERE ".$WHERE['criteria'].orderedBy($query->{'ordered'});
    }
    $data = read($connection, $SQL,$WHERE['params']);
    echo json_encode([
        "data"=>$data,
        "ordered"=>orderedBy($query->{'ordered'})
    ]);
    // echo json_encode($data);
?>

