<?php
    require_once __DIR__."/index.php";
    $SQL = "SELECT * FROM skills JOIN qualificationSkills qs ON qs.skillId = skills.id";
    include __DIR__."/../model/read.php";
?>