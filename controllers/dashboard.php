<?php

class Dashboard extends Controller {
    function __construct() {
        $view = App::isUserLoggedIn() ? "dashboard" : "home";
        parent::__construct($view);
        $this->renderView();
    }
}