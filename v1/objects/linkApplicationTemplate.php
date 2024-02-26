<?php
    require_once "../api.php";
    
    $table = 'resumeTemplates';
    // "jobs": "join resumeJobs ON resumeTemplates.id = resumeJobs.resumeId",
    //         "application": "join applications ON applications.id = resumeTemplates.applicationId"
    // $parentTable = "resumeTemplates";
    // $childTable = "resumeJobs";

    $linkedTables = [
        'Jobs' => [
            'SQL'=>"join resumeJobs ON resumeTemplates.id = resumeJobs.resumeId",
            'foreignKey'=>'applicationId',
            'childTable'=>'qualificationSkills'
        ],
        "Activities" => [
            'SQL'=>$qualificationActivitySQL,
            'foreignKey'=>'qualificationId',
            'childTable'=>'qualificationActivities'
        ]
    ]; 
    switch ($method) {
        case 'GET':
            $SQL = SELECTQuery($table,'*',$filter);
            $res = read($db,$SQL,$filterParams);            
            break;
        
        case 'POST':
            // get api inputs for new resumeTemplate
            function resumeInputs ($inputs){
                return ['applicationId'=>$inputs['applicationId'],'template'=>$inputs['template']];
            }
            function jobFilter ($inputs){
                return ['resumeId'=>$inputs['resumeId']];
            }

            $resumeInputs = array_map('resumeInputs',$HTTPinputs);
            $jobFilter = array_map('jobFilter',$HTTPinputs);
            
            $inputArray = array_map('setInputs',$resumeInputs);
            $jobsFilter = array_map('simpleFilter',$jobFilter);
            $res=array();
            // begin transaction
            $db->connection->beginTransaction();
            // loop through all new resumeTemplate links
            $i=0;
            foreach ($inputArray as $inputs){
                // insert new record
                $SQL = INSERTQuery($inputs,$table);
                $params = $inputs['params'];
                $template = create($db, $SQL, $params);
                // get jobs
                // $jobsInputs = setFilter($jobFilter[$i]);
                $jobsSQL = "resumeJobs";
                $jobsSQL = SELECTQuery($jobsSQL,'*',$jobsFilter['filter']);
                $jobs = read($db,$jobsSQL,$jobsFilter['params']);
                $res[] = ['resume'=>$template, 'jobFilter'=>$jobFilter,'jobs'=>$jobs,];

                // get linkedJobs
                // $newJobSQL = "INSERT INTO resumeJobs (title, description, organization, resumeId, start, end) SELECT title, description, organization, $resumeId, start, end FROM resumeJobs where id = $jobId";
            }
            // $db->connection->commit();  
            break;

        case 'DELETE':
            
            $SQL = "DELETE FROM ".$table." WHERE ".$filter;
            $res = delete($db,$SQL,$filterParams);
            
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
    // respond([
    //     'test'=>$res,
    //     'SQL'=>$SQL,
    //     'params'=>$params,
    //     'api'=>$api,
    //     'inputs'=>$inputs,
    // ]);
?>