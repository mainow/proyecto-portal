<?php

class Profile extends Controller {
    function __construct() {
        parent::__construct("profile");
        $this->renderView();
    }
}