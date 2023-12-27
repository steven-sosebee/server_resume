<?php

// Definitions and configs...
    define("MODELS_PATH", __DIR__."/../models/");
    $privateConfig = parse_ini_file(PROJECT_ROOT_PATH.'/../private/config.ini');
    $publicConfig = parse_ini_file(__DIR__.'/config.ini');
    ini_set("session.save_path", PROJECT_ROOT_PATH."/sessions");
    define("DB_HOST",$privateConfig['db_host']);
    define("DB_USERNAME",$privateConfig['db_userName']);
    define("DB_PASSWORD",$privateConfig['db_password']);
    define("DB_PORT",$privateConfig['port']);
    define("EMAIL_HOST",$privateConfig['email_host']);
    define("EMAIL_FROM",$privateConfig['email_from']);
    define("EMAIL_PASSWORD",$privateConfig['email_password']);
    define("EMAIL_PORT", $privateConfig['email_port']);
    define("DB_RESUME", $publicConfig['DB_RESUME']);
    define("DB_ROOT", $publicConfig['DB_ROOT']);
    // define("USERDB", $privateConfig['userDB']);
    // define("PUBLIC_KEY",$privateConfig['push_PublicKey']);
    // define("PRIVATE_KEY",$privateConfig['push_PrivateKey']);
    // define("SUB", $privateConfig['push_sub']);

// Reading API call...
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $_SERVER['REQUEST_URI'] );
    parse_str($_SERVER['QUERY_STRING'], $queryString);
    $method = $_SERVER['REQUEST_METHOD'];
// API inputs...
    $params= json_decode(file_get_contents("php://input"),true);

// Models
    
    require_once MODELS_PATH."_base.php";
    // require_once MODELS_PATH."test.php";
    require_once MODELS_PATH."resume.php";
    require_once MODELS_PATH."application.php";
    require_once MODELS_PATH."job.php";
    require_once MODELS_PATH."skill.php";
    require_once MODELS_PATH."responsibility.php";
    require_once MODELS_PATH."duty.php";
    require_once MODELS_PATH."accomplishment.php";
    require_once MODELS_PATH."templateAccomplishment.php";
    require_once MODELS_PATH."resumeTemplate.php";
    // require MODELS_PATH."test.php";
    // require_once MODELS_PATH."keyword.php";
    // require_once MODELS_PATH."coverLetter.php";
    
    // require_once MODELS_PATH."jobs.php";
    // require_once MODELS_PATH."jobs copy.php";
    
    // require MODELS_PATH."connection.php";
    require_once MODELS_PATH."database.php";
    // require_once MODELS_PATH."createApplication.php";
    // require MODELS_PATH."controller.php";

// Push notification models
    // require MODELS_PATH."userConnection.php";

    // $params= json_decode(file_get_contents("php://input"),true);    
?>
