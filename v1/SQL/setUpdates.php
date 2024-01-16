<?php

    function setUpdates (array $updates){
        $values = array();
        $params = array();
        $int=200;
        foreach($updates as $update){
            foreach ($update as $key=>$value) {
                $encrypt = dechex($int);
                $params[":$encrypt"] = $value;
                $values[] = "$key = :$encrypt";    
                $int++;
            }
        }
        $values = implode(" , ", $values);
        return array ('updates'=>$values, 'params'=>$params);
    }
?>