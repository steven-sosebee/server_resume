<?php
    class Skill extends API {

        function __construct (){
            parent::__construct();
            // $this->db = Database::getInstance();
            // $this->connection = $this->db->connection;
            // $this->output['status'] = 'not started';
            $this->table = 'tblSkills';
            $this->createFields = array(
                ':skillsName'=>NULL, 
                ':skillsType'=>NULL, 
                ':skillsLevel'=>NULL
            );
            $this->defaultValues = array();
        }

        function getResumeSkills($resumeId){
            // requires an array of skill ids;
            // entry from Resume::getResume
            $return = array();
            $return['status']= 'begin transmission...';
            // Get jobs
            $skillsSQL = "SELECT * FROM applicationResumesSkills WHERE resumeId=:resumeId";
            $skillsParams = array(':resumeId' => $resumeId);
            $skills = new Skill;
            $skillsData = $skills->read($skillsSQL,$skillsParams);
    
            foreach ($skillsData as $skill) {
                $skills = array();
                // get duties linked to skill
                // $dutiesSQL = "SELECT * FROM applicationResumesSkillsDuties WHERE resumeSkillId=:resumeSkillId";
                // $dutiesParams = array(':resumeSkillId' => $skill['id']);
                // $duties = new Duty;
                // $dutiesData = $duties->read($dutiesSQL,$dutiesParams);
                // $skills['duties'] = $dutiesData;
        
                // get sccomplishments linked to job
                $accomplishmentsSQL = "SELECT * FROM applicationResumesSkillsAccomplishments WHERE linkId=:linkId";
                $accomplishmentsParams = array(':linkId' => $skill['id']);
                $accomplishments = new Accomplishment;
                $accomplishmentsData = $accomplishments->read($accomplishmentsSQL,$accomplishmentsParams);
                $skill['accomplishments'] = $accomplishmentsData;
                $return['skills'][] = $skill;
            }
            $return['status']= 'completed...';
            return $return;
        }

    }
?>