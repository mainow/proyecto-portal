<?php

class App {
    /**
     * App
     * * Inicializa el router
     * ? Funcionalidad de redireccionamiento y verificacion deberian estar aqui?
     */
    
    function __construct(Router $router) {
        $router->resolve();
    }

    
    static function getBaseUrl():string {
        return "http://{$_SERVER['HTTP_HOST']}";
    }

    static function redirectUser(string $url) {
        $base = self::getBaseUrl();
        header("Location: $base/$url");
    }

    static function isUserLoggedIn():bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION["username"]) ? true : false;
    }
    
    static function accountExists(string $username, string $pwd):bool {
        $users = new UserModel;
        return $users->accountExists($username, $pwd);
    }
    
    static function setUserLogin(string $username) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["username"] = $username;
    }
    
    static function getLoggedInUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (self::isUserLoggedIn()) {
            return $_SESSION["username"];
        } 
        return false;
    }
}