<?php
// app/config/routes.php

$router = new Router();

$router->get('home', ['HomeController', 'index']);
$router->get('', ['HomeController', 'index']);

$router->get('auth', ['AuthController', 'index']);
$router->get('auth/dashboard', ['AuthController', 'dashboard']);
$router->get('auth/solicitudes', ['AuthController', 'crud_solicitudes']);
$router->get('auth/donaciones', ['AuthController', 'crud_donaciones']);
$router->get('auth/logout', ['AuthController', 'logout']);

$router->get('donaciones/apiList', ['DonacionesController', 'apiList']);
$router->get('donaciones/apiShow', ['DonacionesController', 'apiShow']);
$router->get('donaciones/apiListEstado', ['DonacionesController', 'apiListEstado']);
$router->get('donaciones/apiKpis', ['DonacionesController', 'apiKpis']);
$router->post('donaciones/rechazar', ['DonacionesController', 'apiRechazar']);
$router->post('donaciones/aceptar', ['DonacionesController', 'apiAceptar']);
$router->post('donaciones/completar', ['DonacionesController', 'apiCompletar']);
$router->post('donaciones/eliminar', ['DonacionesController', 'apiEliminar']);
$router->post('donaciones/crear', ['DonacionesController', 'apiCrear']);
$router->post('donaciones/actualizar', ['DonacionesController', 'apiActualizar']);

$router->get('solicitudes/apiList', ['SolicitudesController', 'apiList']);
$router->get('solicitudes/apiShow', ['SolicitudesController', 'apiShow']);
$router->get('solicitudes/apiListEstado', ['SolicitudesController', 'apiListEstado']);
$router->get('solicitudes/apiKpis', ['SolicitudesController', 'apiKpis']);
$router->post('solicitudes/aceptar', ['SolicitudesController', 'apiAceptar']);
$router->post('solicitudes/rechazar', ['SolicitudesController', 'apiRechazar']);
$router->post('solicitudes/eliminar', ['SolicitudesController', 'apiEliminar']);
$router->post('solicitudes/crear', ['SolicitudesController', 'apiCrear']);
$router->post('solicitudes/actualizar', ['SolicitudesController', 'apiActualizar']);

// Rutas públicas para el sitio
$router->post('formularios/donacion', ['FormulariosController', 'guardarDonacion']);
$router->post('formularios/solicitud', ['FormulariosController', 'guardarSolicitud']);
$router->post('formularios/contacto', ['FormulariosController', 'guardarContacto']);

$router->get('dashboard/apiKpis', ['DashboardController', 'apiKpis']);
$router->get('dashboard/apiHistorialMensual', ['DashboardController', 'apiHistorialMensual']);
$router->get('dashboard/apiTiposEquipos', ['DashboardController', 'apiTiposEquipos']);
$router->get('dashboard/apiSolicitudesRecientes', ['DashboardController', 'apiSolicitudesRecientes']);
$router->get('dashboard/apiLogs', ['DashboardController', 'apiLogs']);

$router->get('error/404', ['ErroresController', 'Error404']);

$router->post('login', ['AuthController', 'processLogin']);

return $router;
