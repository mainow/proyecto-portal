<?php 

class FormValidator extends FormHandler {
    /**
     * FormValidator
     * * Validacion de formularios
     */
    public $fieldsFeedback = [];
    
    function __construct(string $appAction, array $method, array $keywords, string $submitButtonName) {

        $this->errors = [
            Validation::$EMAIL => "Correo electronico invalido",
            Validation::$PWD => "Contraseña invalida",
            Validation::$USERNAME => "Nombre de usuario invalido",
            Validation::$USERLOGIN => "Nombre de usuario o contraseña incorrectos",
            Validation::$TEXT => "Campo Vacio",
            Validation::$PHONENUMBER => "Numero de teléfono invalido",
            Validation::$CATEGORYEXISTS => "La categoria ya existe!"
        ];
        $this->validations = [
            Validation::$TEXT => function ($value) { return !empty($value); },
            Validation::$EMAIL => function (string $email) { return $this::isValidEmail($email); },
            Validation::$PWD => function (string $pwd) { return $this::isValidPassword($pwd); },
            Validation::$USERNAME => function (string $username) { return $this::isValidUsername($username); },
            Validation::$USERLOGIN => function (string $username, string $password) { return App::accountExists($username, $password); },
            Validation::$PHONENUMBER => function (string $number) { return $this::isValidPhoneNumber($number); },
            Validation::$CATEGORYEXISTS => function (string $category) { return !$this::categoryIsUnique($category) || !empty($value); }
        ];

        $this->appAction = $appAction;
        array_push($keywords, $submitButtonName);
        $this->submittedFields = $this::getSubmittedData($method, $keywords);
        if (isset($this->submittedFields[$submitButtonName])) {
            $this->fieldsValidationsTypes = json_decode($this->submittedFields[$submitButtonName], true);
        }
        unset($this->submittedFields[$submitButtonName]);
    }
    
    function getFieldFeedback(string $fieldName):string {
        return $this->fieldsFeedback[$fieldName] ?? 0;
    }
    
    function validateFields() {
        // solo validacion de campos (nombre de usuario mayor a 5 caracteres, etc)
        if (count($this->submittedFields) == 0) {
            return;
        }
        foreach ($this->submittedFields as $fieldName => $value) {
            $fieldValidation = $this->fieldsValidationsTypes[$fieldName];
            if ($fieldValidation == Validation::$TEXT && $value == "") {
                $this->fieldsFeedback[$fieldName] = $this->errors[Validation::$TEXT];
                continue;
            }
            if (!$this->validations[$fieldValidation]($value)) {
                $this->fieldsFeedback[$fieldName] = $this->errors[$fieldValidation];
            }
        }
        if ($this->hasInvalidFields()) {
            return;
        }
        // validacion de login 
        // ! buscar otro implementacion, el validador no deberia de inicar sesion
        if ($this->appAction == Actions::$LOGIN) {
            if (!$this->validations[Validation::$USERLOGIN]($this->submittedFields["id"], $this->submittedFields["password"])) {
                $this->fieldsFeedback["id"] = $this->errors[Validation::$USERLOGIN];
            } else {
                App::setUserLogin($this->submittedFields["id"]);
            }
        }
    }

    function hasInvalidFields():bool {
        return count($this->fieldsFeedback) > 0;
    }
}