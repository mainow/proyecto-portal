<?php

class OptionWidget extends Widget {
    function __construct(string $name, string $text, string $validation="") {
        parent::__construct($name, $validation);
        $this->text = $text;
    }

    function __toString() {
        return <<<HTML
        <option value="{$this->name}">
            $this->text
        </option>
        HTML;
    }
}