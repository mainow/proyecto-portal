<?php

class Field {
    function __construct(string $type, string $name, string $placeholder, $validation=null, string $fAIcon="fas fa-info-circle") {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->validation = $validation ?? Validation::$TEXT;
        $this->fAIcon = $fAIcon;
        $this->invalidFeedback = "";
    }
    
    function setInvalidFeedback(string $feedback) {
        $this->invalidFeedback = $feedback;
    }

    function __toString() {
        $cssClass = $this->invalidFeedback ? "is-invalid" : "";
        return <<<HTML
        <div class="input-group mb-3">
            <input type="$this->type" name="$this->name" placeholder="$this->placeholder" class="form-control $cssClass">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="$this->fAIcon"></span>
            </div>
          </div>
            <div class="invalid-feedback">
                $this->invalidFeedback
            </div>
        </div>
        HTML;
    }
}