<?php

require_once "autoloader.php";
require_once "setup.php";

$router = new Router;
$router->set("/", Home::class);
$router->set("/home", Home::class);
$router->set("/login", Login::class);
$router->set("/logout", Logout::class);
$router->set("/dashboard", Dashboard::class);
$router->set("/dashboard/profile", Profile::class);
$router->set("/dashboard/categories", Categories::class);
$router->set("/dashboard/users", Users::class);
$router->set("_404", BadRequest::class);
$app = new App($router);