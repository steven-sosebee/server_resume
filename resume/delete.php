<?php
    require_once __DIR__."/index.php";
    $SQL = "DELETE FROM resumeTemplates";
    if(!$query->{'criteria'}){
        die;
    };
    $WHERE = setCriteria($query->{'criteria'});
    $SQL = $SQL." WHERE ".$WHERE['criteria'];
    $data['data'] = delete($connection, $SQL, $WHERE['params']);
    $data['where']=$WHERE;
    $data['query']=$query;
    $data['SQL']=$SQL;
    echo json_encode([
        "data"=>$data
    ]);
?>