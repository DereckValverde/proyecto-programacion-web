<?php
// app/config/routes.php

$router = new Router();

$router->get('home', ['HomeController', 'index']);

$router->get('auth', ['AuthController', 'index']);
$router->get('auth/dashboard', ['AuthController', 'dashboard']);
$router->get('auth/solicitudes', ['AuthController', 'crud_solicitudes']);
$router->get('auth/donaciones', ['AuthController', 'crud_donaciones']);
$router->get('auth/logout', ['AuthController', 'logout']);

$router->get('donaciones/apiList', ['DonacionesController', 'apiList']);
$router->get('donaciones/apiShow', ['DonacionesController', 'apiShow']);
$router->get('donaciones/apiListEstado', ['DonacionesController', 'apiListEstado']);
$router->get('donaciones/apiKpis', ['DonacionesController', 'apiKpis']);
$router->post('donaciones/delete', ['DonacionesController', 'apiDelete']);

$router->get('solicitudes/apiList', ['SolicitudesController', 'apiList']);
$router->get('solicitudes/apiShow', ['SolicitudesController', 'apiShow']);
$router->get('solicitudes/apiListEstado', ['SolicitudesController', 'apiListEstado']);
$router->get('solicitudes/apiKpis', ['SolicitudesController', 'apiKpis']);

$router->get('error/404', ['ErroresController', 'Error404']);

$router->post('login', ['AuthController', 'processLogin']);

return $router;
