<?php
    require_once "../api.php";
    
    $table = "activities";
    if(is_array($HTTPinputs)){

        $inputArray = array_map('setInputs',$HTTPinputs);
    }

    switch ($method) {
        case 'GET':
            $SQL = SELECTQuery($table,'*',$filter);
            $res = read($db,$SQL,$filterParams);            
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
            $res = delete($db,$SQL,$filterParams);
            
            break;

        case "PATCH":
            $updates = setUpdates($HTTPinputs);

            $SQL = "UPDATE ".$table." SET ".$updates['updates']." WHERE ".$filter;
            $params = array_merge($updates['params'],$filterParams);
            $res = update($db, $SQL, $params);

        case "OPTIONS":
            $mapper = new ActivityMapper();
            $id = $queryArray['parsed']['id'];
            $jobId = $queryArray['parsed']['jobId'];
            $job = new Job($jobId);
            $res['job'] = $job;
            // $res['get'] = $mapper->getOne($id);
            $record = new Activity($HTTPinputs[0]['activity']);
            // $res['create'] = $mapper->create($record);

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