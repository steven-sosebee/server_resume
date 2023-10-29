<?php
// require_once PROJECT_ROOT_PATH.'/vendor/autoload.php';
require_once PROJECT_ROOT_PATH.'/model/users/userModel.php';
// require_once PROJECT_ROOT_PATH.'/php/model/user.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Authentication {
    public function __construct(){
        $this->renewSession=time()+(60*60*60);
    }
    protected function expired(){
        if($_SESSION['expirationTime']<time()){
            $this->logOutAction();
        } else {
            $_SESSION['expirationTime']=$this->renewSession;
        }
        // return $_SESSION['expirationTime'];
    }
    public function logInAction($params){
        $userId = $params['userId'];
        $pwd = $params['password'];
        $user = new User;
        $profile = $user->getProfile($params);
        if ($profile) {
            $this->issueCertAction($userId);
            $this->setVariable("loginAction","Success...");

        } else {
            $this->setVariable("loginAction","failure...");
        }
    }
    public function issueCertAction($userId){
        // session_destroy();
        session_unset();
        $_SESSION['issuedAt'] = time();
        $_SESSION['loggedIn']=true;
        $_SESSION['expirationTime']=$this->renewSession;
        $_SESSION['userId']=$userId;
    }

    public function getSessionAction($params){
        $this->expired();
        return "Session...";
    }

    public function logOutAction(){
        session_destroy();
        session_unset();
        session_abort();
        $_SESSION=[];
        return "logout successful...";
    }
    protected function setVariable($inp, $val){
        $_SESSION[$inp]=$val;
        // $_SESSION['setVar']="success";
    }
}


?>