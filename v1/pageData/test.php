<?php
    require_once "../api.php";

    switch ($method) {
        case 'POST':
            $inputs = $HTTPinputs;
            $resumeObj = new ResumeJSON;
            $resumeObj->setValues($inputs['resume'],$inputs['title']);
            $res = $resumeObj->createResume();
            // echo json_encode($inputs['Jobs']);
            respond($res);
            // respond($resumeObj);
            break;
        
        case 'GET':
        try{
            $currentResume = (new ResumeJSONMapper)->get();
            // $currentResume = new ResumeJSONMapper;
            $res = $currentResume;
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
            respond($res);
            break;
        default:
            # code...
            break;
    }
?>