<?php

class View {
    /**
     * View
     * * Clase padre de todas las vistas
     * ! Funciona trabajando con el modelo de layout + vista
     */
    public $NOLAYOUT_VIEWS = [
        "dashboard",
        "login"
    ];

    function __construct(string $viewName) {
        $this->viewName = $viewName;
    }

    function render(array $params=[]) {
        echo($this->getViewHtml($params));
    }

    function getViewHtml(array $params=[]) {
        $htmlHeadContent = $this->getFileContent("views/layouts/head.php");
        $layoutContent = $this->getFileContent("views/layouts/main.php");
        $jsScriptsContent = $this->getFileContent("views/layouts/scripts.php");
        $viewContent = $this->getFileContent("views/{$this->viewName}.php", $params);
        $bodyContent = in_array($this->viewName, $this->NOLAYOUT_VIEWS) ? $viewContent : str_replace("{{ content }}", $viewContent, $layoutContent);
        return <<<HTML
        <html>
            {$htmlHeadContent}
        <body>
            {$bodyContent}
            {$jsScriptsContent}
        </body>
        </html>
        HTML;
    }

    function getFileContent(string $filename, array $params=[]) {
        ob_start();
        $params = $params;
        include_once $filename;
        return ob_get_clean();
    }
}