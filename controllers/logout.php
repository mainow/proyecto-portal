<?php

class LogOut extends Controller {
    function __construct() {
        $this->logOutUser();
        App::redirectUser("home");
    }

    function logOutUser() {
        session_start();
        session_unset();
        session_destroy();
    }
}