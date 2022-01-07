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
        $disableUserValidators = [];
        $enableUserValidators = [];
        foreach ($users->getAllUsers() as $user) {
            $userProfileEditValidatorId = "profile-img-$user[3]";
            $editUserValidators[] = new FormValidator(Actions::$EDITUSER, $_POST, [$userProfileEditValidatorId, "first-name", "last-name", "id", "born-date", "email", "category", "entry-date", "user-initial-id"], "submit-edit-user-$user[3]");
            $disableUserValidators[] = new FormValidator(Actions::$DISABLEUSER, $_POST, ["user-id"], "submit-disable-user-$user[3]");
            $enableUserValidators[] = new FormValidator(Actions::$ENABLEUSER, $_POST, ["user-id"], "submit-enable-user-$user[3]");
        }

        foreach ($editUserValidators as $editUserValidator) {
            // reemplazar mayoria de los datos del usuario menos la imagen de perfil
            $uD = $editUserValidator->submittedFields;
            if ($editUserValidator->wasValidated() && !$editUserValidator->hasInvalidFields()) {
                $users->editUser($uD["user-initial-id"], $uD["first-name"], $uD["last-name"], $uD["id"], $uD["born-date"], $uD["email"], $uD["category"], $uD["entry-date"]);
            }
            // reemplazar la imagen de perfil
            if ($editUserValidator->wasValidated() && !$editUserValidator->hasInvalidFields()) {
                $userProfileEditValidatorId = "profile-img-".$uD['id'];
                if ($editUserValidator->submittedFields[$userProfileEditValidatorId]["name"] != "") {
                    $this->handleSubmittedImg($editUserValidator->submittedFields[$userProfileEditValidatorId], $uD["id"]);
                }
            }
        }

        foreach ($disableUserValidators as $validator) {
            if ($validator->wasValidated()) {
                $users->disableUser(intval($validator->submittedFields["user-id"]));
            }
        }

        foreach ($enableUserValidators as $validator) {
            if ($validator->wasValidated()) {
                $users->enableUser(intval($validator->submittedFields["user-id"]));
            }
        }
        
        if ($addUserValidator->wasValidated() && !$addUserValidator->hasInvalidFields() && count($addUserValidator->submittedFields) > 0) {
            $data = $addUserValidator->submittedFields;
            // añadir usuario a la base de datos 
            $pwd = password_hash($data["pwd"], PASSWORD_DEFAULT);
            $users->addUser($data["first-name"], $data["last-name"], $data["id"], $pwd, $data["born-date"], $data["email"], $data["category"], $data["entry-date"]);
            
            $this->handleSubmittedImg($data["profile-img"], $data["id"]);
            App::redirectUser("dashboard/users");
        }

        $this->renderView("dashboard-users", [ "addUserValidator" => $addUserValidator, "addUserFormfieldValues" => $addUserValidator->submittedFields, "categories" => $categories, "editUserValidators" => $editUserValidators, "disableUserValidators" => $disableUserValidators, "enableUserValidators" => $enableUserValidators ]);
    }

    function handleSubmittedImg(array $image, int $userId_Key) {
            $userImgTmp = $image["tmp_name"];
            $userImgExt = pathinfo($image["name"], PATHINFO_EXTENSION);
            $userImgName = $userId_Key."-profile-img.".$userImgExt;
            $userImgFolder = "/uploads/users/".$userImgName;
            $profileImgFile = $_SERVER["DOCUMENT_ROOT"].$userImgFolder;

            // guardar la imagen
            move_uploaded_file($userImgTmp, $profileImgFile);
            $users = new UserModel();
            $users->setUserProfileImg($userId_Key, $userImgName);
    }
}