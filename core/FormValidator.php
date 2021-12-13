<?php 

class FormValidator extends FormHandler {
    /**
     * FormHandler
     * * Validacion de formularios
     */
    public $fieldsFeedback = [];
    
    function __construct(string $appAction, array $method, array $keywords) {

        $this->errors = [
            Validation::$EMAIL => "Correo electronico invalido",
            Validation::$PWD => "Contraseña invalida",
            Validation::$USERNAME => "Nombre de usuario invalido",
            Validation::$USERLOGIN => "Nombre de usuario o contraseña incorrectos"
        ];
        $this->validations = [
            Validation::$EMAIL => function (string $email) { return $this::isValidEmail($email); },
            Validation::$PWD => function (string $pwd) { return $this::isValidPassword($pwd); },
            Validation::$USERNAME => function (string $username) { return $this::isValidUsername($username); },
            Validation::$USERLOGIN => function (string $username, string $password) { return App::accountExists($username, $password); }
        ];
        $this->appAction = $appAction;
        array_push($keywords, "submit");
        $this->submittedFields = $this::getSubmittedData($method, $keywords);
        if (isset($this->submittedFields["submit"])) {
            $this->fieldsValidationsTypes = json_decode($this->submittedFields["submit"], true);
        }
        unset($this->submittedFields["submit"]);
    }

    // function findUser($username, $password) {
    //     return $this->findUserFunction();
    // }
    
    function getFieldFeedback(string $fieldName):string {
        return $this->fieldsFeedback[$fieldName] ?? 0;
    }
    
    function validateFields() {
        // solo validacion de campos (nombre de usuario mayor de 5 caracteres, etc)
        if (count($this->submittedFields) == 0) {
            return;
        }
        foreach ($this->submittedFields as $fieldName => $value) {
            $fieldValidation = $this->fieldsValidationsTypes[$fieldName];
            if (!$this->validations[$fieldValidation]($value)) {
                $this->fieldsFeedback[$fieldName] = $this->errors[$fieldValidation];
            }
        }
        if ($this->hasInvalidFields()) {
            return;
        }
        // validacion de login 
        if ($this->appAction == Actions::$LOGIN) {
            if (!$this->validations[Validation::$USERLOGIN]($this->submittedFields["username"], $this->submittedFields["password"])) {
                $this->fieldsFeedback["username"] = $this->errors[Validation::$USERLOGIN];
            } else {
                App::setUserLogin($this->submittedFields["username"]);
            }
        }
    }

    function hasInvalidFields():bool {
        return count($this->fieldsFeedback) > 0;
    }
}