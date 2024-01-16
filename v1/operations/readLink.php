<?php
    function readLinkedTable ($db, $primaryId, $foreignKey, $SQL, $childTable) {
        $SQL = $SQL." WHERE ".$childTable.".".$foreignKey." = ?";
        $res = read($db,$SQL,[$primaryId]);
        return $res;
    }
?>