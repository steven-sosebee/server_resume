<?php
    
    function respond($data){
        $res =[
            'data'=>$data,
            
        ];

        echo json_encode($res);
    }
?>