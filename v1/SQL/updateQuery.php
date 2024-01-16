<?php

    function UPDATEQuery($inputs,$table, $filter,$filterParams,){
        $updates = setUpdates($inputs);
        
        $SQL = "UPDATE $table SET ".$updates['updates']." WHERE ".$filter;
        $params = array_merge($updates['params'],$filterParams);

        return array ('SQL'=>$SQL,'params'=>$params);
    }
    

    // $SQL = "UPDATE applications SET ".$updates['updates']." WHERE ".$filter;
    // $params = array_merge($updates['params'],$filterParams);
    // $res = update($db, $SQL, $params);
?>