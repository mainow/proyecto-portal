<?php

class Users extends Dashboard {
    function __construct() {
        $this->handleAdminVisit();
        $users = new UserModel();
        $formData = new DataModel;
        $categories = $formData->getCategories();
        // formulario crear usuario
        $addUserValidator = new FormValidator(Actions::$ADDUSER, $_POST, ["first-name", "last-name", "id", "pwd", "born-date", "email", "category", "entry-date"], "submit-add-user");
        // :todos los formularios para editar usuario
        foreach ($users->getAllUsers() as $user) {
            $editUserValidators[] = new FormValidator(Actions::$EDITUSER, $_POST, ["first-name", "last-name", "id", "born-date", "email", "category", "entry-date", "user-initial-id"], "submit-edit-user-".$user[2]);
        }

        foreach ($editUserValidators as $editUserValidator) {
            if ($editUserValidator->wasValidated() && !$editUserValidator->hasInvalidFields()) {
                $uD = $editUserValidator->submittedFields;
                $users->editUser($uD["user-initial-id"], $uD["first-name"], $uD["last-name"], $uD["id"], $uD["born-date"], $uD["email"], $uD["category"], $uD["entry-date"]);
            }
        }

        if ($addUserValidator->wasValidated() && !$addUserValidator->hasInvalidFields() && count($addUserValidator->submittedFields) > 0) {
            $data = $addUserValidator->submittedFields;
            // añadir usuario a la base de datos 
            $pwd = password_hash($data["pwd"], PASSWORD_DEFAULT);
            $users->addUser($data["first-name"], $data["last-name"], $data["id"], $pwd, $data["born-date"], $data["email"], $data["category"], $data["entry-date"]);
            App::redirectUser("dashboard/users");
        }

        $this->renderView("dashboard-users", [ "addUserValidator" => $addUserValidator, "addUserFormfieldValues" => $addUserValidator->submittedFields, "categories" => $categories, "editUserValidators" => $editUserValidators]);
    }
}