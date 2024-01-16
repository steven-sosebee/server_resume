<?php
// require_once __DIR__."/config/config_defs.php";
// require_once __DIR__."/env/config.php";
class Database {
    static protected $instance;
    // protected $connection;

    // function __construct($db = DB, $host = DB_HOST, $port = DB_PORT, $userName = DB_USERNAME, $password = DB_PASSWORD){
    function __construct(){
        $this->password = DB_PASSWORD;
        $this->userName = DB_USERNAME;
        $this->db = DB;
        $this->port = DB_PORT;
        $this->host = DB_HOST;        
        $this->connect();  
    }

    function __destruct(){
        $this->disconnect();
    }

    public static function getInstance() {
        // echo self::$connected;
        if(!self::$instance) {
            // get the arguments to the constructor from configuration somewhere
            self::$instance = new self();
        }
 
        return self::$instance;
    }
    
    // standard connectivity
    function connect(){
        try{
            $this->connection= new PDO(
                "mysql:host=".$this->host.
                ";port=".$this->port.
                ";dbname=".$this->db
                , $this->userName
                , $this->password,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->connected = 'connected';
            // $this->instance = true;
        } catch (PDOException $e) {                 
            $this->connected = $e->getMessage();
        }
    }
    public function getConnectionDetails(){
        return $this->connected;
    }
// close connection to DB.  TODO add more code for error monitoring.
    function disconnect(){
        $this->connection = NULL;
    }

    function executeQuery($SQL, $params) {
        try{
            $stmt = $this->connection->prepare($SQL);
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
}
?>