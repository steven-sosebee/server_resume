<?php
require_once __DIR__."/index.php";

    try {
        $connection->beginTransaction();
        
        $SQL = "INSERT INTO resumeTemplates (template, applicationId) VALUES (:template, :applicationid)";
        $resume = create($connection, $SQL, $inputs);
        
        $WHERE = setCriteria($query->{'criteria'});
        $resumeId = $resume['ID'];
        
        $SQLSelectJobs = "SELECT id, title, description, organization, $resumeId, start, end FROM resumeJobs where ".$WHERE['criteria'];
        $SQLSelectJobs = read($connection,$SQLSelectJobs,$WHERE['params']);

        foreach ($SQLSelectJobs as $job){
        $jobId = $job['id'];
        $newJobSQL = "INSERT INTO resumeJobs (title, description, organization, resumeId, start, end) SELECT title, description, organization, $resumeId, start, end FROM resumeJobs where id = $jobId";
        $newJob = create($connection, $newJobSQL);
        $newJobId = $newJob['ID'];
        $SQLSelectActivities = "SELECT description, activityType, $newJobId FROM jobActivities WHERE jobId = $jobId";
        $SQLNewActivities = "INSERT INTO jobActivities (description, activityType, jobId) ".$SQLSelectActivities;
        $activities = create($connection,$SQLNewActivities);
        }

        $connection->commit();

        echo json_encode([
            "data"=>[
                'resume'=>$resume,
                'JobSQL'=>$newJobSQL,
                'activitySQL'=>$SQLNewActivities,
                'jobId'=>$jobId,
                'job'=>$job,
                'jobs'=>$jobs,
                'activities'=>$activities
            ]
        ]);
    }
    catch (PDOException $error) {
        echo json_encode([
            "data"=>[
                $error->errorInfo()
            ]
        ]);
    }
?>