<?php

    class Application extends API {

        function __construct (){
            parent::__construct();
            $this->db = Database::getInstance();
            $this->connection = $this->db->connection;
            $this->output['status'] = 'not started';
            $this->table = 'tblApplications';
            $this->createFields = array(
                ':title'=>NULL, 
                ':company'=>NULL, 
                ':link'=>NULL, 
                ':status' => 'Not Submitted'
            );
            $this->defaultValues = array(
                'status' => 'Not Submitted'
            );

        }

        public function createResume($inputs){
            $return = array();
            $records = $inputs['records'];
            $return = array();
            $return['status']= 'begin transmission...';
            
            foreach ($records as $application){
                $this->startTransaction();
                try{
                    $return['status']= 'create application...';
                    $applicationRecord = array('records'=>array($application));
                    $applicationModel = new Application;
                    $applicationModel->insertRecords($applicationRecord,false);
                    $applicationId = $applicationModel->getInsertedId();
                    // $applicationId = 4;
                    $return['applicationId']=$applicationId;
                    
                }
                catch (Exception $e){
                    $error = $e->getMessage();
                    $this->output['error'] = $error;
                    return $error;
                }
                catch (PDOException $pdo){
                    $error = $pdo->getMessage();
                    $this->output['error'] = $error;
                    return $error;
                }
                try{
                    $return['status']= 'create resume...';
                    $resumeRecord = array('records'=>array(array('applicationId'=>$applicationId)));
                    $isArray = is_array($resumeRecord['records']);
                    $resumeModel = new Resume;
                    $resumeModel->insertRecords($resumeRecord, false);
                    $resumeId = $resumeModel->getInsertedId();
                    $return['resumeId']=$resumeId;
                    
                }
                catch (Exception $e){
                    $error = $e->getMessage();
                    $this->output['error'] = $error;
                    return $error;
                }
                catch (PDOException $pdo){
                    $error = $pdo->getMessage();
                    $this->output['error'] = $error;
                    return $error;
                }
                $return['status']= 'insert job data...';
                    $jobsModel = new Job;
                    $jobsSQL = "SELECT $resumeId as resumeId, jobsDesc, jobsName, jobsCompany, jobsId FROM tblJobs";
                    $jobsRecords = $jobsModel->read($jobsSQL);
                    $jobsSQL = "INSERT INTO applicationResumesJobs (resumeId, description, title, company, jobId) ".$jobsSQL;
                    $jobsInsert = $this->create($jobsSQL,array());
                    $this->endTransaction();
                    
            }

              $this->output['data'] = $return;

        }

    }
?>