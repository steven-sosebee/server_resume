<?php

require_once "../api.php";

switch ($method) {
    case 'POST':
        try{
            function createActivities($inputs){
                // $inputs = setInputs($inputs);
                return (new QualificationActivityMapper)->createOne($inputs);
            }
            $res = array_map('createActivities',$HTTPinputs);
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        respond($res);
        break;

    case "DELETE":
        try {
            // $res = $api;
            $res = (new QualificationActivityMapper)->deleteRecords($queryArray);
        } catch (Exception $e){
            $res = $e->getMessage();
        }
        respond($res);
    case "PATCH":
        try{
            $res = (new QualificationActivityMapper)->updateRecords($queryArray,$HTTPinputs);
        } catch (Exception $e){
            $res= $e->getMessage();
        }
        respond($res);
    default:
        # code...
        break;
}