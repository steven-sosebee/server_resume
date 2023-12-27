<?php

class Job extends API {

    function __construct (){
        parent::__construct();
        $this->db = Database::getInstance();
        $this->connection = $this->db->connection;
        $this->output['status'] = 'not started';
        $this->table = 'applicationResumesJobs';
        $this->createFields = array();
        $this->defaultValues = array();
    }

    function getResumeJobs($resumeId){
        // requires an array of job ids;
        // entry from Resume::getResume
        $return = array();
        $return['status']= 'begin transmission...';
        // $resume = (new Job);
        // $resumeId = $inputs;
        // Get jobs
        $jobsSQL = "SELECT * FROM applicationResumesJobs WHERE resumeId=:resumeId";
        $jobsParams = array(':resumeId' => $resumeId);
        $jobs = new Job;
        $jobsData = $jobs->read($jobsSQL,$jobsParams);

        foreach ($jobsData as $job) {
            $jobs = array();
            // get skills linked to job
            $skillsSQL = "SELECT * FROM applicationResumesJobSkills WHERE resumeJobId=:resumeJobId";
            $skillsParams = array(':resumeJobId' => $job['id']);
            $skills = new Skill;
            $skillsData = $skills->read($skillsSQL,$skillsParams);
            $job['skills'] = $skillsData;
            // get duties linked to job
            $dutiesSQL = "SELECT * FROM applicationResumesJobsDuties WHERE resumeJobId=:resumeJobId";
            $dutiesParams = array(':resumeJobId' => $job['id']);
            $duties = new Duty;
            $dutiesData = $duties->read($dutiesSQL,$dutiesParams);
            $job['duties'] = $dutiesData;
            // get sccomplishments linked to job
            $accomplishmentsSQL = "SELECT * FROM applicationResumesJobsAccomplishments WHERE resumeJobId=:resumeJobId";
            $accomplishmentsParams = array(':resumeJobId' => $job['id']);
            $accomplishments = new Accomplishment;
            $accomplishmentsData = $accomplishments->read($accomplishmentsSQL,$accomplishmentsParams);
            $job['accomplishments'] = $accomplishmentsData;
            
            
            $return['jobs'][] = $job;
        }
        $return['status']= 'completed...';
        $this->output = $return;
    }
}
?>