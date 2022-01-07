<?php

class AlertWidget {
    /**
     * AlertWidgt
     * * Crea un alerta
     */
    function __construct(string $msg) {
        $this->msg = $msg;
    }

    function __toString() {
        return <<<HTML
        <script>alert("$this->msg")</script>
        HTML;
    }
}