<?php
    function APIqueryArray($queryString){
        parse_str($queryString, $queryArray);
        try{
            if(isset($queryArray["q"])){
                $query = $queryArray["q"];
                $query = base64_decode($query);
                $queryArray = json_decode($query);
                $WHERE = setFilter($queryArray);
                
            } else {
                $WHERE = simpleFilter($queryArray);
            }
            $filter = $WHERE['filter'];
            $filterParams = $WHERE['params'];
            return array('filter'=>$filter, 'filterParams'=>$filterParams,'parsed'=>$queryArray);
        }
        catch (Exception $error){
            $queryArray = $error->getMessage();
        }
    }
?>