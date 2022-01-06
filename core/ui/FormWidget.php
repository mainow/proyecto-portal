<?php

class FormWidget {
    /**
     * Form
     * * Permite crear formularios de manera dinamica
     * Consigue establecer validaciones, establecer valores por defecto un <input>, etc.
     */
    public $submitAttachedValue = [];
    function __construct(string $action, string $method, FormValidator $validator, array $fields, ButtonWidget $submitBtn, array $fieldsValues=[], string $cssClasses="") {
        $this->action = $action;
        $this->method = $method;
        $this->validator = $validator;
        $this->fields = $fields;
        $this->submitBtn = $submitBtn;
        $this->fieldsValues = $fieldsValues;
        $this->cssClasses = $cssClasses;
    }

    function prepareField($field) {
        if (isset($this->fieldsValues[$field->name])) {
            $field->value = $this->fieldsValues[$field->name];
        }
        $field->invalidFeedback = $this->validator->getFieldFeedback($field->name);
        $this->submitAttachedValue[$field->name] = $field->validation;
        return $field;
    }

    function __toString() {
        $fieldsHTML = "";
        foreach ($this->fields as $field) {
            if (!is_array($field)) {
                $fieldsHTML .= "\n".$this->prepareField($field);
                continue;
            }
            // cuando se pasa un array para agrupar en columnas los campos
            $subFieldsContainer = <<<HTML
            <div class="px-0 m-auto container-fluid row">
            HTML;
            foreach ($field as $subField) {
                $subFieldsContainer .= "\n".$this->prepareField($subField);
            }
            $subFieldsContainer .= <<<HTML
            </div>
            HTML;
            $fieldsHTML .= "\n$subFieldsContainer";
        }
        // transformar las validaciones de los campos en un json
        // ej: {"first-name": "TEXT_VALIDATION"}
        //       ^CAMPO         ^VALIDACION
        $submitAttachedValue = json_encode($this->submitAttachedValue);
        $this->submitBtn->value = $this->submitBtn->value ?? $submitAttachedValue;
        return <<<HTML
        <form action="$this->action" method="$this->method" class="$this->cssClasses" enctype="multipart/form-data">
            $fieldsHTML
            $this->submitBtn
        </form>
        HTML;
    }
}