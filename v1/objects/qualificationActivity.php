<?php
    require_once "../api.php";
    
    $table = "qualificationActivities";
    $activitiesTable = "activities";

    switch ($method) {
        case 'GET':
            $SQL = SELECTQuery($table,'*',$filter);
            $res = read($db,$SQL,$filterParams);            
            break;
        
        case 'POST':
            $inputArray = array_map('setInputs',$HTTPinputs);
           try{

            $inputActivities = array_map(function ($item) {
                return ['activity'=>$item['activity']];},$HTTPinputs);
            $inputArray = array_map('setInputs',$inputActivities);
               $res=array();
               $db->connection->beginTransaction();
               $i=0;
               foreach ($inputArray as $inputs){
        
                   $SQL = INSERTQuery($inputs,$activitiesTable);
                   $params = $inputs['params'];
                   $newActivityId = create($db, $SQL, $params);
                   $linkTableInputs = ['activityId'=>$newActivityId['ID'],'qualificationId'=>$HTTPinputs[$i]['qualificationId']];
                   $linkTableParams = setInputs($linkTableInputs);
                   $linkSQL = INSERTQuery($linkTableParams,$table);
                   
                   $res[] = create($db, $linkSQL, $linkTableParams['params']);
                   $i++;
                }
                $db->connection->commit();  
            } catch (Exception $e){
                $res=$e->getMessage();
            }
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
            
            $test = array_map(function ($item) {
                return ['activity'=>$item['activity']];},$HTTPinputs);
            $res = [
                'inputs'=>$HTTPinputs,
                // 'inputArray'=>array_map('setInputs',array_column($HTTPinputs,'activity')),
                'element'=>$test,
            ];
            break;

        default:
            # code...
            break;
    }

    respond($res);
    // respond([
    //     'test'=>$res,
    //     'SQL'=>$SQL,
    //     'params'=>$params,
    //     // 'api'=>$api,
    //     'inputs'=>$inputs,
    //     'newID'=>$newActivityId,
    //     'newParams'=>$newActivityParams,
    // ]);
?>