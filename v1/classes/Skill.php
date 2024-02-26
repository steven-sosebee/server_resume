<?php
    require_once "../api.php";

    class Skill extends Record {

        private $id;
        protected $skill;
        protected $level;
        protected $type;

        public function __construct($id = null){
            if(isset($id)){
                $this->id = $id;
                $data = (new SkillMapper)->getOne($id);
                $skill = $data[0];
                $this->skill = $skill['skill'];
                $this->type = $skill['type'];
                $this->level = $skill['level'];
            }
        }

        public function getApplication($id){
            $mapper = new ApplicationMapper;
            return $mapper->getLinked($id);
        }


    }

    class SkillMapper extends Mapper {

        public $table = 'skills JOIN skillTypes ON skillTypes.id = skills.skillType JOIN skillLevel ON skillLevel.id = skills.level';

        public function __construct(){
            parent::__construct();
        }

        public function getAll(){
            $SQL = "SELECT skills.id, skills.skill,skillTypes.type, skillLevel.level FROM $this->table";
            return read($this->conn,$SQL);
        }
        // public function getOne($id){
        //     $inputs = simpleFilter(['id'=>$id]);
        //     $SQL = "SELECT * FROM Skills JOIN SkillTypes ON SkillTypes.id = Skills.skillType JOIN SkillLevel ON SkillLevel.id = skills.level WHERE".$inputs['filter'];
        //     return read($this->conn,$SQL,$inputs['params']);

        // }

        // public function getType($id){
        //     $inputs = simpleFilter(['id'=>$id]);
        //     $SQL = SELECTQuery("skillTypes",'*',$inputs['filter']);
        //     return read($this->conn,$SQL,$inputs['params']);
        // }

        // public function getType($id){
        //     $inputs = simpleFilter(['id'=>$id]);
        //     $SQL = SELECTQuery("skillTypes",'*',$inputs['filter']);
        //     return read($this->conn,$SQL,$inputs['params']);
        // }
    }
?>


