<?php

class Controller {
    /**
     * Controller
     * * Clase padre de todos los controladores
     * Por defecto solo contiene una funcion que permite renderizar
     * la vista que se la pase por parametros
     * ! La vista tiene que ser el nombre de un archivo .php dentro de la carpeta /views/
     */
    function renderView(string $viewName, array $params=[]) {
        $this->view = new View($viewName);
        $this->view->render($params);
    }
}