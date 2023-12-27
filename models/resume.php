<?php

class Resume extends API {

    function __construct (){
        parent::__construct();
        $this->db = Database::getInstance();
        $this->connection = $this->db->connection;
        $this->output['status'] = 'not started';
        $this->table = 'applicationResumes';
        $this->defaultValues = array(
            'uniqueId'=>$this->uuid(30)
        );
    }

    function getResume ($inputs) {
        $return = array();
        // $return['status']= 'begin transmission...';
        $resume = (new Resume);
        $resume->getRecords($inputs);
        $resumeOutput = $resume->getOutput();
        $resumeId = $resumeOutput['data'][0]['id'];

        // Get jobs
        // $jobsSQL = "SELECT * FROM applicationResumesJobs WHERE resumeId=:resumeId";
        // $jobsParams = array(':resumeId' => $resumeId);
        $jobs = new Job;
        // $jobsData = $jobs->read($jobsSQL,$jobsParams);
        $jobs->getResumeJobs($resumeId);
        $jobsData = $jobs->getOutput(); 
        // Get skills
        // $skillsSQL = "SELECT * FROM applicationResumesSkills WHERE resumeId=:resumeId";
        // $skillsParams = array(':resumeId' => $resumeId);
        $skills = new Skill;
        $skillsData = $skills->getResumeSkills($resumeId);


        $return['resume'] = $resumeOutput;
        $return['id'] = $resumeId;
        $return['jobs'] = $jobsData;
        $return['skills'] = $skillsData;
        $this->output = $return;
        
    }
    
    function getTemplate ($inputs) {
        
    }

}
?>