<?php
    
    function setInputs (array $inputs){
        $SQLFields = array();
        $values = array();
        $params = array();
        $int=200;
        // foreach($inputs as $input){
            foreach ($inputs as $key=>$value) {
                $encrypt = dechex($int);
                $params[":$encrypt"] = $value;
                $values[] = ":$encrypt";
                $SQLFields[] = $key;
                $int++;
            }
            $SQLFields= "(".implode(", ",$SQLFields).")";
            $values= "(".implode(", ",$values).")";
        // }
        // $values = implode(" , ", $values);
        return array ('fields'=>$SQLFields,'values'=>$values, 'params'=>$params);
    }
?>