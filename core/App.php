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
}