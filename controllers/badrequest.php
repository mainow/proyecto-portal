<?php

class BadRequest extends Controller {
    function __construct() {
        parent::__construct("badrequest");
        $this->renderView();
    }
}