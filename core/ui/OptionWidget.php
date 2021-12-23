<?php

class OptionWidget extends Widget {
    function __construct(string $value, string $text, string $validation="", string $properties="") {
        parent::__construct("", $validation);
        $this->text = $text;
        $this->value = $value;
        $this->properties = $properties;
    }

    function __toString() {
        $properties = $this->properties;
        return <<<HTML
        <option value="{$this->value}" $properties>
            $this->text
        </option>
        HTML;
    }
}