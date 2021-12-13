<?php

class Test extends Controller {
    function __construct() {
        $formValidator = new FormValidator($_POST, ["username", "password"]);
        $formValidator->validateFields();
        if ($formValidator->hasInvalidFields() || !App::isUserLoggedIn()) {
            $this->renderView("test", [ "formValidator" => $formValidator ]);
            exit;
        }
        App::redirectUser("dashboard");
    }
}