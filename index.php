<?php
// include main configuration file
    require_once __DIR__."/env/config.php";
    require_once __DIR__. "/config/config_defs.php";
    session_start();


    $db_test = $publicConfig['DB_ROOT'].$publicConfig['DB_RESUME'];

    $db = new DBConnection($db_test);

    $res['url'] = $uri;
    $res['params'] = $params;
    
    try{
    
//connect to the database.   
        $db->connect();
        $res['connection'] =$db->getConnectionDetails();

// generic code for selecting mode and connecting to database...
        $apiCall = (new $queryString['class']($db->connection));
    
// chooses the action to be completed and passes paramneters to action.
        switch ($method) {
            case 'GET':
                $apiCall->{$queryString['action']}($queryString);
                break;
            case 'POST':
                $apiCall->{$queryString['action']}($params);
                break;
            case 'DELETE':
                break;
            default:
                $apiCall->{$queryString['action']}($params);
                break;
        }
// returns output from models to response object

        $res['data'] = $apiCall;

        echo json_encode($res);
        $db->disconnect();
    } catch (Exception $err){
        $db->disconnect();
        echo json_encode($err);
    }

?>