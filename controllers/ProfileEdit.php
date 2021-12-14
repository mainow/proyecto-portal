<?php

class ProfileEdit extends Dashboard {
    function __construct() {
        if (!App::isUserLoggedIn()) {
            App::redirectUser("login");
        }
        $this->renderView("base-dashboard", [ "username" => App::getLoggedInUser() ]);
        $formValidator = new FormValidator(Actions::$EDITPROFILE, $_POST, ["first-name", "last-name", "email", "contact-number", "address", "city", "password"]);
        $formValidator->validateFields();
        $this->renderView("dashboard-edit-profile", ["username" => App::getLoggedInUser(), "formValidator" => $formValidator]);
    }
}