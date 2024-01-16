<?php
// require_once "skills.php";
$skillSQL = "SELECT * FROM skills JOIN skillTypes ON skillTypes.id = skills.skillType JOIN skillLevel ON skillLevel.id = skills.level";
$qualificationActivitySQL = "SELECT * FROM activities JOIN qualificationActivities ON qualificationActivities.activityId = activities.id";
?>