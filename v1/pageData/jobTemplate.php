<?php
    require_once "../api.php";

    $jobId = $queryArray['parsed']['jobId'];

    $res = new Job($jobId);

    respond($res);
?>