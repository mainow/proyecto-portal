<?php 

class FormHandler {
    /**
     * FormHandler
     * * Validacion de formularios
     */
    static function requestValueExists(array $method, string $key) {
        return isset($method[$key]) ? true : false;
    }
    
    static function getSubmittedData(array $method, array $keywords):array {
        $keysOut = [];
        foreach ($keywords as $keyword) {
            if (isset($method[$keyword])) {
                $keysOut[$keyword] = $method[$keyword];
            }
        }
        return $keysOut;
    }

    static function hasEmptyField(array $input):bool {
        foreach ($input as $data) {
            if (empty($data)) {
                return true;
            }
        }
        return false;
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
        if ($username != $pwd) {
            return true;
        }
        return false;
    }

    static function passwordsMatch(string $pwd, string $pwdRepeat):bool {
        return $pwd == $pwdRepeat;
    }
}