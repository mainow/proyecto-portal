
<?php

class View {
    /**
     * View
     * * Clase padre de todas las vistas
     * ! Funciona trabajando con el modelo de layout + vista
     */
    public $VIEWS_LAYOUTS = [
        "home" => "main",
        "login" => "",
        "badrequest" => "main",
        "dashboard" => "dashboard",
        "base-dashboard" => "dashboard",
        "dashboard-profile" => "dashboard",
        "dashboard-users" => "dashboard",
        "dashboard-categories" => "dashboard"
    ];

    function __construct(string $viewName) {
        $this->viewName = $viewName;
    }

    function render(array $params=[]) {
        echo($this->getViewHtml($params));
    }

    function getViewHtml(array $params=[]) {
        $htmlHeadContent = $this->getFileContent("views/layouts/head.php");
        $jsScripts = $this->getFileContent("views/layouts/jsScripts.php");
        $layoutName = $this->VIEWS_LAYOUTS[$this->viewName];
        $layoutContent = $layoutName == "" ? "<div>{{ content }}</div>" : $this->getFileContent("views/layouts/{$this->VIEWS_LAYOUTS[$this->viewName]}.php");
        $viewContent = $this->getFileContent("views/{$this->viewName}.php", $params);
        $bodyContent = str_replace("{{ content }}", $viewContent, $layoutContent);
        return <<<HTML
        <html>
        $htmlHeadContent
        $bodyContent
        $jsScripts
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