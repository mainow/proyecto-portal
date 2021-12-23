<?php

class Dashboard extends Controller {
    function __construct() {
        $this->renderView("dashboard");
    }

    function handleAdminVisit() {
        if (!App::isAdminLoggedIn()) {
            App::redirectUser("login");
        }
    }
}