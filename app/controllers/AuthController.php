<?php
require_once dirname(__DIR__) . '/config/config.php';

class AuthController
{

    //Vista del login para administradores únicamente
    public function index()
    {
        require_once dirname(__DIR__) . '/views/admin/login.php';
    }

    public function login()
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
            require_once APP_PATH . '/models/AdminModel.php';
            $adminModel = new AdminModel();
            $admin = $adminModel->getByEmail($email);

            //Verificar si el usuario existe y si la contraseña es la misma
            if ($admin && password_verify($password, $admin['contrasena'])) {

                //Credenciales correctas
                session_start();
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_email'] = $admin['correo'];

                //redirigir al dashboard
                header('Location: ' . BASE_URL . 'auth/dashboard');
                exit();
            } else {
                $error = "Correo o contraseña incorrectos.";
                require_once VIEW_PATH . '/admin/login.php';
                return;
            }
        }
    }

    //Vista del dashboard
    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validar seguridad: si no está logueado, patada al login
        if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
            header('Location: ' . BASE_URL . 'auth');
            exit();
        }

        // Cargar la vista de forma segura
        require_once VIEW_PATH . '/admin/dashboard.php';
    }
}
