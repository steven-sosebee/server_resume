<?php
    define("OPERATORS",array(
        "gt"=>'>',
        "lt"=>'<',
        'eq'=>'=',
        'gte'=>'>=',
        'lte'=>'<=',
        'ne'=>'!=',
    ));

    function setFilter(array $criteria) {            
        
        
        $ORcriteria = array();
        $params = array();
        $int = 100;
        foreach ($criteria as $OR){
            $ANDcriteria = array();
            foreach ($OR as $AND) {
                $operator = OPERATORS[$AND->operator];
                $encrypt = dechex($int);
                $ANDcriteria[] = "$AND->field $operator :$encrypt";
                $params[":$encrypt"] = $AND->value;
                $int++;
            }
            $ORcriteria[] = implode(' AND ', $ANDcriteria);
            $ANDcriteria= null;
        }
        $criteria = "(".implode(") OR (", $ORcriteria).")";

        return array ('filter'=>$criteria, 'filterParams'=>$params);
    }

    function simpleFilter(array $criteria) {
        try{
            $int = 100;
            $params = array();
            // $criteria = array();
            
            foreach ($criteria as $key=>$value) {
                $encrypt = dechex($int);
                $params[":$encrypt"] = $value;
                $filter[] = "$key = :$encrypt";    
                $int++;
            }
            $filter = implode(" AND ", $filter);
            return array ('filter'=>$filter, 'filterParams'=>$params);
        } catch (Exception $e){
            return $e->getMessage();
        }
        
    }
?>