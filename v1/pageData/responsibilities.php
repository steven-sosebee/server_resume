<?php

require_once "../api.php";

switch ($method) {
    case 'GET':
        try{
            $res = (new ResponsibilityMapper)->getAll();
        } catch (Exception $e){
            $res = $e->getMessage();
        }
        respond($res);
        break;

    case 'POST':
        try {
            $inputs = $HTTPinputs;
            // $res['inputs'] = $inputs;
            $res = (new ResponsibilityMapper)->createOne($inputs[0], 'responsibilities');
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        respond($res);
        break;

    case 'DELETE':
        try {
            $res = (new ResponsibilityMapper)->deleteRecords($queryArray);
        } catch (Exception $e) {
            $res = $e->getMessage();
            $res['api'] = $api;
        }
        respond($res);
        break;
    default:
        # code...
        break;
}