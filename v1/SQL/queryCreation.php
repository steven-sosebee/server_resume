<?php



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