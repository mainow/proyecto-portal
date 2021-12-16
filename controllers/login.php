<?php

class Login extends Controller {
    function __construct() {
        require "config.php";
        $formValidator = new FormValidator(Actions::$LOGIN, $_POST, ["id", "password"]);
        $formValidator->validateFields();
        // || !$users->accountExists($formValidator->submittedFields["username"], $formValidator->submittedFields["password"])
        if ($formValidator->hasInvalidFields() || !App::isUserLoggedIn()) {
            $this->renderView("login", [ "formValidator" => $formValidator ]);
            exit;
        }
        App::redirectUser("dashboard");
    }
}