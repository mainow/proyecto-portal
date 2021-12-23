<?php

class FormWidget {
    /**
     * Form
     * * Permite crear formularios de manera dinamica
     * Consigue establecer validaciones, establecer valores por defecto un <input>, etc.
     */
    function __construct(string $action, string $method, FormValidator $validator, array $fields, ButtonWidget $submitBtn, array $fieldsValues=[], string $cssClasses="") {
        $this->action = $action;
        $this->method = $method;
        $this->validator = $validator;
        $this->fields = $fields;
        $this->submitBtn = $submitBtn;
        $this->fieldValues = $fieldsValues;
        $this->cssClasses = $cssClasses;
    }

    function __toString() {
        $fieldsHTML = "";
        $submitAttachedValue = [];
        foreach ($this->fields as $field) {
            // cuando se pasa un array para agrupar en columnas los campos
            if (is_array($field)) {
                $subFieldsContainer = <<<HTML
                <div class="px-0 m-auto container-fluid row">
                HTML;
                foreach ($field as $subField) {
                    if (isset($fieldsValues[$subField->name])) {
                        $subField->value = $fieldsValues[$subField->name];
                    }
                    $subField->invalidFeedback = $this->validator->getFieldFeedback($subField->name);
                    $submitAttachedValue[$subField->name] = $subField->validation;
                    $subFieldsContainer .= "\n$subField";
                }
                $subFieldsContainer .= "\n</div>";
                $fieldsHTML .= "\n$subFieldsContainer";
                continue;
            } 
            // cuando el campo no es un array
            if (isset($fieldsValues[$field->name])) {
                $field->value = $fieldsValues[$field->name];
            }
            $field->invalidFeedback = $this->validator->getFieldFeedback($field->name);
            $submitAttachedValue[$field->name] = $field->validation;
            $fieldsHTML .= "\n$field";
        }
        // transformar las validaciones de los campos en un json
        // ej: {"first-name": "TEXT_VALIDATION"}
        //       ^CAMPO         ^VALIDACION
        $submitAttachedValue = json_encode($submitAttachedValue);
        $this->submitBtn->value = $this->submitBtn->value ?? $submitAttachedValue;
        return <<<HTML
        <form action="$this->action" method="$this->method" class="$this->cssClasses">
            $fieldsHTML
            $this->submitBtn
        </form>
        HTML;
    }
}