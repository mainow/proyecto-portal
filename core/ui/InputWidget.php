<?php

class InputWidget extends Widget {
    /**
     * Field
     * * Crea un <input> que de manera dinamica
     * Permite crear inputs y establecer parametros, validations, labels, iconos, etc.
     * ! Debe ser llamado como un string para renderisarse el input
     * ej: echo(new Field("text"...));
     */
    function __construct(string $type, string $name, string $placeholder, string $validation="", string $fAIcon="fas fa-info-circle", string $label="", string $cssClasses="", string $style="") {
        $this->type = $type;
        parent::__construct($name, $validation);
        $this->placeholder = $placeholder;
        $this->fAIcon = $fAIcon;
        $this->invalidFeedback = "";
        $this->value = "";
        $this->label = $label;
        $this->cssClasses= $cssClasses;
        $this->style = $style;
    }

    function __toString() {
        $isInvalidCssClass = $this->invalidFeedback ? "is-invalid" : "";
        $label = $this->label != "" ? <<<HTML
        <label class="form-label">$this->label</label>
        HTML : "";
        return <<<HTML
        <div class="col-md mb-3 $this->cssClasses" style="$this->style">
            $label
            <div class="input-group">
                <input type="$this->type" required name="$this->name" value="$this->value" placeholder="$this->placeholder" class="form-control $isInvalidCssClass">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="$this->fAIcon"></span>
                    </div>
                </div>
                <div class="invalid-feedback">$this->invalidFeedback</div>
            </div>
        </div>
        HTML;
    }
}