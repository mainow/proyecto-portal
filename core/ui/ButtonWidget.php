<?php

class ButtonWidget extends Widget {
    function __construct(string $name, string $text, string $value=null, string $cssClasses="", string $style="") {
        parent::__construct($name, "");
        $this->text = $text;
        $this->cssClasses = $cssClasses;
        $this->style = $style;
        $this->value = $value;
    }

    function __toString() {
        $cssClasses = $this->cssClasses;
        return <<<HTML
        <button class="btn btn-primary $cssClasses" name="$this->name" value=$this->value style="$this->style" >$this->text</button>
        HTML;
    }
}