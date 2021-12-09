<?php

require_once "view.php";

class Controller {
    function __construct(string $viewName) {
        $this->view = new View($viewName);
    }

    function renderView() {
        $this->view->render();
    }
}