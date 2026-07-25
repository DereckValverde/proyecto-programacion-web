<?php
// app/config/routes.php

$router = new Router();

$router->get('',['HomeController','index']);
$router->get('auth',['AuthController','index']);
$router->get('dashboard',['AuthController','dashboard']);

$router->post('login',['AuthController','processLogin']);

return $router;