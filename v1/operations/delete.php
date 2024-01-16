<?php
    
    function delete ($db, $SQL, $params=array()) {
        
        try {
            $stmt = $db->executeQuery($SQL, $params);
            $error = !($stmt instanceof PDOStatement);
            if ($error){return $stmt;}
            $data = array(
                'rowsAffected'=>$stmt->rowCount()
            );
            return $data;
        }
        catch (Exception $e){
            $data = $e->getMessage();
            return $data;
        }
        catch (PDOException $pdo){
            $data = $stmt->errorInfo();
            return $data;
        }
    }
?>