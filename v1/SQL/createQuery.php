<?php
    function INSERTQuery ($inputs,$table) {
                $fields = $inputs['fields'];
                $values = $inputs['values'];
                $params = $inputs['params'];
                $SQL = "INSERT INTO ".$table." ".$fields." VALUES ".$values;
                return $SQL;
    }
?>