<?php
// app/controllers/AuthController.php

require_once APP_PATH . 'config/config.php';

class AuthController
{

    //Vista del login para administradores únicamente
    public function index()
    {
        require_once APP_PATH . 'views/admin/login.php';
    }

    public function processLogin()
    {

        // Verificar que los datos lleguen por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = trim($_POST['correo'] ?? '');
            $password = trim($_POST['password'] ?? '');

            //Validación básica
            if (empty($email) || empty($password)) {
                $error = "Todos los campos son necesarios.";
                require_once VIEW_PATH . '/admin/login.php';
                return;
            }

            //Llamar al modelo para buscar el administrador por correo
            require_once APP_PATH . 'models/AdminModel.php';
            $adminModel = new AdminModel();
            $admin = $adminModel->getByEmail($email);

            //Verificar si el usuario existe y si la contraseña es la misma
            if ($admin && password_verify($password, $admin['contrasena'])) {

                //Credenciales correctas
                session_start();
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_id'] = $admin['idAdministrador'];
                $_SESSION['admin_name'] = $admin['nombre'];

                $adminModel->registrarLog('InicioSesion', 'Inicio de sesión del administrador.', $admin['idAdministrador']);

                //redirigir al dashboard
                header('Location: ' . BASE_URL . 'auth/dashboard');
                exit();
            } else {

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $adminModel->registrarLog('Error', 'Intento de acceso con contraseña incorrecta.', null);
                $_SESSION['error'] = "Correo o contraseña incorrectos.";


                //Redirigir a login para limpiar el formulario
                header('Location: ' . BASE_URL . 'auth');
                exit();
            }
        }
    }

    //Vista del dashboard
    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /*Si se intenta entrar a la vista del dashboard sin estar loggeado, entonces
        automaticamente se redirecciona de nuevo al login */
        if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
            header('Location: ' . BASE_URL . 'auth');
            exit();
        }

        //si está loggeado de manera correcta se carga la vista del dashboard
        view('admin/dashboard');
    }


    public function crud_solicitudes(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true){
            header('Location: ' . BASE_URL . 'auth');
            exit();
        }

        //Si está loggeado
        view('admin/crud-solicitudes');
    }

    public function crud_donaciones(){
        if(session_start() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true){
            
            header('Location: ' . BASE_URL . 'auth');
            exit();
        }

        //Si está loggeado
        view('admin/crud-donaciones');
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'auth');
        exit();
    }
}
