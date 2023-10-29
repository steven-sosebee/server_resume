<?php 

    class GetResumeData {
        protected $connection;

        function __construct($connection){
            $this->connection = $connection;
            $this->output = array();
        }

        function execute($SQL, $params){
            $stmt=$this->connection->prepare($SQL);
            $stmt->execute($params);    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
        public function getData($inputs){
            // $id = $inputs;
            $id = $inputs['id'];
            // $id = 5;
            $SQL = "SELECT * FROM tblResume WHERE id = ?";
            $params = array($id);

            $data = $this->execute($SQL, $params);
            $jobs = $this->getJobs($id);
            $this->output = [
                'resume'=> $data,
                'jobs'=> $jobs,
                'inputs'=>$inputs
            ];
            // $this->getSkills($id);
            
        }

        function getJobs($id){
            $SQL = "SELECT * FROM tblJobs LEFT JOIN tblLinkResumeJob ON tblJobs.jobsId = tblLinkResumeJob.jobId WHERE resumeId = ?";
            $params = array($id);
            return $this->execute($SQL, $params);

        }

        function getSkills($id){

        }
        
        public function list($empty){

            $SQL = "SELECT id, resumeTitle FROM tblResume";
            $params = array();
            $this->output = $this->execute($SQL,$params);
        }
}

?>