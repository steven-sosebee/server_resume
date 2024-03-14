<?php

require_once "../api.php";

switch ($method) {
    case 'GET':
        try{
        $res['resumes'] = (new ResumeJSONMapper)->getResumes();
        $res['application'] = (new ApplicationMapper)->getApplications($queryArray);
        
        } catch (Exception $e) {
            $res=$e->getMessage();
        }
        respond($res);
        break;
    case 'POST':
        try{
            function createQualifications($inputs){
                $inputs = setInputs($inputs);
                return (new QualificationMapper)->createOne($inputs);
            }
            $res = array_map('createQualifications',$HTTPinputs);
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        respond($res);
        break;
    case 'PATCH':
            try {
                $res = (new ApplicationMapper)->updateRecords($queryArray, $HTTPinputs);
            } catch (Exception $e) {
                $res = $e->getMessage();
            }
            respond($res);
        break;
    default:
        # code...
        break;
}