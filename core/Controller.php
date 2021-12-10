<?php

class Controller {
    /**
     * Controller
     * * Clase padre de todos los controladores
     * Por defecto solo contiene una funcion que permite renderizar
     * la vista que se la pase por parametros
     * ! La vista tiene que ser el nombre de un archivo .php dentro de la carpeta /views/
     */
    function __construct(string $viewName) {
        $this->view = new View($viewName);
    }

    function renderView() {
        $this->view->render();
    }
}