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
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link" href="#" data-section="mision">Gestión de Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="impacto">Gestión de Donaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="contacto"><i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        <div class="d-flex flex-column container-fluid px-4 gap-3">

            <div>
                <p>Panel Administrativo / <strong>Dashboard</strong></p>
                <h2 class="dashboard-title">Panel Administrativo</h2>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-4">
                    <div class="dashboard-card text-light bg-danger border border-2 border-dark rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-5 mb-0">Solicitudes Pendientes</p>
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold mt-4 mb-0">54</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card text-light bg-success border border-2 border-dark rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-5 mb-0">Donaciones Completadas</p>
                            <i class="bi bi-check-circle fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold mt-4 mb-0">120</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card text-light bg-warning border border-2 border-dark rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <p class="card-title fw-bold fs-5">CO₂ Evitado</p>
                            <i class="bi bi-tree fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold fs-4 mt-4 mb-0">450 kg CO₂e</h3>
                    </div>
                </div>
            </div>

            <div class="row pt-4 g-4">

                <div class="col-12 col-md-8 d-flex flex-column">
                    <div class="white-panel bg-white text-dark p-4 rounded-3 shadow-sm h-100">
                        <h5 class="fw-bold mb-4">Histórico Mensual de Donaciones</h5>
                        <canvas id="lineChart" style="max-height: 400px; width: 100%;"></canvas>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column">
                    <div class="white-panel bg-white text-dark p-4 rounded-3 shadow-sm h-100">
                        <h5 class="fw-bold mb-4 text-center">Tipos de Equipos Donados</h5>
                        <canvas id="chartArea"></canvas>
                    </div>
                </div>
            </div>

            <div class="row pt-4 g-4">
                <div class="col-12 col-md-8 d-flex flex-column">
                    <div class="white-panel bg-white text-dark p-4 rounded-3 shadow-sm h-100">

                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                            <h5 class="fw-bold mb-0">Solicitudes</h5>
                            <button type="button" class="btn btn-outline-info btn-sm py-1 px-4">Ver Todas</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-center align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Beneficiario</th>
                                        <th scope="col">Equipo Solicitado</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Beneficiario 1</td>
                                        <td>10 Laptops</td>
                                        <td>12/12/2022</td>
                                        <td class="d-flex flex-wrap justify-content-center gap-2">
                                            <button type="button" class="btn btn-primary btn-sm rounded-2 flex-fill">Ver Más</button>
                                            <button type="button" class="btn btn-danger btn-sm rounded-2 flex-fill">Rechazar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Beneficiario 2</td>
                                        <td>5 Monitores</td>
                                        <td>12/12/2022</td>
                                        <td class="d-flex flex-wrap justify-content-center gap-2">
                                            <button type="button" class="btn btn-primary btn-sm rounded-2 flex-fill">Ver Más</button>
                                            <button type="button" class="btn btn-danger btn-sm rounded-2 flex-fill">Rechazar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Beneficiario 3</td>
                                        <td>22 Teclados</td>
                                        <td>12/12/2022</td>
                                        <td class="d-flex flex-wrap justify-content-center gap-2">
                                            <button type="button" class="btn btn-primary btn-sm rounded-2 flex-fill">Ver Más</button>
                                            <button type="button" class="btn btn-danger btn-sm rounded-2 flex-fill">Rechazar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column">
                    <div class="white-panel bg-white text-dark p-4 rounded-3 shadow-sm h-100">
                        <h5 class="fw-bold mb-4">Últimos Logs (Auditoría)</h5>
                        <div class="list-group list-group-flush class-logs-container">

                            <div class="list-group-item px-0 py-3 border-0 border-bottom">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">
                                        Creación
                                    </span>
                                    <small class="text-muted fw-semibold">Hace 2 min</small>
                                </div>
                                <p class="mb-1 text-secondary small fw-medium"><strong>Beneficiario 99</strong> registró una nueva solicitud de 20 Laptops.</p>
                            </div>

                            <div class="list-group-item px-0 py-3 border-0 border-bottom">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1 small">
                                        Modificación
                                    </span>
                                    <small class="text-muted fw-semibold">Hace 15 min</small>
                                </div>
                                <p class="mb-1 text-secondary small fw-medium">Se actualizaron los datos de la solicitud id: <strong>11</strong>.</p>
                            </div>

                            <div class="list-group-item px-0 py-3 border-0">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 small">
                                        Error
                                    </span>
                                    <small class="text-muted fw-semibold">Hace 1 hora</small>
                                </div>
                                <p class="mb-1 text-secondary small fw-medium">Intento de inicio de sesión fallido para el usuario <strong>admin_test</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/js/dashboard-admin.js"></script>
</body>

</html>