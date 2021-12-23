<?php 

class FormValidator extends FormHandler {
    /**
     * FormValidator
     * * Validacion de formularios
     */
    public $fieldsFeedback = [];
    public $submittedFields= [];
    public $fieldsValidationsTypes = [];
    public $formValidated = false;
    function __construct(string $appAction, array $method, array $keywords, string $submitButtonName) {

        $this->errors = [
            Validation::$TEXT => "Campo Vacio",
            Validation::$EMAIL => "Correo electronico invalido",
            Validation::$PWD => "Contraseña invalida",
            Validation::$USERNAME => "Nombre de usuario invalido",
            Validation::$USERLOGIN => "Nombre de usuario o contraseña incorrectos",
            Validation::$PHONENUMBER => "Numero de teléfono invalido",
            Validation::$CATEGORYEXISTS => "La categoria ya existe!",
            Validation::$EMAILINUSE => "El correo eletronico ya esta en uso!",
            Validation::$IDINUSE => "La cedula ya esta en uso!",
        ];
        $this->validations = [
            Validation::$TEXT => function ($value) { return !empty($value); },
            Validation::$EMAIL => function (string $email) { return $this::isValidEmail($email); },
            Validation::$PWD => function (string $pwd) { return $this::isValidPassword($pwd); },
            Validation::$USERNAME => function (string $username) { return $this::isValidUsername($username); },
            Validation::$USERLOGIN => function (string $username, string $password) { return App::accountExists($username, $password); },
            Validation::$PHONENUMBER => function (string $number) { return $this::isValidPhoneNumber($number); },
            Validation::$CATEGORYEXISTS => function (string $name) { return !$this::categoryIsUnique($name) || !empty($value); },
            Validation::$EMAILINUSE => function (string $email) { return !$this->isEmailInUse($email); },
            Validation::$IDINUSE => function ($id) { return !$this->isIdInUse($id); }
        ];
        // evita que el formulario se carge con datos de otros formularios con campos con nombres iguales
        $this->appAction = $appAction;
        $this->submitButtonName = $submitButtonName;
        $this->method = $method;
        if (!$this->formWasSubmitted()) {
            return;
        } 
        array_push($keywords, $submitButtonName);
        $this->submittedFields = $this::getSubmittedData($method, $keywords);
        if (isset($this->submittedFields[$submitButtonName])) {
            // json_decode porque el botton submit del form guarda todas las validaciones en un json
            // ej: {"first_name": "TEXT_VALIDATION"}
            $this->fieldsValidationsTypes = json_decode($this->submittedFields[$submitButtonName], true);
        }
        // eliminar el valor del boton para que no sea validado mas tarde 
        unset($this->submittedFields[$submitButtonName]);

        if ($this->formWasSubmitted()) {
            $this->validateFields();
        }
        
    }
    
    function formWasSubmitted():bool {
        return isset($this->method[$this->submitButtonName]);
    }

    function wasValidated():bool {
        return $this->formValidated;
    }

    function getFieldFeedback(string $fieldName):string {
        return $this->fieldsFeedback[$fieldName] ?? 0;
    }
    
    function validateFields() {
        if (count($this->submittedFields) == 0) {
            return;
        }
        $this->formValidated = true;
        // solo validacion de campos (nombre de usuario mayor a 5 caracteres, etc)
        foreach ($this->submittedFields as $fieldName => $value) {
            $fieldValidation = $this->fieldsValidationsTypes[$fieldName];
            // validar primero si el campo esta vacio
            if (!$this->validations[Validation::$TEXT]($value)) {
                $this->fieldsFeedback[$fieldName] = $this->errors[Validation::$TEXT];
                continue; // * si esta vacio quedarse con ese error
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
        if ($this->appAction == Actions::$LOGIN && !$this->validations[Validation::$USERLOGIN]($this->submittedFields["id"], $this->submittedFields["password"])) {
                $this->fieldsFeedback["id"] = $this->errors[Validation::$USERLOGIN];
        } else if($this->appAction == Actions::$LOGIN) {
            App::setUserLogin($this->submittedFields["id"]);
        }
    }

    function hasInvalidFields():bool {
        return count($this->fieldsFeedback) > 0;
    }
}