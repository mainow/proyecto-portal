<?php

class Login extends Controller {
    function __construct() {
        $formValidator = new FormValidator(Actions::$LOGIN, $_POST, ["id", "password"], "submit-login");
        $formValidator->validateFields();
        if ($formValidator->hasInvalidFields() || !App::isUserLoggedIn()) {
            $this->renderView("login", [ "formValidator" => $formValidator ]);
            exit;
        }
        App::redirectUser("dashboard");
    }
}