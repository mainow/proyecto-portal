<?php

class Form {
    /**
     * Form
     * * Permite crear formularios de manera dinamica
     * Consigue establecer validaciones, establecer valores por defecto un <input>, etc.
     */
    static function create(string $action, string $method, $validator, array $fields, ButtonWidget $submitBtn, array $fieldsValues=[], string $cssClasses="") {
        $fieldsHTML = "";
        $submitAttachedValue = [];
        foreach ($fields as $field) {
            // cuando se pasa un array para agrupar en columnas los campos
            if (is_array($field)) {
                $subFieldsContainer = "<div class='px-0 m-auto container-fluid row' style=''>";
                foreach ($field as $subField) {
                    if (isset($fieldsValues[$subField->name])) {
                        $subField->value = $fieldsValues[$subField->name];
                    }
                    $subField->invalidFeedback = $validator->getFieldFeedback($subField->name);
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
            $field->invalidFeedback = $validator->getFieldFeedback($field->name);
            $submitAttachedValue[$field->name] = $field->validation;
            $fieldsHTML .= "\n$field";
        }
        $submitAttachedValue = json_encode($submitAttachedValue);
        $submitBtn->value = $submitBtn->value ?? $submitAttachedValue;
        echo <<<HTML
        <form action="$action" method="$method" class="$cssClasses">
            $fieldsHTML
            $submitBtn
        </form>
        HTML;
    }

    static function _addField() {

    }
}