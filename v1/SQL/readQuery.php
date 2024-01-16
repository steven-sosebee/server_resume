<?php
    function SELECTQuery ($table,$fields='*',$filter=null) {
        $SQL = "SELECT ".$fields." FROM ".$table;
        if(isset($filter)){
            $SQL=$SQL." WHERE ".$filter;
        }
        return $SQL;
    }
?>