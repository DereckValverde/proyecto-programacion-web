<?php
// app/config/routes.php

$router = new Router();

$router->get('',['HomeController','index']);
$router->get('auth',['AuthController','index']);
$router->get('auth/dashboard',['AuthController','dashboard']);
$router->get('auth/solicitudes',['AuthController','crud_solicitudes']);
$router->get('auth/donaciones',['AuthController','crud_donaciones']);
$router->get('auth/logout',['AuthController','logout']);

$router->post('login',['AuthController','processLogin']);

return $router;