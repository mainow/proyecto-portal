<?php

class Users extends Dashboard {
    function __construct() {
        $this->handleAdminVisit();
        $users = new UserModel();
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
            $users->addUser($data["first-name"], $data["last-name"], $data["id"], $data["pwd"], $data["born-date"], $data["email"], $data["category"], $data["entry-date"]);
            App::redirectUser("dashboard/users");
        }
        
        // pasar las categorias existentes como parametro a la vista
        $formData = new DataModel;
        $categories = $formData->getCategories();

        $this->renderView("dashboard-users", [ "addUserValidator" => $addUserValidator, "fieldValues" => $addUserValidator->submittedFields, "categories" => $categories, "editUserValidators" => $editUserValidators]);
    }
}


// class Users extends Dashboard {
//     function __construct() {
//         if (!App::isAdminLoggedIn()) {
//             App::redirectUser("login");
//         }
//         $users = new UserModel();
//         $addUserValidator = new FormValidator(Actions::$ADDUSER, $_POST, ["first-name", "last-name", "id", "pwd", "born-date", "email", "category", "entry-date"], "submit-add-user");
//         $editUserValidators = [];
//         foreach ($users->getAllUsers() as $_) {
//             $editUserValidators[] = new FormValidator(Actions::$EDITUSER, $_POST, ["first-name", "last-name", "id", "born-date", "email", "category", "entry-date"], "submit-edit-user");
//         }
//         // si el usuario apreto el boton de sumbit del form para crear usuario
//         if (isset($_POST["submit-add-user"])) {
//             $addUserValidator->validateFields();
//         }
        
//         if (isset($_POST["submit-edit-user"])) {
//             foreach ($editUserValidators as $validator) {
//                 $validator->validateFields();
//             }
//         }
//         if (isset($_POST["submit-add-user"]) && !$addUserValidator->hasInvalidFields() && count($addUserValidator->submittedFields) > 0) {
//             $data = $addUserValidator->submittedFields;
//             // añadir usuario a la base de datos 
//             $users->addUser($data["first-name"], $data["last-name"], $data["id"], $data["pwd"], $data["born-date"], $data["email"], $data["category"], $data["entry-date"]);
//             App::redirectUser("dashboard/users");
//         }
        
//         $formData = new DataModel;
//         $categories = $formData->getCategories();
//         $this->renderView("dashboard-users", [ "addUserValidator" => $addUserValidator, "fieldValues" => $addUserValidator->submittedFields, "categories" => $categories, "editUserValidators" => $editUserValidators]);
//         exit;
//     }
// }