<?php

// CRUD functions
                
    function create ($connection, $SQL, $params=array()) {
        
        try {
            $stmt = executeQuery($connection, $SQL, $params);            
        }

        catch (Exception $e){
            $error = $e->getMessage();
            return $error;
        }
        catch (PDOException $pdo){
            $error = $pdo->getMessage();
            return $error;
        }

        $data = array(
            'ID' => $connection->lastInsertId()
        );
        return $data;
    }

    function read ($connection, $SQL, $params=array()) {
        try{
            $stmt = executeQuery($connection, $SQL, $params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        catch (PDOException $pdo){
            $error = $pdo->getMessage();
            return $error;
        }
    }

    function update ($connection, $SQL, $params=array()) {
        try{
        $stmt = executeQuery($connection, $SQL, $params);
        $data = array(
            "rows updated"=>$stmt->rowCount()
            // "stmt" => $stmt
            // "type" => is_a($stmt)
        );}
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
        return $stmt;
    }
?>