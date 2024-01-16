<?php
    require_once "../api.php";
    
    $table = "qualifications";

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
        default:
            # code...
            break;
    }

    // respond($res);
//   response for debugging purposes;
    respond([
        // 'test'=>$res,
        'SQL'=>$SQL,
        'params'=>$params,
        'api'=>$api,
        'inputs'=>$inputs,
    ]);
?>