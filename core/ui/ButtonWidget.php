<?php

class ButtonWidget extends Widget {
    function __construct(string $name, string $text, string $value=null, string $cssClasses="", string $style="", string $properties="") {
        parent::__construct($name, "");
        $this->text = $text;
        $this->cssClasses = $cssClasses;
        $this->style = $style;
        $this->value = $value;
        $this->properties = $properties;
    }

    function __toString() {
        $cssClasses = $this->cssClasses;
        return <<<HTML
        <button class="btn btn-primary $cssClasses" name="$this->name" style="$this->style" $this->properties value=$this->value>$this->text</button>
        HTML;
    }
}