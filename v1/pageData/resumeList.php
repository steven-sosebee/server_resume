<?php

    require_once "../api.php";

    switch ($method) {
        case 'GET':
            $res = (new ResumeJSONMapper)->get();
            respond($res);
            break;
        
        case 'DELETE':
            try{
                // $res=$queryArray;
            $res = (new ResumeJSONMapper)->deleteRecords($queryArray);
            respond($res);
            } catch (Exception $e){
                respond($e->getMessage());
            }
        default:
            # code...
            break;
    };