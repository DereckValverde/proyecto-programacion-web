<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>Error 404</title>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">

        <div class="bg-danger-subtle border border-danger rounded-4 shadow p-5 text-center">

            <div class="display-2 mb-3">
                <i class="bi bi-exclamation-triangle text-danger"></i>
            </div>

            <h1 class="fw-bold text-danger mb-3">¡Ups!</h1>

            <p class="fs-4 mb-2">
                No pudimos encontrar la página que buscas.
            </p>

            <p class="text-secondary mb-4">
                Es posible que haya sido eliminada, movida o que la dirección sea incorrecta.
            </p>

            <a href="<?= BASE_URL . 'home' ?>" class="btn btn-danger px-4">
                Volver a la página de inicio
            </a>

        </div>

    </div>

</body>

</html>