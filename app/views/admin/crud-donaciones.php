<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../assets/images/LOGO.png">
    <link rel="stylesheet" href="../../assets/css/style-crud-donaciones.css">
    <title>Panel Administrativo - Donaciones</title>
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
                        <a class="nav-link" href="./dashboard.php" data-section="inicio">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./crud-solicitudes.php" data-section="mision">Gestión de Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./crud-donaciones.php" data-section="impacto">Gestión de Donaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="contacto"><i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        <div class="d-flex flex-column container-fluid px-4 gap-5">

            <div class="dashboard-head">
                <p>Panel Administrativo / <strong>Donaciones</strong></p>
                <h2>Gestión de Donaciones</h2>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow text-dark bg-white border border-1 border-dark-light rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title text-secondary  fw-bold fs-8 mb-0">Total de Donaciones</p>
                            <i class="bi bi-box2-heart fs-5 text-secondary"></i>
                        </div>
                        <h3 class="card-value text-dark fs-5 fw-bold mt-4 mb-0">21</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow border border-1 border-dark-light  rounded-4 p-3 donaciones-pendientes">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-8 mb-0">Pendientes de Revisar</p>
                            <i class="bi bi-clipboard-check fs-5"></i>
                        </div>
                        <h3 class="card-value fs-5 fw-bold mt-4 mb-0">11</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow text-dark bg-white border border-1 border-dark-light rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title text-secondary fw-bold fs-8 mb-0"> Donaciones Aceptadas</p>
                            <i class="bi bi-check-circle fs-5 text-secondary"></i>
                        </div>
                        <h3 class="card-value text-dark fs-5 fw-bold mt-4 mb-0">32</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow text-dark bg-white border border-1 border-dark-light rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title text-secondary fw-bold fs-8 mb-0">Donaciones Rechazadas</p>
                            <i class="bi bi-x-circle fs-5 text-secondary"></i>
                        </div>
                        <h3 class="card-value text-dark fs-5 fw-bold mt-4 mb-0">13</h3>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-light rounded-pill boton-activo">Todas</button>
                <button class="btn btn-light border border-dark-light rounded-pill">Pendientes</button>
                <button class="btn btn-light border border-dark-light rounded-pill">Aceptadas</button>
                <button class="btn btn-light border border-dark-light rounded-pill">Rechazadas</button>
            </div>

            <div class="table-responsive border border-dark-light border border-bottom-0 rounded-3">
                <table class="table text-center align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Donante</th>
                            <th scope="col">Equipo Donado</th>
                            <th scope="col">Unidades</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Fundación Manos Unidas</th>
                            <td>Monitores</td>
                            <td>10</td>
                            <td>14/01/2024</td>
                            <td><span class="estado-pendiente">Pendiente</span></td>
                            <td>
                                <div class="acciones">
                                    <button title="Ver Más" class="boton-acciones" id="btn-ver-mas">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button title="Aceptar Donación" class="boton-acciones" id="btn-aceptar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button title="Rechazar Donación" class="boton-acciones" id="btn-rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Colegio Técnico de Cartago</th>
                            <td>Teclados</td>
                            <td>25</td>
                            <td>02/03/2024</td>
                            <td><span class="estado-aceptado">Aceptado</span></td>
                            <td>
                                <div class="acciones">
                                    <button title="Ver Más" class="boton-acciones" id="btn-ver-mas">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button title="Aceptar Donación" class="boton-acciones" id="btn-aceptar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button title="Rechazar Donación" class="boton-acciones" id="btn-rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Asociación Esperanza Verde</th>
                            <td>Mouse</td>
                            <td>15</td>
                            <td>18/04/2024</td>
                            <td><span class="estado-rechazado">Rechazado</span></td>
                            <td>
                                <div class="acciones">
                                    <button title="Ver Más" class="boton-acciones" id="btn-ver-mas">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button title="Aceptar Donación" class="boton-acciones" id="btn-aceptar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button title="Rechazar Donación" class="boton-acciones" id="btn-rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Liceo de Heredia</th>
                            <td>CPU</td>
                            <td>8</td>
                            <td>27/05/2024</td>
                            <td><span class="estado-pendiente">Pendiente</span></td>
                            <td>
                                <div class="acciones">
                                    <button title="Ver Más" class="boton-acciones" id="btn-ver-mas">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button title="Aceptar Donación" class="boton-acciones" id="btn-aceptar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button title="Rechazar Donación" class="boton-acciones" id="btn-rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">ONG Futuro Digital</th>
                            <td>Laptops</td>
                            <td>6</td>
                            <td>09/07/2024</td>
                            <td><span class="estado-aceptado">Aceptado</span></td>
                            <td>
                                <div class="acciones">
                                    <button title="Ver Más" class="boton-acciones" id="btn-ver-mas">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button title="Aceptar Donación" class="boton-acciones" id="btn-aceptar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button title="Rechazar Donación" class="boton-acciones" id="btn-rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Colegio de Puntarenas</th>
                            <td>Proyectores</td>
                            <td>3</td>
                            <td>21/08/2024</td>
                            <td><span class="estado-rechazado">Rechazado</span></td>
                            <td>
                                <div class="acciones">
                                    <button title="Ver Más" class="boton-acciones" id="btn-ver-mas">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button title="Aceptar Donación" class="boton-acciones" id="btn-aceptar">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button title="Rechazar Donación" class="boton-acciones" id="btn-rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>