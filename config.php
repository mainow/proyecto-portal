<?php
require_once "core/Database.php";

$USERS_DB = new DataBaseInfo("localhost", "root", "", "test");

$LOGIN_STATUS_MSGS = [
    "empty-fields" => "Complete todos los campos!",
    "user-not-found" => "Usuario o contraseña incorrectos!"
];

$LOGIN_STATUS = [
    "empty-fields" => "empty-fields",
    "user-not-found" => "user-not-found",
    "user-found" => "user-found"
];