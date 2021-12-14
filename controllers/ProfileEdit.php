<?php


class ProfileEdit extends Dashboard {
    function __construct() {
        if (!App::isUserLoggedIn()) {
            App::redirectUser("login");
        }
        
        $formValidator = new FormValidator(Actions::$EDITPROFILE, $_POST, ["first-name", "last-name", "email", "phone-number", "address", "city", "password"]);
        $formValidator->validateFields();
        $userModel = new UserModel;
        $userData = $userModel->getUser(App::getLoggedInUser());
        $fieldValues = [
            "first-name" => $userData["first_name"],
            "last-name" => $userData["last_name"],
            "email" => $userData["email"],
            "phone-number" => $userData["phone_number"],
            "address" => $userData["address"],
            "city" => $userData["city"],
            "password" => $userData["pwd"]
        ];

        if (isset($_POST["submit"])) {
            $data = $formValidator->submittedFields;
            $userFields = new UserFullData($data["first-name"], $data["last-name"], $data["email"], $data["phone-number"], $data["address"], $data["city"], $data["password"]);
            $userModel->setAllUserData(App::getLoggedInUser(), $userFields);
            App::redirectUser("dashboard/profile/edit");
        }
        
        $this->renderView("base-dashboard", [ "username" => App::getLoggedInUser() ]);
        $this->renderView("dashboard-edit-profile", ["username" => App::getLoggedInUser(), "formValidator" => $formValidator, "fieldValues" => $fieldValues ]);
    }
}