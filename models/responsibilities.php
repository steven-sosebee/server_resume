<?php

class ResponsibilitiesData extends API{
    private const TABLE = 'tblMappingResponsibilities';

    function __construct($connection){
        $this->connection = $connection;
    }
// Create Data

    public function submit($inputs) {
        $SQL = "INSERT INTO ".self::TABLE." (responsibility) VALUES ([?])"; 
        $params = array(
            $inputs['responsibility'],
            
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
        $Order = '';
        $SQL = "SELECT * FROM ".self::TABLE.$Order ;
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
        $params = array(
            $inputs['id']
        );
        try{
            $stmt = self::executeQuery($SQL, $params);
            $this->output['responsibilities'] = self::getData($stmt);
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
                'rows deleted' => self::getAffectedRows($stmt),
                'ID' => $inputs['id']
            );}
        catch (Exception $e){
            $this->output = $e->getMessage();
        }
    }

}
?>