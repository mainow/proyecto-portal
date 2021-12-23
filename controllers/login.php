<?php

class Login extends Controller {
    function __construct() {
        $loginValidator = new FormValidator(Actions::$LOGIN, $_POST, ["id", "password"], "submit-login");
        if ($loginValidator->wasValidated() && !$loginValidator->hasInvalidFields() && App::accountExists($loginValidator->submittedFields["id"], $loginValidator->submittedFields["password"])) {
            App::setUserLogin($loginValidator->submittedFields["id"]);
            App::redirectUser("dashboard");
        }
        $this->renderView("login", [ "loginValidator" => $loginValidator ]);
    }
}