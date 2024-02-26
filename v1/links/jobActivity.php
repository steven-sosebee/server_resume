<?php
    require_once "../api.php";
    $table = 'jobActivities';
    $inputs = array_map('setInputs',$HTTPinputs);
    
    switch ($method) {
        case 'GET':
                        
            break;
        
        case 'POST':
            try{
                
                
                function extractColumn($item,$field) {         
                    return $item[$field];
                }

                $executions = array_map('INSERTQuery',$inputs,array_fill(0,count($inputs),$table));
                $executionParams = array_map('extractColumn',$inputs,array_fill(0,count($inputs),'params'));
                $res = array_map('create',array_fill(0,count($executions),$db),$executions,$executionParams);
                
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
            // $res=$inputs;
            $res = [
                'inputs'=>$inputs,
                'error'=>$error,
                'executions'=>$executions,
                'executionParams'=>$executionParams,
                'data'=>$res
            ];
            break;

        case 'DELETE':
            
            
            break;

        case "PUT":
            
        default:
            # code...
            break;
    }

    respond($res);
?>