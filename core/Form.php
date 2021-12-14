<?php

class Form {
    static function create(string $action, string $method, $validator, array $fields, string $submitBtnText) {
        $fieldsHTML = "";
        $submitAttachedValue = [];
        $validator = $validator;
        foreach ($fields as $field) {
            $field->setInvalidFeedback($validator->getFieldFeedback($field->name));
            $submitAttachedValue[$field->name] = $field->validation;
            $fieldsHTML .= "\n$field";
        }
        $submitAttachedValue = json_encode($submitAttachedValue);
        echo <<<HTML
        <form action="$action" method="$method">
            $fieldsHTML
            <button class="btn btn-primary btn-block" name="submit" value=$submitAttachedValue >$submitBtnText</button>
        </form>
        HTML;
    }
}