<?php

    require_once "../api.php";

    switch ($method) {
        case 'GET':
            $res = (new ResumeJSONMapper)->get();
            respond($res);
            break;
        
        default:
            # code...
            break;
    };