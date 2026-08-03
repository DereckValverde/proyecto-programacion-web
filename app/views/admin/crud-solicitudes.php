<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= BASE_URL . 'public/images/LOGO.png' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/css/style-crud-solicitudes.css' ?>">
    <title>Panel Administrativo - Solicitudes</title>
</head>

<body>

    <?php require_once LAYOUT_PATH . 'admin_navbar.php' ?>

    <main class="main">
        <div class="d-flex flex-column container-fluid px-4 gap-5">

            <div class="dashboard-head">
                <p>Panel Administrativo / <strong>Solicitudes</strong></p>
                <h2>Gestión de Solicitudes</h2>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow text-dark bg-white border border-1 border-dark-light rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title text-secondary  fw-bold fs-8 mb-0">Total de Solicitudes</p>
                            <i class="bi bi-inbox fs-5 text-secondary"></i>
                        </div>
                        <h3 class="card-value text-dark fs-5 fw-bold mt-4 mb-0" id="kpiTotal"></h3>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow border border-1 border-dark-light  rounded-4 p-3 solicitudes-pendientes">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title fw-bold fs-8 mb-0">Pendientes de Revisar</p>
                            <i class="bi bi-clipboard-check fs-5"></i>
                        </div>
                        <h3 class="card-value fs-5 fw-bold mt-4 mb-0" id="kpiPendientes"></h3>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow text-dark bg-white border border-1 border-dark-light rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title text-secondary fw-bold fs-8 mb-0"> Solicitudes Aceptadas</p>
                            <i class="bi bi-check-circle fs-5 text-secondary"></i>
                        </div>
                        <h3 class="card-value text-dark fs-5 fw-bold mt-4 mb-0" id="kpiAceptadas"></h3>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="d-flex flex-column dashboard-card shadow text-dark bg-white border border-1 border-dark-light rounded-4 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-title text-secondary fw-bold fs-8 mb-0">Solicitudes Rechazadas</p>
                            <i class="bi bi-x-circle fs-5 text-secondary"></i>
                        </div>
                        <h3 class="card-value text-dark fs-5 fw-bold mt-4 mb-0" id="kpiRechazadas"></h3>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-light rounded-pill boton-filtro boton-activo" id="btnTodas">Todas</button>
                <button class="btn btn-light border border-dark-light rounded-pill boton-filtro" id="btnPendientes">Pendientes</button>
                <button class="btn btn-light border border-dark-light rounded-pill boton-filtro" id="btnAceptadas">Aceptadas</button>
                <button class="btn btn-light border border-dark-light rounded-pill boton-filtro" id="btnRechazadas">Rechazadas</button>
            </div>

            <div class="table-responsive border border-dark-light border border-bottom-0 rounded-3">
                <table class="table text-center align-middle mb-0">
                    <thead class="table-light">
                        <tr class="align-middle">
                            <th>Solicitante</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Organización</th>
                            <th>Equipo</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="solicitudesTbody">

                    </tbody>
                </table>
            </div>
    </main>

    <!-- Modal para Ver Detalles de cada Solicitud -->
    <div class="modal-overlay" id="solicitudModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Titulo Modal</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>

            <div id="detallesSolicitud">
                <!-- Acá se cargan los detalles con js -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="<?= BASE_URL . '/public/js/admin/solicitudes.js' ?>">

    </script>
</body>

</html>