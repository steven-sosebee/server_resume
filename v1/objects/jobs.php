<?php
    require_once "../api.php";
    
    $table = "resumeJobs";
    // $parentTable = 'resumeTemplates';
    // $foreignKey = "qualificationId";
    // $childTable = 'qualificationSkills';
    // $link = 'JOIN '.$parentTable." ON applications.id=applicationQualifications.applicationId";
    // $linkedTables = [
    //     'Skills' => [
    //         'SQL'=>$skillSQL.' JOIN qualificationSkills ON qualificationSkills.skillId = skills.id',
    //         'foreignKey'=>'qualificationId',
    //         'childTable'=>'qualificationSkills'
    //     ],
    //     "Activities" => [
    //         'SQL'=>$qualificationActivitySQL,
    //         'foreignKey'=>'qualificationId',
    //         'childTable'=>'qualificationActivities'
    //     ]
    // ];

    switch ($method) {
        case 'GET':

            $SQL = SELECTQuery($table,'*',$filter);
            $jobs = read($db,$SQL,$filterParams);
            $res = $jobs;

            // foreach ($jobs as $job) {
            //     $primaryId = $job['id'];
                // $skills = readLinkedTable($db,$primaryId,$linkedTables['Skills']['foreignKey'],$linkedTables['Skills']['SQL'],$linkedTables['Skills']['childTable']);
                // $activities = readLinkedTable($db,$primaryId,$linkedTables['Activities']['foreignKey'],$linkedTables['Activities']['SQL'],$linkedTables['Activities']['childTable']);
                // $res[]=[
                    // 'job'=>$job,
                    // 'skills'=>$skills, 
                    // 'activities'=>$activities
                // ];
            // }
            break;
        
        case 'POST':
            $inputArray = array_map('setInputs',$HTTPinputs);
            
            $res=array();
            $db->connection->beginTransaction();
            foreach ($inputArray as $inputs){
                $SQL = INSERTQuery($inputs,$table);
                $params = $inputs['params'];
                $res[] = create($db, $SQL, $params);
            }
            $db->connection->commit();  
            break;

        case 'DELETE':
            
            $SQL = "DELETE FROM ".$table." WHERE ".$filter;
            $res = deleteLink($db,$SQL,$filterParams);
            
            break;

        case "PATCH":
            $updates = setUpdates($HTTPinputs);

            $SQL = "UPDATE ".$table." SET ".$updates['updates']." WHERE ".$filter;
            $params = array_merge($updates['params'],$filterParams);
            $res = update($db, $SQL, $params);
        default:
            # code...
            break;
    }

    respond($res);
//   response for debugging purposes;
    // respond([
    //     'test'=>$res,
    //     'SQL'=>$SQL,
    //     'params'=>$params,
    //     'api'=>$api,
    //     'inputs'=>$inputs,
    // ]);
?>