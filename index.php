<?php

require_once './app/config/config.php';

require_once './app/helpers/helpers.php';
require_once './app/core/Router.php';


$router = require_once './app/config/routes.php';

$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($url, $method);