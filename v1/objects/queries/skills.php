<?php
    $skillSQL = "SELECT * FROM Skills JOIN SkillTypes ON SkillTypes.id = Skills.skillType JOIN SkillLevel ON SkillLevel.id = skills.level";
?>