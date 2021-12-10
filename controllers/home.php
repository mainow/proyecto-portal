<?php

class Home extends Controller {
    function __construct() {
        parent::__construct("home");
        $this->renderView();
    }
}