<?php


class View {
    public $NOLAYOUT_VIEWS = [
        "dashboard"
    ];

    function __construct(string $viewName) {
        $this->viewName = $viewName;
    }

    function render() {
            $htmlHeadContent = $this->getContent("views/layouts/head.php");
            $layoutContent = $this->getContent("views/layouts/main.php");
            $jsScriptsContent = $this->getContent("views/layouts/scripts.php");
            $viewContent = $this->getContent("views/{$this->viewName}.php");
            $bodyContent = in_array($this->viewName, $this->NOLAYOUT_VIEWS) ? $viewContent : str_replace("{{ content }}", $viewContent, $layoutContent);
            $finalHTML = <<<HTML
            <html>
                {$htmlHeadContent}
            <body>
                {$bodyContent}
                {$jsScriptsContent}
            </body>
            </html>
            HTML;
        echo($finalHTML);
    }

    function getContent(string $filename) {
        ob_start();
        include_once $filename;
        return ob_get_clean();
    }
}