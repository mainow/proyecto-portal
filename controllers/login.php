<?php

class LogIn extends Controller {
    function __construct() {
        require "config.php";
        parent::__construct("login");
        if (!$this->userTriesToLogin()) {
            $this->renderView();
            return ;
        }
        $this->submitHandler = new SubmitHandler($_POST, ["username", "pwd"]);
        $this->loginInfo = $this->submitHandler->submittedData;
        $this->users = new Users();
        $loginStatus = $this->getLoginStatus();
        if ($loginStatus == $LOGIN_STATUS["user-found"]) {
            $this->setLogIn($this->loginInfo["username"]);
        }
        $this->submitHandler->sendUserTo("login", "login-status={$loginStatus}");
    }
    
    function userTriesToLogin():bool {
        return isset($_POST["submit-login"]) ? true : false;
    }
    
    function setLogIn(string $username) {
        session_start();
        $_SESSION["username"] = $username;
    }
    
    function getLoginStatus() {
        require "config.php";
        if ($this->submitHandler->emptyField($this->submitHandler->submittedData)) {
            return $LOGIN_STATUS["empty-fields"];
        }
        if (!$this->users->accountExists($this->loginInfo["username"], $this->loginInfo["pwd"])) {
            return $LOGIN_STATUS["user-not-found"];
        }
        return $LOGIN_STATUS["user-found"];
    }
}