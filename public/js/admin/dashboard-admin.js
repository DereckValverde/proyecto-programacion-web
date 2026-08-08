document.addEventListener('DOMContentLoaded', () => {

    cargarKpis();
    cargarHistorialMensual();
    cargarTiposEquipos();
    cargarSolicitudesRecientes();
    cargarLogs();

    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('solicitudModal');

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });
});

async function cargarKpis() {

    const kpiSolicitudesPendientes = document.getElementById('kpiSolicitudesPendientes');
    const kpiDonacionesCompletadas = document.getElementById('kpiDonacionesCompletadas');
    const kpiCo2Evitado = document.getElementById('kpiCo2Evitado');

    try {

        const response = await fetch(`${BASE_URL}dashboard/apiKpis`);
        const kpis = await response.json();

        kpiSolicitudesPendientes.textContent = kpis.solicitudesPendientes;
        kpiDonacionesCompletadas.textContent = kpis.donacionesCompletadas;
        kpiCo2Evitado.textContent = `${Math.round(kpis.co2Evitado)} kg CO₂e`;

    } catch (error) {
        console.error(error);
    }
}

async function cargarHistorialMensual() {

    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

    try {

        const response = await fetch(`${BASE_URL}dashboard/apiHistorialMensual`);
        const historial = await response.json();

        const labels = historial.map(item => {
            const partes = item.mes.split('-');
            return meses[parseInt(partes[1], 10) - 1];
        });

        const datos = historial.map(item => item.total);

        const ctx = document.getElementById('lineChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Equipos Recibidos',
                    data: datos,
                    borderColor: '#0092a5',
                    tension: 0.3,
                    fill: true,
                    backgroundColor: 'rgba(6, 219, 247, 0.1)'
                }]
            }
        });

    } catch (error) {
        console.error(error);
    }
}

async function cargarTiposEquipos() {

    const colores = [
        'rgba(255, 99, 132, 0.7)',
        'rgba(255, 159, 64, 0.7)',
        'rgba(255, 205, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(255, 99, 71, 0.7)',
        'rgba(60, 179, 113, 0.7)',
        'rgba(255, 140, 0, 0.7)',
        'rgba(70, 130, 180, 0.7)'
    ];

    try {

        const response = await fetch(`${BASE_URL}dashboard/apiTiposEquipos`);
        const tipos = await response.json();

        const labels = tipos.map(item => item.tipoEquipo);
        const datos = tipos.map(item => item.total);

        const ctx = document.getElementById('chartArea').getContext('2d');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Equipos Donados',
                    data: datos,
                    backgroundColor: colores,
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: 'center'
                    }
                }
            }
        });

    } catch (error) {
        console.error(error);
    }
}

async function cargarSolicitudesRecientes() {

    const tbody = document.getElementById('solicitudesTbody');

    try {

        const response = await fetch(`${BASE_URL}dashboard/apiSolicitudesRecientes`);
        const solicitudes = await response.json();

        tbody.innerHTML = '';

        if (solicitudes.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No hay solicitudes registradas</td></tr>';
        } else {

            solicitudes.forEach(solicitud => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                <td>${solicitud.nombreSolicitante}</td>
                <td>${solicitud.cantidadEquipos} ${solicitud.tipoEquipo}</td>
                <td>${solicitud.fechaRegistro.split(" ")[0]}</td>
                <td>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <button type="button" class="btn btn-primary btn-sm rounded-2 flex-fill" onclick="verMas(${solicitud.idSolicitud})">Ver Más</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-2 flex-fill" onclick="rechazarSolicitud(${solicitud.idSolicitud})">Rechazar</button>
                    </div>
                </td>`;

                tbody.appendChild(tr);
            });
        }

    } catch (error) {
        console.error(error);
    }
}

async function verMas(id) {

    const modal = document.getElementById('solicitudModal');
    modal.classList.add('active');

    const tituloModal = document.getElementById('modalTitle');
    tituloModal.textContent = 'Detalle de Solicitud';

    const detallesSolicitud = document.getElementById('detallesSolicitud');
    detallesSolicitud.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';

    try {

        const response = await fetch(`${BASE_URL}solicitudes/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const data = result.data;

            detallesSolicitud.innerHTML = `
            <div class="card shadow-sm border-0 w-100">
                <div class="card-header bg-light text-dark d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 py-3">
                    <h5 class="mb-0 text-break">Solicitud #${data.idSolicitud}</h5>
                    <span class="estado-${data.estado.toLowerCase()}">${data.estado}</span>
                </div>
                <div class="card-body px-3 px-md-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Información del Solicitante</h6>
                            <p class="mb-1 text-break"><strong>Nombre:</strong> ${data.nombreSolicitante}</p>
                            <p class="mb-1 text-break"><strong>Correo:</strong> ${data.correoSolicitante}</p>
                            <p class="mb-1 text-break"><strong>Teléfono:</strong> ${data.telefonoSolicitante}</p>
                        </div>

                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Detalles de la Solicitud</h6>
                            <p class="mb-1 text-break"><strong>Organización:</strong> ${data.nombreOrganizacion}</p>
                            <p class="mb-1"><strong>Tipo de organización:</strong> ${data.tipoOrganizacion}</p>
                            <p class="mb-1"><strong>Equipo solicitado:</strong> ${data.tipoEquipo}</p>
                            <p class="mb-1"><strong>Cantidad:</strong> ${data.cantidadEquipos}</p>
                        </div>

                        <div class="col-12 mt-3">
                            <h6 class="text-muted border-bottom pb-2">Motivo de la Solicitud</h6>
                            <p class="mb-1 text-break">${data.motivoSolicitud}</p>
                        </div>

                        <div class="col-12 mt-3">
                            <h6 class="text-muted border-bottom pb-2">Comentario Admin</h6>
                            <p class="mb-1 text-break">${data.comentarioAdministrador || 'Ninguno'}</p>
                        </div>

                        <div class="col-12 mt-3 text-muted small border-top pt-2 d-flex flex-column flex-sm-row justify-content-between gap-1">
                            <span>Registrado el: ${data.fechaRegistro}</span>
                            ${data.fechaRevision ? `<span>Revisado el: ${data.fechaRevision}</span>` : ''}
                        </div>
                    </div>
                </div>
                ${data.estado === 'Pendiente' ? `
                    <div class="card-footer bg-white border-0 pb-0">
                        <div class="mb-3">
                            <label for="comentarioAdmin" class="form-label fw-semibold text-muted small mb-1">Comentario del administrador</label>
                            <textarea class="form-control" id="comentarioAdmin" rows="3" placeholder="Escriba una reseña, opinión o comentario sobre esta solicitud..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="boton-acciones btn-rechazar px-3 py-1" onclick="rechazarSolicitud(${data.idSolicitud})">
                                <i class="bi bi-x"></i> Rechazar
                            </button>
                            <button type="button" class="boton-acciones btn-aceptar px-3 py-1" onclick="aceptarSolicitud(${data.idSolicitud})">
                                <i class="bi bi-check-lg"></i> Aceptar
                            </button>
                        </div>
                    </div>` : ''}
            </div>
        `;
        } else {
            detallesSolicitud.innerHTML = `
            <div class="alert alert-warning m-3" role="alert">
                No se pudieron encontrar los detalles de esta solicitud.
            </div>
        `;
        }

    } catch (error) {
        console.error(error);
        detallesSolicitud.innerHTML = `
        <div class="alert alert-danger m-3" role="alert">
            Hubo un error al conectar con el servidor.
        </div>
    `;
    }
}

async function aceptarSolicitud(id) {

    const comentario = document.getElementById('comentarioAdmin')?.value.trim() || null;

    Swal.fire({
        title: "¿Está Seguro?",
        text: "¿Desea aceptar esta solicitud?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, aceptar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}solicitudes/aceptar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ comentario })
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Aceptada', resData.message, 'success');
                    document.getElementById('solicitudModal').classList.remove('active');
                    cargarSolicitudesRecientes();
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al aceptar la solicitud', 'error');
            }
        }
    });
}

