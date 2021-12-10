<?php

require_once "Autoloader.php";

$router = new Router;
$router->set("/home", Home::class);
$router->set("/login", Login::class);
$router->set("/logout", Logout::class);
$router->set("/dashboard", Dashboard::class);
$router->set("_404", BadRequest::class);
$app = new App($router);