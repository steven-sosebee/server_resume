<?php

// Definitions and configs...
    // define("MODELS_PATH", __DIR__."/../models/");
    require_once __DIR__."/../env/config.php";
    
    $privateConfig = parse_ini_file(PROJECT_ROOT_PATH.'/../private/config.ini');
    $publicConfig = parse_ini_file(__DIR__.'/config.ini');
    // ini_set("session.save_path", PROJECT_ROOT_PATH."/sessions");
    
    // database configurations
    define("DB_HOST",$privateConfig['db_host']);
    define("DB_USERNAME",$privateConfig['db_userName']);
    define("DB_PASSWORD",$privateConfig['db_password']);
    define("DB_PORT",$privateConfig['port']);
    define("DB_RESUME", $publicConfig['DB_RESUME']);
    define("DB_ROOT", $publicConfig['DB_ROOT']);
    define("DB",DB_ROOT.DB_RESUME);

// Reading API call...
    // $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // $uri = explode( '/', $_SERVER['REQUEST_URI'] );
    // parse_str($_SERVER['QUERY_STRING'], $queryString);
    // $method = $_SERVER['REQUEST_METHOD'];
// API inputs...
    // $params= json_decode(file_get_contents("php://input"),true);

// Models
    
    // require_once MODELS_PATH."_base.php";
   
?>
