<?php
    require_once "../api.php";

    
    switch ($method){

        case 'GET':
            
            $currentResume = (new ResumeJSONMapper)->getResumes();
            $res['skills'] = (new SkillMapper)->getAll();
            $res['jobs'] = (new JobMapper)->getAll();
            $res['resumes'] = $currentResume;
            
            respond($res);
        break;

        case 'OPTIONS':
            
            break;

        case 'PUT':
            
            break;

        case 'POST':
            try {
            $inputs = $HTTPinputs;
            $resumeObj = new ResumeJSON;
            $resumeObj->setValues($inputs['resume'],$inputs['title']);
            $res = $resumeObj->createResume();
            } catch (Exception $e) {
                $res = $e->getMessage();
            }
            respond($res);
            break;            
            
    }

    
?>