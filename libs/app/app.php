<?php

class App {
    function __construct() {
        $controller = $this->getControllerFromUrl();
        $this->handleController($controller);
    }
    
    function handleController(string $controller) {
        if (!file_exists("controllers/" . $controller . ".php")) {
            $controller = "badrequest";
        }
        require_once "controllers/" . $controller . ".php";
        $controller = new $controller();
    }

    function getControllerFromUrl():string {
        $controller = explode("/", rtrim($_GET["url"]));
        return !empty($controller[0]) ? $controller[0] : "index";
    }
}