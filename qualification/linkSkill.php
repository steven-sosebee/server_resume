<?php
    require_once __DIR__."/index.php";
    $SQL = "INSERT INTO qualificationSkills (qualificationId, skillId) VALUES (:qualificationId, :skillId)";
    include __DIR__."/../model/create.php";
?>