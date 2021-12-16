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
        return isset($_SESSION["id"]) ? true : false;
    }
    
    static function accountExists(string $username, string $pwd):bool {
        $users = new UserModel;
        return $users->accountExists($username, $pwd);
    }
    
    static function setUserLogin(string $username) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["id"] = $username;
    }
    
    static function getLoggedInUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (self::isUserLoggedIn()) {
            return $_SESSION["id"];
        } 
        return false;
    }

    static function isAdminLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION["id"] == "112233";
    }
}