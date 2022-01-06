<?php

class Users extends Dashboard {
    function __construct() {
        $this->handleAdminVisit();
        $users = new UserModel();
        $formData = new DataModel();
        $categories = $formData->getCategories();
        // formulario crear usuario
        $addUserValidator = new FormValidator(Actions::$ADDUSER, $_POST, ["profile-img", "first-name", "last-name", "id", "pwd", "born-date", "email", "category", "entry-date"], "submit-add-user");
        
        // :todos los formularios para editar usuario
        $editUserValidators = [];
        foreach ($users->getAllUsers() as $user) {
            $editUserValidators[] = new FormValidator(Actions::$EDITUSER, $_POST, ["first-name", "last-name", "id", "born-date", "email", "category", "entry-date", "user-initial-id"], "submit-edit-user-".$user[3]);
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
            
            $justAddedUser = $users->getUsersByData("id", $data["id"]);
            
            $userImgTmp = $data["profile-img"]["tmp_name"];
            $userImgName = $justAddedUser["id_key"]."-profile-img";
            $userImgExt = pathinfo($data["profile-img"]["name"], PATHINFO_EXTENSION);
            $userImgFolder = "/uploads/users/".$userImgName.".".$userImgExt;
            $profileImgFile = $_SERVER["DOCUMENT_ROOT"].$userImgFolder;

            // guardar la imagen
            move_uploaded_file($userImgTmp, $profileImgFile);
            $users->setUserProfileImg($data["id"], $userImgName);

            App::redirectUser("dashboard/users");
        }

        $this->renderView("dashboard-users", [ "addUserValidator" => $addUserValidator, "addUserFormfieldValues" => $addUserValidator->submittedFields, "categories" => $categories, "editUserValidators" => $editUserValidators]);
    }
}