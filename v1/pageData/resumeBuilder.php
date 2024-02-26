<?php
    require_once "../api.php";

    
    switch ($method){

        case 'GET':
            
            $currentResume = (new ResumeJSONMapper)->get();
            $res['skills'] = (new SkillMapper)->getAll();
            $res['jobs'] = (new JobMapper)->getAll();
            $res['resumes'] = $currentResume;
            
            respond($res);
        break;

        case 'OPTIONS':
            echo json_encode($db);
            // $currentResumeId = $queryArray['parsed']['resumeId'];        
            // $currentResume = (new ResumeJSONMapper)->getOne($currentResumeId);
            // $res = $currentResume;
            // echo json_encode($res->resume);
            // echo json_encode($res[0]['resume']);
            // echo $res[0]['resume'];
            break;

        case 'PUT':
            $currentResumeId = $queryArray['parsed']['resumeId'];
            $newName = $queryArray['parsed']['name'];
            $inputs = [$currentResumeId,$newName];
            $newResume = (new ResumeJSONMapper)->copy($currentResumeId,$newName);
            // respond($inputs);
            respond($newResume);
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
            // echo json_encode($inputs['Jobs']);
            respond($res);
            break;            
            
            // $inputs = $HTTPinputs;
            // $json = json_encode($inputs[0]);
            // $SQL = "INSERT INTO resumes (name, resume) values (?, ?)";
            // $stmt = $db->connection->prepare($SQL);
            // $stmt->bindParam(2,$json);
            // $stmt->bindParam(2,$json);
            // $stmt->execute();
            // $id = $db->connection->lastInsertId();
            // // $insert = create($db, $SQL,);
            // respond([
            //     'inputs'=>$inputs,
            //     'insert'=>$insert,
            //     'SQL'=>$SQL,
            //     'json'=>$json,
            //     'id'=>$id,
            //     'stmt'=>$stmt
            // ]);
    }

    
?>