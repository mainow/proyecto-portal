<?php

class ButtonWidget extends Widget {
    /**
     * ButtonWidget
     * * Crea un boton con estilos y funcionalidades para un form
     */
    function __construct(string $name, string $text, $value=null, string $cssClasses="", string $style="", string $properties="") {
        parent::__construct($name, "");
        $this->text = $text;
        $this->cssClasses = $cssClasses;
        $this->style = $style;
        $this->value = $value;
        $this->properties = $properties;
    }

    function __toString() {
        $cssClasses = $this->cssClasses;
        $properties = $this->properties;
        $value = $this->value;
        return <<<HTML
        <button class="btn btn-primary $cssClasses" name="$this->name" style="$this->style" $properties value=$value>$this->text</button>
        HTML;
    }
}