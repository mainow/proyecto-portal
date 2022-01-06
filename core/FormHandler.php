<?php 

class FormHandler {
    /**
     * FormHandler
     * * Validacion de formularios
     */
    static function requestValueExists(array $method, string $key) {
        return isset($method[$key]) ? true : false;
    }
    
    static function categoryIsUnique(string $name) {
        $data = new DataModel;
        return $data->getCategory($name);
    }

    static function isIdInUse(string $id) {
        $users = new UserModel;
        return $users->valueExists("id", $id);
    }

    static function isEmailInUse(string $email) {
        $users = new UserModel;
        return $users->valueExists("email", $email);
    }

    static function getSubmittedData(array $method, array $keywords):array {
        $keysOut = [];
        foreach ($keywords as $keyword) {
            if (isset($method[$keyword])) {
                $keysOut[$keyword] = $method[$keyword];
            }
            // verificar si el valor existe en la variable $_FILES, esto para poder reconocer archivos subidos
            if (isset($_FILES[$keyword])) {
                $keysOut[$keyword] = $_FILES[$keyword];
            }
        }
        return $keysOut;
    }

    static function isValidEmail(string $email):bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    } 

    static function isValidUsername(string $username):bool {
        return strlen($username) >= 4;
    }

    static function isValidPassword(string $password):bool {
        return strlen($password) >= 3;
    }
    
    static function isCompatibleUsernameAndPassword(string $username, string $pwd):bool {
        return $username != $pwd;
    }

    static function passwordsMatch(string $pwd, string $pwdRepeat):bool {
        return $pwd == $pwdRepeat;
    }

    static function isValidPhoneNumber(string $number):bool {
        return strlen($number) > 5;
    }

    static function isFileValidImg(array $inputFileData):bool {
        $allowed = ["png", "jpg"];
        $filename = $inputFileData["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        return in_array($ext, $allowed) ? true : false;
    }
}