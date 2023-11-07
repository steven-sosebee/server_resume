<?php

require "getResumeData.php";
require "updateResumeData.php";
require "createResumeData.php";

class ResumeData extends API{
    private const TABLE = 'tblResume';
    private static $submit_SQL = "INSERT INTO ".self::TABLE." (title, description) VALUES (?,?)";         

    function __construct($connection){
        $this->connection = $connection;
    }
// Create Data

    public function submit($inputs) {
        $SQL = "INSERT INTO ".self::TABLE." (title, description) VALUES (?,?)"; 
        $params = array(
            $inputs['title'],
            $inputs['description']
        );
        try{
            $stmt = self::executeQuery($SQL,$params);
            $this->output = array(
                'rows inserted' => self::getAffectedRows($stmt),
                'ID' => self::getNewID($stmt)
            );}
        catch (Exception $e){
            $this->output = $e->getMessage();
        }
    }

// Get Data
    public function list($inputs) {
        $SQL = "SELECT * FROM ".self::TABLE." ORDER BY title" ;
        $params = array();
        try{
            $stmt = self::executeQuery($SQL, $params);
            $this->output = self::getData($stmt);
        }
        catch (Exception $e){
            $this->output = $e->getMessage();

        }
    }

    public function select($inputs) {
        $SQL = "SELECT * FROM ".self::TABLE." WHERE id = ?";
        $Jobs = "SELECT * FROM tblJobs JOIN tblLinkResumeJob ON tblLinkResumeJob.jobId = tblJobs.jobsId WHERE tblLinkResumeJob.resumeId = ?";
        $JobsDetails = "";
        $Skills = "SELECT * FROM tblSkills JOIN tblLinkResumeSkill ON tblLinkResumeSkill.skillId = tblSkills.skillsId WHERE tblLinkResumeSkill.resumeId = ?";
        $params = array(
            $inputs['id']
        );
        try{
            $stmt = self::executeQuery($SQL, $params);
            $this->output['resume'] = self::getData($stmt);
            $stmt_jobs = self::executeQuery($Jobs,$params);
            $this->output['jobs'] = self::getData($stmt_jobs);
            $stmt_jobs = self::executeQuery($Skills,$params);
            $skillsOutput = self::getData($stmt_jobs);
            // $result = [];
            // foreach ($skillsOutput as $i){
            //     $result[$i['skillsType']][]=$i;
            // }
            $this->output['skills'] = self::groupBy($skillsOutput, 'skillsType');
        }
        catch (Exception $e){
            $this->output = $e->getMessage();

        }
    }

// Delete Data

    public function delete($inputs) {
        $SQL = "DELETE FROM ".self::TABLE." WHERE id = ?";
        $params = array(
            $inputs['id']
        );
        try{
            $stmt = self::executeQuery($SQL,$params);
            $this->output = array(
                'rows deleted' => self::getAffectedRows($stmt)
            );}
        catch (Exception $e){
            $this->output = $e->getMessage();
        }
    }

}
?>