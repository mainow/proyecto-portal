<?php

class LogOut extends Controller {
    function __construct() {
        parent::__construct("index");
        $this->logOutUser();
        $this->renderView();
    }

    function logOutUser() {
        session_start();
        session_unset();
        session_destroy();
    }
}