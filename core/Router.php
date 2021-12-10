<?php

class Router {
    /**
     * Router
     * * Redirecciona usando la url
     * El redireccionamiento se hace con un array 
     * asociativo donde cada llave es una posible pagina del 
     * sitio, y esa llave apunta a una clase que sera inicializada
     * Esa clase deberia de ser el controlador para esa url
     * ! Si la URL no se encuentra en la $routes del router manda al propio valor 404 de $routes
     */
    protected array $routes = [];
    function set(string $path, $controller) {
        $this->routes[$path] = $controller;
    }

    function getPathFromUrl() {
        $path = $_SERVER["REQUEST_URI"] ?? "/";
        $pos = strpos($path, "?");
        if (!$pos) {
            return $path;
        }
        return substr($path, 0, $pos);
    }

    function resolve() {
        $path = $this->getPathFromUrl();
        if (!isset($this->routes[$path])) {
            // 404 si no se encuentra
            $this->requireController($this->routes["_404"]);
            exit;
        }
        // inicializar la clase que corresponde a esa url
        new $this->routes[$path];
    }
}