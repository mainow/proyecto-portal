<?php

class AddUser extends Dashboard {
    function __construct() {
        // redireccionar a login si admin no esta login
        if (!App::isAdminLoggedIn()) {
            App::redirectUser("login");
        }
        $feedback = "";
        $formValidator = new FormValidator(Actions::$ADDUSER, $_POST, ["first-name", "last-name", "id", "pwd", "born-date", "email", "category", "entry-date"], "submit-add-user");
        $formValidator->validateFields();
        if (!$formValidator->hasInvalidFields() && count($formValidator->submittedFields) > 0) {
            $data = $formValidator->submittedFields;
            $users = new UserModel();
            // añadir usuario a la base de datos
            if ($users->addUser($data["first-name"], $data["last-name"], $data["id"], $data["pwd"], $data["born-date"], $data["email"], $data["category"], $data["entry-date"]) != 0) {
                App::redirectUser("dashboard");
                exit;
            }
            // si no se pudo añadir al usurio por algun error se pone este texto en la cima del formulario
            $feedback = <<<HTML
            <div class='text-danger'>Ya existe un usuario con el mismo documento o email!</div>
            HTML;
        }
        $formData = new DataModel;
        $categories = $formData->getCategories();
        $this->renderView("dashboard-add-user", [ "addUserValidator" => $formValidator, "fieldValues" => $formValidator->submittedFields, "feedback" => $feedback, "categories" => $categories]);
        exit;
    }
}