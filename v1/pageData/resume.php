<?php

    include_once "../api.php";
    try{
    $table = "resumes";
    $res = $api;
    $SQL = SELECTQuery($table,'*',$filter);
    $res = read($db,$SQL,$filterParams);            
    } catch (Exception $e){
        $res = $e->getMessage();
    }
    respond($res);
    ?>