<?php
require_once PROJECT_ROOT_PATH . "/connections/db_con_users.php";

class User {
    
    public function getProfile($params){
        // $RES['getProfile']=true;
        $validUser=$this->isValidUser($params);
        // $_SESSION['validUser']=$validUser;
        if($validUser){
            $validPassword=$this->isValidPassword($params);
            // $_SESSION['validPassword']=$validPassword;    
            return $validPassword;
        } else {
            return false;
        };
        // $validPassword=$this->isValidPassword($params);
        // $_SESSION['validPassword']=$validPassword;
        return $validPassword;
    }
    public function getProfileAction($params){
        $validUser=$this->isValidUser($params);
        $validPassword=$this->isValidPassword($params);

        if($validPassword && $validUser){
            return $this->profileAction($params);
        } else {
            return false;
        }
        // return $validPassword;
    }

    public function profileAction($params){
        try{
            // echo var_dump($params['userId']);
            $con = mysqli_connect('box5934.bluehost.com:3306', 'steveqv1_root', 'walrus','steveqv1_users');
            $sql = "SELECT * FROM tbl_users WHERE userID ='{$params['userId']}'";
            $result= $con->query($sql)->fetch_all(MYSQLI_ASSOC);
            return $result;
            // return $this->select($sql);
        } catch (Exception $e){
            throw New Exception($e->getMessage());
        };
    }
    protected function isValidPassword($params){
        $con = mysqli_connect('box5934.bluehost.com:3306', 'steveqv1_root', 'walrus','steveqv1_users');
        $sql = "SELECT * FROM tbl_users WHERE userID = '{$params['userId']}'";
        $result = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
        $validPassword = ($result[0]['userPassword'] === $params['password']);
        // $_SESSION['dbPasswordSQL']=$result;
        // $_SESSION['validPassword']=(object) array('isValid'=>$validPassword, 'param'=>$params['password'],'db'=>$result[0]['userPassword']);
        return $validPassword;
    }
    protected function isValidUser($params){
        try{
            // $this->connection = $con;
            $con = mysqli_connect('box5934.bluehost.com:3306', 'steveqv1_root', 'walrus','steveqv1_users');
            $sql = "SELECT userID FROM tbl_users WHERE userID ='{$params['userId']}'";
            $result= mysqli_query($con,$sql)->num_rows;
            // print_r ($result);
            // $_SESSION['numRows']=$result;
            $validUser = $result===1;
            // $RES['validUser']=$validUser;
            return $validUser;
        } catch (Exception $e){
            throw New Exception($e->getMessage());
        }
    }
    public function submitUserAction($params){
        return $params;
    }
}
?>