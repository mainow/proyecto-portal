<?php

class Dashboard extends Controller {
    function __construct() {
        $this->handleAdminVisit();
        $this->renderView("dashboard");
    }

    function handleAdminVisit() {
        if (!App::isAdminLoggedIn()) {
            App::redirectUser("login");
        }
    }
}