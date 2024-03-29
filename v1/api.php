<?php
    require_once __DIR__."/../config/index.php";
    require_once __DIR__."/objects/connection/database.php";
    require_once __DIR__."/operations/index.php";
    require_once __DIR__."/api/index.php";
    require_once __DIR__."/SQL/index.php";
    require_once __DIR__."/objects/queries/index.php";
    require_once __DIR__."/classes/index.php";
    require_once __DIR__."/config/schema/index.php";

    // Create database connection;
    $db = Database::getInstance();
    // $connection = $db->connection;
    
    // get the HTTP method for determining the endpoint;
    $method = $_SERVER['REQUEST_METHOD'];
    // set defaults
    $query= 'no data';
    $queryArray = 'no data';
    $inputs = 'no data';
    $filtered = false;
    $multiAdd = false;

    // format the inputs;
    $HTTPinputs = json_decode(file_get_contents("php://input"),true);
    
    // check the HTTP request for a query string and parse it if necessary;
    
    
    if(isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING'])>0){
        $filtered = true;
        $queryArray = APIqueryArray($_SERVER['QUERY_STRING']);
        $filter = $queryArray['filter'];
        $filterParams = $queryArray['filterParams'];
    }
   
    $api = [
        'method'=>$method,
        'inputs'=>$HTTPinputs,
        'query'=>$query,
        'array'=>$queryArray,
        'filtered'=>$filtered,
        'HTTPQuery'=>$_SERVER['QUERY_STRING'],
        // 'WHERE'=>$WHERE,
        // 'PATCH'=>$_PATCH,
        'SERVER'=>$_SERVER,
        'multiAdd'=>$multiAdd
        ]

?>