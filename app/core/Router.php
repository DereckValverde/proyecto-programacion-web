<?php
// app/core/Router.php

class Router
{

    //Arreglo que guarda las rutas
    private array $routes = [];

    //Registra Rutas de tipo 'GET'
    public function get(string $url, array $handler): void
    {
        $this->addRoute('GET', $url, $handler);
    }

    //Registrar Rutas de tipo 'POST'
    public function post(string $url, array $handler)
    {
        $this->addRoute('POST', $url, $handler);
    }

    //Guardar Rutas
    private function addRoute(string $method, string $url, array $handler): void
    {
        $url = trim($url, '/');
        $this->routes[$method][$url] = $handler;
    }

    public function dispatch(string $url, string $method): void
    {
        $url = trim($url, '/');


        //Verificar si existe la ruta para GET o POST
        if (isset($this->routes[$method][$url])) {

            //Extraer nombre del controlador y método
            [$controllerClass, $methodName] = $this->routes[$method][$url];

            $controllerFile = APP_PATH . '/controllers/' . $controllerClass . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                $controller = new $controllerClass();

                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                    return;
                }
            }
        }

        //Si la ruta o controller no existen
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
    }
}
