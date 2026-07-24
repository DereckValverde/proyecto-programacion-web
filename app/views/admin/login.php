<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL . '/public/css/style-admin-login.css'?>">
    <title>Proyecto</title>
</head>

<body>

    <body class="login-body">

        <div class="login-container">

            <h1>Acceso Administrativo</h1>

            <form action="<?= BASE_URL . 'auth/login'?>" method="POST">

                <label for="">Usuario:</label>
                <input type="email" name="correo" id="usercorreoname" required>

                <label for="">Contraseña</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Inciar Sesión</button>

            </form>

        </div>
    </body>

</html>