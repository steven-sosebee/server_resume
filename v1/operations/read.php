<?php

function read ($db,$SQL, $params=array()) {
    try{
        $stmt = $db->executeQuery($SQL, $params);
        $error = !($stmt instanceof PDOStatement);
        // $error = str_starts_with($stmt,"SQLSTATE");
        if ($error){return $stmt;}
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        
    }
    catch (PDOException $pdo){
        $data = $pdo->getMessage();
        return $data;
    }
}
?>