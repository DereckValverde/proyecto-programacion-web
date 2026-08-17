function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    const div = document.createElement('div');
    div.textContent = String(text);
    return div.innerHTML;
}

let filtroActivo = 'todas';
let busquedaActual = '';
let debounceTimer = null;

document.addEventListener('DOMContentLoaded', () => {
    cargarTabla(`${BASE_URL}solicitudes/apiList`);
    cargarKpis();

    document.getElementById('linkSolicitudes').classList.add('active');

    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('solicitudModal');

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });

    const botones = document.querySelectorAll('.boton-filtro');
    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            botones.forEach(b => b.classList.remove('boton-activo'));
            boton.classList.add('boton-activo');
        });
    });

    document.getElementById('btnTodas').addEventListener('click', () => {
        filtroActivo = 'todas';
        aplicarFiltroYBusqueda();
    });

    document.getElementById('btnPendientes').addEventListener('click', () => {
        filtroActivo = 'Pendiente';
        aplicarFiltroYBusqueda();
    });

    document.getElementById('btnAceptadas').addEventListener('click', () => {
        filtroActivo = 'Aceptada';
        aplicarFiltroYBusqueda();
    });

    document.getElementById('btnRechazadas').addEventListener('click', () => {
        filtroActivo = 'Rechazada';
        aplicarFiltroYBusqueda();
    });

    document.getElementById('busquedaSolicitudes').addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            busquedaActual = e.target.value.trim();
            aplicarFiltroYBusqueda();
        }, 300);
    });
});

function aplicarFiltroYBusqueda() {
    if (busquedaActual !== '') {
        cargarTabla(`${BASE_URL}solicitudes/apiBuscar?texto=${encodeURIComponent(busquedaActual)}`);
    } else if (filtroActivo === 'todas') {
        cargarTabla(`${BASE_URL}solicitudes/apiList`);
    } else {
        cargarTabla(`${BASE_URL}solicitudes/apiListEstado/${filtroActivo}`);
    }
}

