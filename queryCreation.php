<?php

function setCriteria(array $criteria) {            
    
    
    $ORcriteria = array();
    $params = array();
    $int = 100;
    foreach ($criteria as $OR){
        $ANDcriteria = array();
        foreach ($OR as $AND) {
            $encrypt = dechex($int);
            $ANDcriteria[] = "$AND->field $AND->operator :$encrypt";
            $params[":$encrypt"] = $AND->value;
            $int++;
        }
        $ORcriteria[] = implode(' AND ', $ANDcriteria);
        $ANDcriteria= null;
    }
    $criteria = "(".implode(") OR (", $ORcriteria).")";

    return array ('criteria'=>$criteria, 'params'=>$params);
}

function orderedBy(array $ordered) {
    $orderedBy =" ORDER BY ";
    return $orderedBy.implode(", ", $ordered);
}

function setInputs($SQL, array $inputs){
    $data =[];
    foreach ($inputs as $key => $value){
        $field = str_replace(":","",$key);
        $data[] = "$field = $key";
    }
    $SQL = $SQL.implode(", ",$data);
    return $SQL;
}
?>