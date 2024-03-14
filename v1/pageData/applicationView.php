<?php

include_once "../api.php";

switch ($method) {
    case 'GET':
        try{
        $res['application'] = (new ApplicationMapper)->getApplications($queryArray);
        } catch (Exception $e) {
            $res['error']=$e->getMessage();
        }
        respond($res);
        break;
    
    default:
        # code...
        break;
}