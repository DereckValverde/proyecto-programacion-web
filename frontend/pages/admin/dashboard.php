<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../assets/images/LOGO.png">
    <link rel="stylesheet" href="../../assets//css/admin-dashboard.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#inicio">
                <img src="../../assets/images/LOGO.png"" alt=" ConectiTicos" class="navbar-logo"> ConectiTicos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menú">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio" data-section="inicio">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mision" data-section="mision">Gestión de Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#impacto" data-section="impacto">Gestión de Donaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto" data-section="contacto"><i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        <div class="container-fluid px-4">
            <h2 class="dashboard-title">
                Panel Administrativo
            </h2>
            <p class="dashboard-message">¡Bienvenido de nuevo, Dereck!</p>
            <div class="row g-4">

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card card-coral bg-danger border border-2 border border-light rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-5 mb-0">Solicitudes Pendientes</p>
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>

                        <h3 class="card-value fw-bold mt-4 mb-0">54</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card card-pine bg-success border border-2 border border-light rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-5 mb-0">Donaciones Completadas</p>
                            <i class="bi bi-check-circle fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold mt-4 mb-0">120</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card card-grey bg-warning border border-2 border border-light rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <p class="card-title fw-bold fs-5">Impacto Ambiental</p>
                            <i class="bi bi-tree fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold fs-4 mt-4 mb-0">450 kg</h3>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>