<?php
require_once __DIR__."/env/config.php";
require_once __DIR__."/database.php";
require_once __DIR__."/crud.php";
require_once __DIR__."/queryCreation.php";
$db = Database::getInstance();

$connection = $db->connection;
$inputs = json_decode(file_get_contents("php://input"),true);
if(isset($_GET['q'])){
    $query = json_decode(base64_decode($_GET['q']));
}

?>