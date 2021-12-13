<?php

class Dashboard extends Controller {
    function __construct() {
        $view = App::isUserLoggedIn() ? "dashboard" : "home";
        $this->renderView($view);
    }
}