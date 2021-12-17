<?php

class Widget {
    function __construct(string $name, string $validation) {
        $this->name = $name;
        $this->validation = $validation == "" ? Validation::$TEXT : $validation;
        $this->invalidFeedback = "";
    }
}