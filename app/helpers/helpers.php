<?php


//Método para cargar vistas
function view(string $viewPath, array $data = [])
{
    extract($data); //Para en el futuro pasar parametros si hace falta

    $file = VIEW_PATH . '/' . $viewPath . '.php';

    if (file_exists($file)) {

        require_once $file;
    } else {
        die("La vista '{$viewPath}' no existe.");
    }
}

function redirect($url)
{
    header('Location: ' . BASE_URL . $url);
    exit;
}

function model($model)
{
    require_once __DIR__ . '/../models/' . $model . '.php';
    return new $model();
}
