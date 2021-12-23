<?php

class Profile extends Dashboard {
    function __construct() {
        if (!App::isUserLoggedIn()) {
            App::redirectUser("/");
        }
        $this->renderView("dashboard-profile");
    }
}