document.addEventListener('DOMContentLoaded', () => {

    //Carga inicial de la tabla
    cargarTabla(`${BASE_URL}/solicitudes/apiList`);

    //Botones de filtro para la tabla
    const btnTodas = document.getElementById('btnTodas');
    const btnPendientes = document.getElementById('btnPendientes');
    const btnAceptadas = document.getElementById('btnAceptadas');
    const btnRechazadas = document.getElementById('btnRechazadas');

    //constante para quitar el active de los botones y ponerselo al que se le haga click
    const botones = document.querySelectorAll('.boton-filtro');

    botones.forEach(boton => {
        boton.addEventListener('click', () => {

            botones.forEach(b => b.classList.remove('boton-activo'));

            boton.classList.add('boton-activo');

        });
    });

    //listener de los botones de filtro
    btnTodas.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}/solicitudes/apiList`);
    });

    btnPendientes.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}/solicitudes/apiListEstado/Pendiente`);
    });

    btnAceptadas.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}/solicitudes/apiListEstado/Aceptada`);
    });

    btnRechazadas.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}/solicitudes/apiListEstado/Rechazada`);
    });




    //Acá va para cargar los KPIs
    cargarKpis();

    //Marcar botón en el navbar
    document.getElementById('linkSolicitudes').classList.add('active');

    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('solicitudModal');

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });
});

async function cargarTabla(url) {

    const solicitudesTbody = document.getElementById('solicitudesTbody');



    try {

        const response = await fetch(url);
        const solicitudes = await response.json();

        solicitudesTbody.innerHTML = '';

        if (solicitudes.length === 0) {
            solicitudesTbody.innerHTML = '<tr><td colspan="11" class="text-center" text-muted>No hay solicitudes registradas</td></tr>';

        } else {

            solicitudes.forEach(solicitud => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
            <td>${solicitud.nombreSolicitante}</td>
            <td>${solicitud.correoSolicitante}</td>
            <td>${solicitud.telefonoSolicitante}</td>
            <td>${solicitud.nombreOrganizacion}</td>
            <td>${solicitud.tipoEquipo}</td>
            <td>${solicitud.cantidadEquipos}</td>
            <td>
                <span class="estado-${solicitud.estado.toLowerCase()}">
                    ${solicitud.estado}
                </span>
            </td>
            <td>${(solicitud.fechaRegistro.split(" ")[0])}</td>
            <td>
                <div class="acciones">
                    <button title="Ver Más" class="boton-acciones btn-ver-mas" onclick= "verMas(${solicitud.idSolicitud})">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </td>`;
                solicitudesTbody.appendChild(tr);

            });
        }

    } catch (error) {
        console.error(error);
    }

}

async function cargarKpis() {

    //Constantes de los Kpis
    const kpiTotal = document.getElementById('kpiTotal');
    const kpiPendientes = document.getElementById('kpiPendientes');
    const kpiAceptadas = document.getElementById('kpiAceptadas');
    const kpiRechazadas = document.getElementById('kpiRechazadas');


    try {

        const response = await fetch(`${BASE_URL}/solicitudes/apiKpis`);
        const kpis = await response.json();

        kpiTotal.textContent = kpis.total;
        kpiPendientes.textContent = kpis.pendientes;
        kpiAceptadas.textContent = kpis.aceptadas;
        kpiRechazadas.textContent = kpis.rechazadas;



    } catch (error) {
        console.error(error);
    }
}

function activarBotonFiltro(estado) {
    const botones = document.querySelectorAll('.boton-filtro');
    botones.forEach(b => b.classList.remove('boton-activo'));

    let botonActivo = document.getElementById('btnTodas');

    if (estado === 'Pendiente') {
        botonActivo = document.getElementById('btnPendientes');
    } else if (estado === 'Aceptada') {
        botonActivo = document.getElementById('btnAceptadas');
    } else if (estado === 'Rechazada') {
        botonActivo = document.getElementById('btnRechazadas');
    }

    botonActivo.classList.add('boton-activo');
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
                    activarBotonFiltro('Aceptada');
                    cargarTabla(`${BASE_URL}solicitudes/apiListEstado/Aceptada`);
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
                    activarBotonFiltro('Rechazada');
                    cargarTabla(`${BASE_URL}solicitudes/apiListEstado/Rechazada`);
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