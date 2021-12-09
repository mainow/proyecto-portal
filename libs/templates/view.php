<?php

class View {
    function __construct(string $viewName) {
        $this->viewName = $viewName;
    }

    function render() {
        require_once "views/" . $this->viewName . "/index.php";
    }
}