<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL . '/public/css/style-admin-login.css' ?>">
    <title>Proyecto</title>
</head>

<body>

    <body class="login-body">

        <div class="login-container">

            <h1>Acceso Administrativo</h1>

            <form action="<?= BASE_URL . 'login' ?>" method="POST">

                <label for="">Correo:</label>
                <input type="email" name="correo" id="usercorreoname" placeholder="admin@ejemplo.com" required>

                <label for="">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="***********" required>

                <?php if (isset($_SESSION['error'])): ?>

                    <div class="alerta-error">
                        <?= $_SESSION['error']; ?>
                    </div>

                    <?php unset($_SESSION['error']) ?>
                <?php endif; ?>

                <button type="submit">Inciar Sesión</button>

            </form>

        </div>
    </body>

</html>