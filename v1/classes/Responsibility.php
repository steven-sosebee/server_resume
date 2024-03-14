<?php
    class Responsibility extends Record {
        private $id;
        private $responsibility;
        private $type;

        public function __construct(){
        }

        public function get($id){
            $res = (new ResponsibilityMapper)->getOne($id);

        }

        
    }

    class ResponsibilityMapper extends Mapper {
        protected $table = 'responsibilities';

        public function __construct(){
            parent::__construct();
        }
        
    }
