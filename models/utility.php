<?php
    class Utility {
        public function addResponse($field, $value){
            $this->response[$field]=$value;
        }
        
        public function response(){
            echo json_encode($this->response);
        }

        public function errorOut($err){
            $this->addResponse('Error', $err);
        }
    }
?>