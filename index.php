<?php
// include main configuration file
    require_once __DIR__."/env/config.php";
    require_once __DIR__. "/config/config_defs.php";

    
    // session_start();
    
    // $connection = Database::connect();

    // try{
    // $res['input'] = $_POST;
    // $res['params'] = json_decode(base64_decode($_SERVER['QUERY_STRING']));
    // $res['server'] = $_SERVER;
//connect to the database.   

// generic code for selecting mode and connecting to database...
        // $apiCall = (new $queryString['class']($db->connection));
        // $apiCall = (new $queryString['class']());
// chooses the action to be completed and passes paramneters to action.
        // switch ($method) {
        //     case 'GET':
        //         $apiCall->{$queryString['action']}($queryString);
        //         break;
        //     case 'POST':
        //         $apiCall->{$queryString['action']}($params);
        //         break;
        //     case 'DELETE':
        //         break;
        //     default:
        //         $apiCall->{$queryString['action']}($params);
        //         break;
        // }
// returns output from models to response object

        // $res['data'] = $apiCall->getOutput();
        
        // echo json_encode($res);
        // $db->disconnect();
    // } catch (Exception $err){
        // $db->disconnect();
        // echo json_encode($err);
    // }

?>