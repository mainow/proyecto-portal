<?php

class AddUser extends Dashboard {
    function __construct() {
        if (!App::isAdminLoggedIn()) {
            App::redirectUser("login");
        }
        $feedback = "";
        $formValidator = new FormValidator(Actions::$ADDUSER, $_POST, ["first-name", "last-name", "id", "pwd", "born-date", "email", "category", "entry-date"]);
        $formValidator->validateFields();
        if (!$formValidator->hasInvalidFields() && count($formValidator->submittedFields) > 0) {
            $data = $formValidator->submittedFields;
            $users = new UserModel();
            if ($users->addUser($data["first-name"], $data["last-name"], $data["id"], $data["pwd"], $data["born-date"], $data["email"], $data["category"], $data["entry-date"]) != 0) {
                App::redirectUser("dashboard");
                exit;
            }
            $feedback = "<div class='text-danger'>Ya existe un usuario con el mismo documento o email!</div>";
        }
        $this->renderView("dashboard-add-user", [ "addUserValidator" => $formValidator, "fieldValues" => $formValidator->submittedFields, "feedback" => $feedback]);
        exit;
    }
}