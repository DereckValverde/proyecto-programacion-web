<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style-admin-login.css">
    <title>Proyecto</title>
</head>

<body>

    <body class="login-body">

        <div class="login-container">

            <h1>Acceso Administrativo</h1>

            <form id="frmLogin">
                <label for="">Usuario:</label>
                <input type="email" name="correo" id="correo" autocomplete="email" required>

                <label for="">Contraseña</label>
                <input type="password" name="password" id="password" autocomplete="current-password" required>

                <p id="msgError"></p>
                <button type="submit">Inciar Sesión</button>
            </form>

        </div>
    </body>

    <script src="../../assets/js/login.js"></script>
</html>