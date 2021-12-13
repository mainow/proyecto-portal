<?php

class BadRequest extends Controller {
    function __construct() {
        $this->renderView("badrequest");
    }
}