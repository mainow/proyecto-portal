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

    static function redirectUser(string $url) {
        header("Location: {$url}");
    }

    static function isUserLoggedIn():bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION["username"]) ? true : false;
    }
    
    static function accountExists(string $username, string $pwd):bool {
        $users = new UsersModel;
        return $users->accountExists($username, $pwd);
    }
    
    static function setUserLogin(string $username) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["username"] = $username;
    }
}