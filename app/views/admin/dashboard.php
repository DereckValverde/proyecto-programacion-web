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
    <link rel="icon" type="image/png" href= <?= BASE_URL . '/public/images/LOGO.png' ?>>
    <link rel="stylesheet" href=<?=BASE_URL . '/public/css/style-admin-dashboard.css'?>>
</head>

<body>

    <?php require_once LAYOUT_PATH . 'admin_navbar.php' ?>

    <main class="main">
        <div class="d-flex flex-column container-fluid px-4 gap-3">

            <div class="py-4">
                <p>Panel Administrativo / <strong>Dashboard</strong></p>
                <h2 class="dashboard-title">Panel Administrativo</h2>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-4">
                    <div class="dashboard-card bg-white text-dark p-4 rounded-3 shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-5 mb-0">Solicitudes Pendientes</p>
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold mt-4 mb-0" id="kpiSolicitudesPendientes">0</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card bg-white text-dark p-4 rounded-3 shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-5 mb-0">Donaciones Completadas</p>
                            <i class="bi bi-check-circle fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold mt-4 mb-0" id="kpiDonacionesCompletadas">0</h3>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="dashboard-card bg-white text-dark p-4 rounded-3 shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <p class="card-title fw-bold fs-5">CO₂ Evitado</p>
                            <i class="bi bi-tree fs-5"></i>
                        </div>
                        <h3 class="card-value fw-bold fs-4 mt-4 mb-0" id="kpiCo2Evitado">0 kg CO₂e</h3>
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
                            <h5 class="fw-bold mb-0">Solicitudes Recientes</h5>
                            <a href="<?= BASE_URL . 'auth/solicitudes' ?>" class="btn btn-outline-info btn-sm py-1 px-4">Ver Todas</a>
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
                                <tbody id="solicitudesTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex flex-column">
                    <div class="white-panel bg-white text-dark p-4 rounded-3 shadow-sm h-100">
                        <h5 class="fw-bold mb-4">Últimos Logs (Auditoría)</h5>
                        <div class="list-group list-group-flush class-logs-container" id="logsContainer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="solicitudModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Titulo Modal</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>

            <div id="detallesSolicitud">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src=<?= BASE_URL . '/public/js/admin/dashboard-admin.js' ?>></script>
</body>

</html>