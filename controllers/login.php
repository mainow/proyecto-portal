<?php

class Login extends Controller {
    function __construct() {
        require "config.php";
        parent::__construct("login");
        if (App::isUserLoggedIn()) {
            App::redirectUser("dashboard");
        }
        if (!$this->userSubmittedLoginForm()) {
            $this->renderView();
            return ;
        }
        $this->formHandler = new FormHandler($_POST, ["username", "pwd"]);
        $this->loginInfo = $this->formHandler->submittedData;
        $this->users = new Users();
        $loginStatus = $this->getLoginStatus();
        if ($loginStatus == $LOGIN_STATUS["user-found"]) {
            $this->setLogIn($this->loginInfo["username"]);
        }
        App::redirectUser("login?login-status={$loginStatus}");
    }
    
    function handleUserInvalidVisit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["username"])) {
            $this->formHandler->sendUserTo("dashboard");
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
        if ($this->formHandler->emptyField($this->formHandler->submittedData)) {
            return $LOGIN_STATUS["empty-fields"];
        }
        if (!$this->users->accountExists($this->loginInfo["username"], $this->loginInfo["pwd"])) {
            return $LOGIN_STATUS["user-not-found"];
        }
        return $LOGIN_STATUS["user-found"];
    }
}