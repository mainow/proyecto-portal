<?php

require_once "autoloader.php";

$router = new Router;
$router->set("/", Home::class);
$router->set("/home", Home::class);
$router->set("/login", Login::class);
$router->set("/logout", Logout::class);
$router->set("/dashboard", Dashboard::class);
$router->set("/test", Test::class);
$router->set("_404", BadRequest::class);
$app = new App($router);