<?php

class InputWidget extends Widget {
    /**
     * Field
     * * Crea un input que de manera dinamica permite establecer parametros, validaciones, labels, iconos, etc.
     * ! Debe ser llamado como un string para renderisarse
     * ej: echo(new Field("text"...));
     */
    function __construct(string $type, string $name, string $placeholder, string $validation="", string $fAIcon="fas fa-info-circle", string $label="", string $cssClasses="", string $style="", string $properties="", $value="") {
        $this->type = $type;
        parent::__construct($name, $validation);
        $this->placeholder = $placeholder;
        $this->fAIcon = $fAIcon;
        $this->invalidFeedback = "";
        $this->value = $value;
        $this->label = $label;
        $this->cssClasses= $cssClasses;
        $this->style = $style;
        $this->properties = $properties;
    }

    function __toString() {
        $isInvalidCssClass = $this->invalidFeedback ? "is-invalid" : "";

        $label = $this->label != "" ? <<<HTML
        <label class="form-label">$this->label</label>
        HTML : "";
        
        /**
         * Si el input es de tipo hidden solo devoler el input solo para evitar problemas de estilos 
         * con los contenedores de input-group, input-group-append, etc
         */
        return $this->type == "hidden" ? 
        <<<HTML
        <input type="$this->type" name="$this->name" value="$this->value" placeholder="$this->placeholder" class="form-control $isInvalidCssClass" $this->properties>
        HTML
        :
        <<<HTML
        <div class="col-md mb-3 $this->cssClasses" style="$this->style">
            $label
            <div class="input-group">
                <input type="$this->type" name="$this->name" value="$this->value" placeholder="$this->placeholder" class="form-control $isInvalidCssClass" $this->properties>
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