async function rechazarSolicitud(id) {

    const comentario = document.getElementById('comentarioAdmin')?.value.trim() || null;

    Swal.fire({
        title: "¿Está Seguro?",
        text: "¡No podrá revertir esta acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, rechazar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}solicitudes/rechazar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ comentario })
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Rechazada', resData.message, 'success');
                    document.getElementById('solicitudModal').classList.remove('active');
                    cargarSolicitudesRecientes();
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al rechazar la solicitud', 'error');
            }
        }
    });
}

async function cargarLogs() {

    const logsContainer = document.getElementById('logsContainer');

    try {

        const response = await fetch(`${BASE_URL}dashboard/apiLogs`);
        const logs = await response.json();

        logsContainer.innerHTML = '';

        if (logs.length === 0) {
            logsContainer.innerHTML = '<div class="list-group-item px-0 py-3 border-0 text-muted">No hay logs registrados</div>';
        } else {

            logs.forEach(log => {

                const item = document.createElement('div');
                item.className = 'list-group-item px-0 py-3 border-0 border-bottom';

                const badge = document.createElement('span');
                badge.className = 'badge rounded-pill px-2 py-1 small';

                if (log.tipo === 'Registro') {
                    badge.classList.add('bg-success-subtle', 'text-success', 'border', 'border-success-subtle');
                    badge.textContent = 'Registro';
                } else if (log.tipo === 'Modificacion') {
                    badge.classList.add('bg-warning-subtle', 'text-warning-emphasis', 'border', 'border-warning-subtle');
                    badge.textContent = 'Modificación';
                } else if (log.tipo === 'Eliminacion') {
                    badge.classList.add('bg-danger-subtle', 'text-danger', 'border', 'border-danger-subtle');
                    badge.textContent = 'Eliminación';
                } else if (log.tipo === 'InicioSesion') {
                    badge.classList.add('bg-info-subtle', 'text-info-emphasis', 'border', 'border-info-subtle');
                    badge.textContent = 'Inicio de Sesión';
                } else {
                    badge.classList.add('bg-danger-subtle', 'text-danger', 'border', 'border-danger-subtle');
                    badge.textContent = 'Error';
                }

                const header = document.createElement('div');
                header.className = 'd-flex w-100 justify-content-between align-items-center mb-1';
                header.appendChild(badge);
                header.appendChild(tiempoRelativo(log.fecha));

                const descripcion = document.createElement('p');
                descripcion.className = 'mb-1 text-secondary small fw-medium';
                descripcion.textContent = log.descripcion;

                item.appendChild(header);
                item.appendChild(descripcion);

                logsContainer.appendChild(item);
            });
        }

    } catch (error) {
        console.error(error);
    }
}

function tiempoRelativo(fecha) {

    const ahora = new Date();
    const fechaLog = new Date(fecha);
    const segundos = Math.floor((ahora - fechaLog) / 1000);

    let texto = '';

    if (segundos < 60) {
        texto = 'Hace un momento';
    } else if (segundos < 3600) {
        texto = `Hace ${Math.floor(segundos / 60)} min`;
    } else if (segundos < 86400) {
        texto = `Hace ${Math.floor(segundos / 3600)} hora(s)`;
    } else {
        texto = `Hace ${Math.floor(segundos / 86400)} día(s)`;
    }

    const small = document.createElement('small');
    small.className = 'text-muted fw-semibold';
    small.textContent = texto;

    return small;
}
