<?php

class App
{
    protected $controller = 'HomeController';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Validar si existe un controlador enviado por URL
        if (isset($url[0]) && file_exists('./app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            
            $this->controller = ucfirst($url[0]) . 'Controller';

            unset($url[0]);
        }

        // Cargar el archivo del controlador
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        // Crear instancia del controlador
        $this->controller = new $this->controller;


        // Validar si existe un método enviado por URL
        if (isset($url[1])) {

            if (method_exists($this->controller, $url[1])) {

                $this->method = $url[1];

                unset($url[1]);
            }
        }


        // Guardar parámetros restantes
        $this->params = $url ? array_values($url) : [];


        // Ejecutar controlador, método y parámetros
        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }


    public function parseUrl()
    {
        if (isset($_GET['url'])) {

            return explode(
                '/',
                filter_var(
                    rtrim($_GET['url'], '/'),
                    FILTER_SANITIZE_URL
                )
            );
        }

        return [];
    }
}