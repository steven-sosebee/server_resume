<?php
    $SQLTYPE = array(
        'SELECT'=>0,
        'INSERT'=>1,
        'DELETE'=>2,
        'UPDATE'=>3
    );

    $TABLE = array(
        'RESUME'=>'resumeTemplates'
    );
    
    function setSQL(int $queryType, string $table, array $fields=array('*'), array $values=NULL, string $conditions=NULL){
        $SQLfields = implode(", ",$fields);
        
        
        switch ($queryType) {
            case 0:
                $SQL = "SELECT ".$SQLfields." FROM ".$table;
                if($conditions){$SQL = $SQL." WHERE ".$conditions;};
                break;
            case 1:
                $values = $this->setValues($fields);
                $SQL = "INSERT INTO ".$table." (".$SQLfields.") VALUES (".$values.")";
                break;
            case 2:
                $SQL = "DELETE FROM ".$table." WHERE ".$conditions;
                break;
            case 3:
                $updates = $this->setUpdates($fields);
                $SQL = "UPDATE ".$table." SET ".$updates." WHERE ".$conditions;
                break;
            default:
                $SQL = "SELECT ".$SQLfields." FROM ".$table;
                break;
        };

        return $SQL;
    }

?>