async function cargarTabla(url) {
    const solicitudesTbody = document.getElementById('solicitudesTbody');

    try {
        const response = await fetch(url);
        const solicitudes = await response.json();

        solicitudesTbody.innerHTML = '';

        if (solicitudes.length === 0) {
            solicitudesTbody.innerHTML = '<tr><td colspan="9" class="text-center text-muted">No se encontraron resultados</td></tr>';
        } else {
            solicitudes.forEach(solicitud => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
            <td>${escapeHtml(solicitud.nombreSolicitante)}</td>
            <td>${escapeHtml(solicitud.correoSolicitante)}</td>
            <td>${escapeHtml(solicitud.telefonoSolicitante)}</td>
            <td>${escapeHtml(solicitud.nombreOrganizacion)}</td>
            <td>${escapeHtml(solicitud.tipoEquipo)}</td>
            <td>${escapeHtml(solicitud.cantidadEquipos)}</td>
            <td>
                <span class="estado-${escapeHtml(solicitud.estado.toLowerCase())}">
                    ${escapeHtml(solicitud.estado)}
                </span>
            </td>
            <td>${escapeHtml(solicitud.fechaRegistro.split(" ")[0])}</td>
            <td>
                <div class="acciones">
                    <button title="Ver Más" class="boton-acciones btn-ver-mas" onclick="verMas(${solicitud.idSolicitud})">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    <button title="Editar" class="boton-acciones btn-editar" onclick="editarSolicitud(${solicitud.idSolicitud})">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <button title="Eliminar" class="boton-acciones btn-eliminar" onclick="eliminarSolicitud(${solicitud.idSolicitud})">
                        <i class="bi bi-trash-fill"></i>
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
    const kpiTotal = document.getElementById('kpiTotal');
    const kpiPendientes = document.getElementById('kpiPendientes');
    const kpiAceptadas = document.getElementById('kpiAceptadas');
    const kpiRechazadas = document.getElementById('kpiRechazadas');

    try {
        const response = await fetch(`${BASE_URL}solicitudes/apiKpis`);
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
                    <h5 class="mb-0 text-break">Solicitud #${escapeHtml(data.idSolicitud)}</h5>
                    <span class="estado-${escapeHtml(data.estado.toLowerCase())}">${escapeHtml(data.estado)}</span>
                </div>
                <div class="card-body px-3 px-md-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Información del Solicitante</h6>
                            <p class="mb-1 text-break"><strong>Nombre:</strong> ${escapeHtml(data.nombreSolicitante)}</p>
                            <p class="mb-1 text-break"><strong>Correo:</strong> ${escapeHtml(data.correoSolicitante)}</p>
                            <p class="mb-1 text-break"><strong>Teléfono:</strong> ${escapeHtml(data.telefonoSolicitante)}</p>
                        </div>

                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Detalles de la Solicitud</h6>
                            <p class="mb-1 text-break"><strong>Organización:</strong> ${escapeHtml(data.nombreOrganizacion)}</p>
                            <p class="mb-1"><strong>Tipo de organización:</strong> ${escapeHtml(data.tipoOrganizacion)}</p>
                            <p class="mb-1"><strong>Equipo solicitado:</strong> ${escapeHtml(data.tipoEquipo)}</p>
                            <p class="mb-1"><strong>Cantidad:</strong> ${escapeHtml(data.cantidadEquipos)}</p>
                        </div>

                        <div class="col-12 mt-3">
                            <h6 class="text-muted border-bottom pb-2">Motivo de la Solicitud</h6>
                            <p class="mb-1 text-break">${escapeHtml(data.motivoSolicitud)}</p>
                        </div>

                        <div class="col-12 mt-3">
                            <h6 class="text-muted border-bottom pb-2">Comentario Admin</h6>
                            <p class="mb-1 text-break">${escapeHtml(data.comentarioAdministrador) || 'Ninguno'}</p>
                        </div>

                        <div class="col-12 mt-3 text-muted small border-top pt-2 d-flex flex-column flex-sm-row justify-content-between gap-1">
                            <span>Registrado el: ${escapeHtml(data.fechaRegistro)}</span>
                            ${data.fechaRevision ? `<span>Revisado el: ${escapeHtml(data.fechaRevision)}</span>` : ''}
                        </div>
                    </div>
                </div>
                ${data.estado === 'Pendiente' ? `
                    <div class="card-footer bg-white mb-2 border-0 pb-0">
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

async function eliminarSolicitud(id) {
    Swal.fire({
        title: "¿Está Seguro?",
        text: "Esta solicitud se eliminará permanentemente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}solicitudes/eliminar/${id}`, {
                    method: 'POST'
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Eliminada', resData.message, 'success');
                    cargarTabla(`${BASE_URL}solicitudes/apiList`);
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al eliminar la solicitud', 'error');
            }
        }
    });
}

function abrirModalCrearSolicitud() {
    const modal = document.getElementById('solicitudModal');
    const titulo = document.getElementById('modalTitle');
    const contenido = document.getElementById('detallesSolicitud');

    titulo.textContent = 'Nueva Solicitud';
    contenido.innerHTML = `
    <form id="formCrearSolicitud" class="admin-form" novalidate>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del solicitante *</label>
                <input type="text" class="form-control" name="nombreSolicitante" placeholder="Nombre completo" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Correo electrónico *</label>
                <input type="email" class="form-control" name="correoSolicitante" placeholder="correo@ejemplo.com" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono *</label>
                <input type="tel" class="form-control" name="telefonoSolicitante" placeholder="8888-8888" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nombre de la organización *</label>
                <input type="text" class="form-control" name="nombreOrganizacion" placeholder="Nombre de la organización" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tipo de organización *</label>
                <select class="form-select" name="tipoOrganizacion" required>
                    <option value="" selected disabled>Seleccione</option>
                    <option>Escuela</option>
                    <option>Colegio</option>
                    <option>Universidad</option>
                    <option>Fundación</option>
                    <option>Asociación</option>
                    <option>Comunidad</option>
                    <option>Emprendimiento</option>
                    <option>Otra</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Equipo solicitado *</label>
                <select class="form-select" name="tipoEquipo" required>
                    <option value="" selected disabled>Seleccione</option>
                    <option>Laptop</option>
                    <option>Computadora de escritorio</option>
                    <option>Monitor</option>
                    <option>Teclado</option>
                    <option>Mouse</option>
                    <option>Tablet</option>
                    <option>Impresora</option>
                    <option>Otro</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Cantidad *</label>
                <input type="number" class="form-control" name="cantidadEquipos" min="1" value="1" required>
            </div>
            <div class="col-12">
                <label class="form-label">Motivo de la solicitud *</label>
                <textarea class="form-control" name="motivoSolicitud" rows="3" placeholder="Explique para qué se utilizarán los equipos..." required></textarea>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn-admin-cancelar" onclick="document.getElementById('solicitudModal').classList.remove('active')">Cancelar</button>
            <button type="submit" class="btn-admin-guardar"><i class="bi bi-check-lg"></i> Guardar</button>
        </div>
    </form>`;

    document.getElementById('formCrearSolicitud').addEventListener('submit', async (e) => {
        e.preventDefault();
        await guardarNuevaSolicitud(e.target);
    });

    modal.classList.add('active');
}

async function guardarNuevaSolicitud(form) {
    const fd = new FormData(form);
    const datos = Object.fromEntries(fd.entries());
    datos.cantidadEquipos = parseInt(datos.cantidadEquipos) || 1;

    try {
        const response = await fetch(`${BASE_URL}solicitudes/crear`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        });
        const resData = await response.json();

        if (resData.success) {
            Swal.fire('Creada', resData.message, 'success');
            document.getElementById('solicitudModal').classList.remove('active');
            cargarTabla(`${BASE_URL}solicitudes/apiList`);
            cargarKpis();
        } else {
            Swal.fire('Error', resData.message, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Ocurrió un error al crear la solicitud', 'error');
    }
}

async function editarSolicitud(id) {
    const modal = document.getElementById('solicitudModal');
    const titulo = document.getElementById('modalTitle');
    const contenido = document.getElementById('detallesSolicitud');

    titulo.textContent = 'Editar Solicitud';
    contenido.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';
    modal.classList.add('active');

    try {
        const response = await fetch(`${BASE_URL}solicitudes/apiShow/${id}`);
        const result = await response.json();

        if (!result.success) {
            contenido.innerHTML = '<div class="alert alert-warning m-3">No se encontró la solicitud.</div>';
            return;
        }

        const d = result.data;
        const opcionesEquipo = ['Laptop', 'Computadora de escritorio', 'Monitor', 'Teclado', 'Mouse', 'Tablet', 'Impresora', 'Otro'];
        const opcionesOrg = ['Escuela', 'Colegio', 'Universidad', 'Fundación', 'Asociación', 'Comunidad', 'Emprendimiento', 'Otra'];

        contenido.innerHTML = `
        <form id="formEditarSolicitud" class="admin-form" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre del solicitante *</label>
                    <input type="text" class="form-control" name="nombreSolicitante" value="${escapeHtml(d.nombreSolicitante)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Correo electrónico *</label>
                    <input type="email" class="form-control" name="correoSolicitante" value="${escapeHtml(d.correoSolicitante)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Teléfono *</label>
                    <input type="tel" class="form-control" name="telefonoSolicitante" value="${escapeHtml(d.telefonoSolicitante)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nombre de la organización *</label>
                    <input type="text" class="form-control" name="nombreOrganizacion" value="${escapeHtml(d.nombreOrganizacion)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipo de organización *</label>
                    <select class="form-select" name="tipoOrganizacion" required>
                        ${opcionesOrg.map(o => `<option ${d.tipoOrganizacion === o ? 'selected' : ''}>${o}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Equipo solicitado *</label>
                    <select class="form-select" name="tipoEquipo" required>
                        ${opcionesEquipo.map(e => `<option ${d.tipoEquipo === e ? 'selected' : ''}>${e}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cantidad *</label>
                    <input type="number" class="form-control" name="cantidadEquipos" min="1" value="${d.cantidadEquipos}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Motivo de la solicitud *</label>
                    <textarea class="form-control" name="motivoSolicitud" rows="3" required>${escapeHtml(d.motivoSolicitud)}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn-admin-cancelar" onclick="document.getElementById('solicitudModal').classList.remove('active')">Cancelar</button>
                <button type="submit" class="btn-admin-guardar"><i class="bi bi-check-lg"></i> Guardar cambios</button>
            </div>
        </form>`;

        document.getElementById('formEditarSolicitud').addEventListener('submit', async (e) => {
            e.preventDefault();
            await guardarEdicionSolicitud(id, e.target);
        });

    } catch (error) {
        console.error(error);
        contenido.innerHTML = '<div class="alert alert-danger m-3">Error al conectar con el servidor.</div>';
    }
}

async function guardarEdicionSolicitud(id, form) {
    const fd = new FormData(form);
    const datos = Object.fromEntries(fd.entries());
    datos.cantidadEquipos = parseInt(datos.cantidadEquipos) || 1;

    try {
        const response = await fetch(`${BASE_URL}solicitudes/actualizar/${id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        });
        const resData = await response.json();

        if (resData.success) {
            Swal.fire('Actualizada', resData.message, 'success');
            document.getElementById('solicitudModal').classList.remove('active');
            cargarTabla(`${BASE_URL}solicitudes/apiList`);
            cargarKpis();
        } else {
            Swal.fire('Error', resData.message, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Ocurrió un error al actualizar la solicitud', 'error');
    }
}
