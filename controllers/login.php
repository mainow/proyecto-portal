<?php

class LogIn extends Controller {
    function __construct() {
        require "config.php";
        parent::__construct("login");
        $this->submitHandler = new SubmitHandler($_POST, ["username", "pwd"]);
        $this->handleUserInvalidVisit();

        if (!$this->userSubmittedLoginForm()) {
            $this->renderView();
            return ;
        }
        $this->loginInfo = $this->submitHandler->submittedData;
        $this->users = new Users();
        $loginStatus = $this->getLoginStatus();
        if ($loginStatus == $LOGIN_STATUS["user-found"]) {
            $this->setLogIn($this->loginInfo["username"]);
        }
        $this->submitHandler->sendUserTo("login", "login-status={$loginStatus}");
    }
    
    function handleUserInvalidVisit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["username"])) {
            $this->submitHandler->sendUserTo("profile");
            exit;
        }

    }

    function userSubmittedLoginForm():bool {
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