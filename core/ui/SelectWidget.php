<?php

class SelectWidget extends Widget {
    /**
     * SelectWidget
     * * Crea un select con funcionalidades para un form con datos dinamicos
     */
    function __construct(string $name, array $options, string $label="", string $properties="") {
        parent::__construct($name, "");
        $this->options = $options;
        $this->label = $label;
        $this->properties = $properties;
    }

    function __toString() {
        $optionsHtml = "";
        foreach ($this->options as $option) {
            $optionsHtml .= $option;
        }
        $properties = $this->properties;
        return <<<HTML
        <div class="col-md mb-3">
            <label class="form-label">$this->label</label>
            <select name="$this->name" class="custom-select" $properties>
                $optionsHtml
            </select>
        </div>
        HTML;
    }
}