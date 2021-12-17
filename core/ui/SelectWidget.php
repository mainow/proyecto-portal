<?php

class SelectWidget extends Widget {
    function __construct(string $name, array $options,string $label="") {
        parent::__construct($name, "");
        $this->options = $options;
        $this->label = $label;
    }

    function __toString() {
        $optionsHtml = "";
        foreach ($this->options as $option) {
            $optionsHtml .= $option;
        }
        return <<<HTML
        <div class="col-md mb-3">
            <label class="form-label">$this->label</label>
            <select class="custom-select">
                $optionsHtml
            </select>
        </div>
        HTML;
    }
}