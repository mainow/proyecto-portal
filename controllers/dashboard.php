<?php

class Dashboard extends Controller {
    function __construct() {
        $this->handleUser("dashboard");
    }

    function handleUser(string $view) {
        if (App::isUserLoggedIn()){
            $this->renderView("base-dashboard", ["username" => App::getLoggedInUser()]);
            $this->renderView($view);
            exit;
        } 
        App::redirectUser("login");
    }
}