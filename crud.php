<?php

// CRUD functions
                
    function create ($connection, $SQL, $params=array()) {
        
        try {
            $stmt = executeQuery($connection, $SQL, $params);
            $error = !($stmt instanceof PDOStatement);
            // $error = str_starts_with($stmt,"SQLSTATE");
            if ($error){return $stmt;}
            $data = array(
                'ID' => $connection->lastInsertId()
            );
            return $data;
        }
        catch (Exception $e){
            $data = $e->getMessage();
            return $data;
        }
        catch (PDOException $pdo){
            // $data = $pdo->getMessage();
            $data = $stmt->errorInfo();
            return $data;
        }
    }

    function read ($connection, $SQL, $params=array()) {
        try{
            $stmt = executeQuery($connection, $SQL, $params);
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

    function update ($connection, $SQL, $params=array()) {
        try {
            $stmt = executeQuery($connection, $SQL, $params);
            $error = !($stmt instanceof PDOStatement);
            // $error = str_starts_with($stmt,"SQLSTATE");
            if ($error){return $stmt;}
            $data = array(
                'rows updated' => $stmt->rowCount()
            );
            return $data;
        }
        catch (Exception $e){
            $data = $e->getMessage();
            return $data;
        }
        catch (PDOException $pdo){
            // $data = $pdo->getMessage();
            $data = $stmt->errorInfo();
            return $data;
        }
    };
    
    function delete ($connection, $SQL, $params=array()) {
        try {
            $stmt = executeQuery($connection, $SQL, $params);
            $data = array(
                'rows deleted' => $stmt->rowCount()
            );
        }
        catch (Exception $e){
            $error = $e->getMessage();
            return $error;
        }
        catch (PDOException $pdo){
            $error = $pdo->getMessage();
            return $error;
        }
        return $data;
    }

    function executeQuery($connection, $SQL, $params) {
        try{
            $stmt = $connection->prepare($SQL);
            $stmt->execute($params);
            return $stmt;    
        }
        catch (Exception $e){
            $error = $e->getMessage();
            // $output['error'] = $error;
            return $error;
        }
        catch (PDOException $pdo){
            $error = $pdo->getMessage();
            // $output['error'] = $error;
            return $error;
        }
        
    }
?>