<?php
    
    class QueryQueue {
        static $queue;

        function __construct(){
            self::$queue = [];
        }

        function addQuery($name,$query){
            $queue[] = array(
                'name'=>$name,
                '$query'=>$query,
                'status'=>'not started');
        }
        
    }
?>