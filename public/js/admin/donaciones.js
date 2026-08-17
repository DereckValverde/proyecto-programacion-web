function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    const div = document.createElement('div');
    div.textContent = String(text);
    return div.innerHTML;
}

let filtroActivo = 'todas';
let busquedaActual = '';
let debounceTimer = null;

document.addEventListener('DOMContentLoaded', (e) => {
    cargarTabla(`${BASE_URL}donaciones/apiList`);
    cargarKpis();

    document.getElementById('linkDonaciones').classList.add('active');

    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('donacionModal');

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

    document.getElementById('btnCompletadas').addEventListener('click', () => {
        filtroActivo = 'Completada';
        aplicarFiltroYBusqueda();
    });

    document.getElementById('busquedaDonaciones').addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            busquedaActual = e.target.value.trim();
            aplicarFiltroYBusqueda();
        }, 300);
    });
});

function aplicarFiltroYBusqueda() {
    if (busquedaActual !== '') {
        cargarTabla(`${BASE_URL}donaciones/apiBuscar?texto=${encodeURIComponent(busquedaActual)}`);
    } else if (filtroActivo === 'todas') {
        cargarTabla(`${BASE_URL}donaciones/apiList`);
    } else {
        cargarTabla(`${BASE_URL}donaciones/apiListEstado/${filtroActivo}`);
    }
}

async function cargarTabla(url) {
    const tbody = document.getElementById('donacionesTbody');

    try {
        const response = await fetch(url);
        const donaciones = await response.json();

        tbody.innerHTML = '';

        if (donaciones.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" class="text-center text-muted">No se encontraron resultados</td></tr>';
        } else {
            donaciones.forEach(donacion => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
                <td>${escapeHtml(donacion.nombreDonador)}</td>
                <td>${escapeHtml(donacion.tipoEquipo)}</td>
                <td>${escapeHtml(donacion.marca)}</td>
                <td>${escapeHtml(donacion.modelo)}</td>
                <td>
                    <span class="estado-equipo-${escapeHtml(donacion.estadoEquipo.toLowerCase())}">${escapeHtml(donacion.estadoEquipo)}</span>
                </td>
                <td>${escapeHtml(donacion.cantidadEquipos)}</td>
                <td>
                    <span class="estado-${escapeHtml(donacion.estado.toLowerCase())}">
                        ${escapeHtml(donacion.estado)}
                    </span>
                </td>
                <td>${escapeHtml(donacion.fechaRegistro.split(" ")[0])}</td>
                <td>
                    <div class="acciones">
                        <button title="Ver Más" class="boton-acciones btn-ver-mas" onclick="verMas(${donacion.idDonacion})">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <button title="Editar" class="boton-acciones btn-editar" onclick="editarDonacion(${donacion.idDonacion})">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button title="Eliminar" class="boton-acciones btn-eliminar" onclick="eliminarDonacion(${donacion.idDonacion})">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                </td>`;
                tbody.appendChild(tr);
            });
        }

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
    } else if (estado === 'Completada') {
        botonActivo = document.getElementById('btnCompletadas');
    }

    botonActivo.classList.add('boton-activo');
}

async function verMas(id) {
    const modal = document.getElementById('donacionModal');
    modal.classList.add('active');

    const tituloModal = document.getElementById('modalTitle');
    tituloModal.textContent = 'Detalle de Donación';

    const detallesDonacion = document.getElementById('detallesDonacion');
    detallesDonacion.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';

    try {
        const response = await fetch(`${BASE_URL}donaciones/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const data = result.data;

            detallesDonacion.innerHTML = `
            <div class="card shadow-sm border-0 w-100">
                <div class="card-header bg-light text-dark d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 py-3">
                    <h5 class="mb-0 text-break">Donación #${escapeHtml(data.idDonacion)}</h5>
                    <span class="estado-${escapeHtml(data.estado.toLowerCase())}">${escapeHtml(data.estado)}</span>
                </div>
                <div class="card-body px-3 px-md-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Información del Donador</h6>
                            <p class="mb-1 text-break"><strong>Nombre:</strong> ${escapeHtml(data.nombreDonador)}</p>
                            <p class="mb-1 text-break"><strong>Correo:</strong> ${escapeHtml(data.correoDonador)}</p>
                            <p class="mb-1 text-break"><strong>Teléfono:</strong> ${escapeHtml(data.telefonoDonador)}</p>
                        </div>

                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Detalles del Equipo</h6>
                            <p class="mb-1 text-break"><strong>Marca / Modelo:</strong> ${escapeHtml(data.marca)} ${escapeHtml(data.modelo)}</p>
                            <p class="mb-1"><strong>Cantidad:</strong> ${escapeHtml(data.cantidadEquipos)}</p>
                            <p class="mb-1"><strong>Estado del equipo:</strong> ${escapeHtml(data.estadoEquipo)}</p>
                        </div>

                        <div class="col-12 mt-3">
                            <h6 class="text-muted border-bottom pb-2">Información Adicional</h6>
                            <p class="mb-1 text-break"><strong>Descripción:</strong> ${escapeHtml(data.descripcionAdicional) || 'Sin descripción'}</p>
                            <p class="mb-1 text-break"><strong>Comentario Admin:</strong> ${escapeHtml(data.comentarioAdministrador) || 'Ninguno'}</p>
                        </div>

                        <div class="col-12 mt-3 text-muted small border-top pt-2 d-flex flex-column flex-sm-row justify-content-between gap-1">
                            <span>Registrado el: ${escapeHtml(data.fechaRegistro)}</span>
                            ${data.fechaRevision ? `<span>Revisado el: ${escapeHtml(data.fechaRevision)}</span>` : ''}
                        </div>
                    </div>
                </div>
                ${data.estado === 'Pendiente' ? `
                    <div class="card-footer bg-white border-0 mb-2 pb-0">
                        <div class="mb-3">
                            <label for="comentarioAdmin" class="form-label fw-semibold text-muted small mb-1">Comentario del administrador</label>
                            <textarea class="form-control" id="comentarioAdmin" rows="3" placeholder="Escriba una reseña, opinión o comentario sobre esta donación..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="boton-acciones btn-rechazar px-3 py-1" onclick="rechazarDonacion(${data.idDonacion})">
                                <i class="bi bi-x"></i> Rechazar
                            </button>
                            <button type="button" class="boton-acciones btn-aceptar px-3 py-1" onclick="aceptarDonacion(${data.idDonacion})">
                                <i class="bi bi-check-lg"></i> Aceptar
                            </button>
                        </div>
                    </div>` : ''}
                ${data.estado === 'Aceptada' ? `
                    <div class="card-footer bg-white border-0 mb-2 pb-0">
                        <div class="mb-3">
                            <label for="comentarioAdmin" class="form-label fw-semibold text-muted small mb-1">Comentario del administrador</label>
                            <textarea class="form-control" id="comentarioAdmin" rows="3" placeholder="Nota sobre la entrega o finalización de la donación..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="boton-acciones btn-aceptar px-3 py-1" onclick="completarDonacion(${data.idDonacion})">
                                <i class="bi bi-check2-circle"></i> Marcar como completada
                            </button>
                        </div>
                    </div>` : ''}
            </div>
        `;
        } else {
            detallesDonacion.innerHTML = `
            <div class="alert alert-warning m-3" role="alert">
                No se pudieron encontrar los detalles de esta donación.
            </div>
        `;
        }

    } catch (error) {
        console.error(error);
        detallesDonacion.innerHTML = `
        <div class="alert alert-danger m-3" role="alert">
            Hubo un error al conectar con el servidor.
        </div>
    `;
    }
}

async function cargarKpis() {
    const kpiTotalDonaciones = document.getElementById('kpiTotalDonaciones');
    const kpiPendientes = document.getElementById('kpiPendientes');
    const kpiAceptadas = document.getElementById('kpiAceptadas');
    const kpiRechazadas = document.getElementById('kpiRechazadas');

    try {
        const response = await fetch(`${BASE_URL}donaciones/apiKpis`);
        const kpis = await response.json();

        kpiTotalDonaciones.textContent = kpis.total;
        kpiPendientes.textContent = kpis.pendientes;
        kpiAceptadas.textContent = kpis.aceptadas;
        kpiRechazadas.textContent = kpis.rechazadas;
    } catch (error) {
        console.error(error);
    }
}

async function aceptarDonacion(id) {
    const comentario = document.getElementById('comentarioAdmin')?.value.trim() || null;

    Swal.fire({
        title: "¿Está Seguro?",
        text: "¿Desea aceptar esta donación?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, aceptar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}donaciones/aceptar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ comentario })
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Aceptada', resData.message, 'success');
                    document.getElementById('donacionModal').classList.remove('active');
                    activarBotonFiltro('Aceptada');
                    cargarTabla(`${BASE_URL}donaciones/apiListEstado/Aceptada`);
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al aceptar la donación', 'error');
            }
        }
    });
}

async function rechazarDonacion(id) {
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
                const response = await fetch(`${BASE_URL}donaciones/rechazar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ comentario })
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Eliminado', resData.message, 'success');
                    document.getElementById('donacionModal').classList.remove('active');
                    activarBotonFiltro('Rechazada');
                    cargarTabla(`${BASE_URL}donaciones/apiListEstado/Rechazada`);
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al rechazar la donación', 'error');
            }
        }
    });
}

async function eliminarDonacion(id) {
    Swal.fire({
        title: "¿Está Seguro?",
        text: "Esta donación se eliminará permanentemente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}donaciones/eliminar/${id}`, {
                    method: 'POST'
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Eliminada', resData.message, 'success');
                    cargarTabla(`${BASE_URL}donaciones/apiList`);
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al eliminar la donación', 'error');
            }
        }
    });
}

async function completarDonacion(id) {
    const comentario = document.getElementById('comentarioAdmin')?.value.trim() || null;

    Swal.fire({
        title: "¿Marcar como completada?",
        text: "La donación pasará al estado Completada.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, completar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}donaciones/completar/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ comentario })
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('Completada', resData.message, 'success');
                    document.getElementById('donacionModal').classList.remove('active');
                    cargarTabla(`${BASE_URL}donaciones/apiListEstado/Aceptada`);
                    cargarKpis();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error al completar la donación', 'error');
            }
        }
    });
}

function abrirModalCrearDonacion() {
    const modal = document.getElementById('donacionModal');
    const titulo = document.getElementById('modalTitle');
    const contenido = document.getElementById('detallesDonacion');

    titulo.textContent = 'Nueva Donación';
    contenido.innerHTML = `
    <form id="formCrearDonacion" class="admin-form" novalidate>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre completo *</label>
                <input type="text" class="form-control" name="nombreDonador" placeholder="Nombre del donador" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Correo electrónico *</label>
                <input type="email" class="form-control" name="correoDonador" placeholder="correo@ejemplo.com" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono *</label>
                <input type="tel" class="form-control" name="telefonoDonador" placeholder="8888-8888" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tipo de equipo *</label>
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
                <label class="form-label">Marca</label>
                <input type="text" class="form-control" name="marca" placeholder="Ej: Dell">
            </div>
            <div class="col-md-6">
                <label class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" placeholder="Ej: Latitude 5420">
            </div>
            <div class="col-md-6">
                <label class="form-label">Estado del equipo *</label>
                <select class="form-select" name="estadoEquipo" required>
                    <option value="" selected disabled>Seleccione</option>
                    <option>Nuevo</option>
                    <option>Bueno</option>
                    <option>Regular</option>
                    <option>Malo</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Cantidad *</label>
                <input type="number" class="form-control" name="cantidadEquipos" min="1" value="1" required>
            </div>
            <div class="col-12">
                <label class="form-label">Descripción adicional</label>
                <textarea class="form-control" name="descripcionAdicional" rows="3" placeholder="Detalles adicionales..."></textarea>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn-admin-cancelar" onclick="document.getElementById('donacionModal').classList.remove('active')">Cancelar</button>
            <button type="submit" class="btn-admin-guardar"><i class="bi bi-check-lg"></i> Guardar</button>
        </div>
    </form>`;

    document.getElementById('formCrearDonacion').addEventListener('submit', async (e) => {
        e.preventDefault();
        await guardarNuevaDonacion(e.target);
    });

    modal.classList.add('active');
}

async function guardarNuevaDonacion(form) {
    const fd = new FormData(form);
    const datos = Object.fromEntries(fd.entries());
    datos.cantidadEquipos = parseInt(datos.cantidadEquipos) || 1;

    try {
        const response = await fetch(`${BASE_URL}donaciones/crear`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        });
        const resData = await response.json();

        if (resData.success) {
            Swal.fire('Creada', resData.message, 'success');
            document.getElementById('donacionModal').classList.remove('active');
            cargarTabla(`${BASE_URL}donaciones/apiList`);
            cargarKpis();
        } else {
            Swal.fire('Error', resData.message, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Ocurrió un error al crear la donación', 'error');
    }
}

async function editarDonacion(id) {
    const modal = document.getElementById('donacionModal');
    const titulo = document.getElementById('modalTitle');
    const contenido = document.getElementById('detallesDonacion');

    titulo.textContent = 'Editar Donación';
    contenido.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';
    modal.classList.add('active');

    try {
        const response = await fetch(`${BASE_URL}donaciones/apiShow/${id}`);
        const result = await response.json();

        if (!result.success) {
            contenido.innerHTML = '<div class="alert alert-warning m-3">No se encontró la donación.</div>';
            return;
        }

        const d = result.data;
        const opcionesTipo = ['Laptop', 'Computadora de escritorio', 'Monitor', 'Teclado', 'Mouse', 'Tablet', 'Impresora', 'Otro'];
        const opcionesEstado = ['Nuevo', 'Bueno', 'Regular', 'Malo'];

        contenido.innerHTML = `
        <form id="formEditarDonacion" class="admin-form" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre completo *</label>
                    <input type="text" class="form-control" name="nombreDonador" value="${escapeHtml(d.nombreDonador)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Correo electrónico *</label>
                    <input type="email" class="form-control" name="correoDonador" value="${escapeHtml(d.correoDonador)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Teléfono *</label>
                    <input type="tel" class="form-control" name="telefonoDonador" value="${escapeHtml(d.telefonoDonador)}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipo de equipo *</label>
                    <select class="form-select" name="tipoEquipo" required>
                        ${opcionesTipo.map(t => `<option ${d.tipoEquipo === t ? 'selected' : ''}>${t}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Marca</label>
                    <input type="text" class="form-control" name="marca" value="${escapeHtml(d.marca || '')}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Modelo</label>
                    <input type="text" class="form-control" name="modelo" value="${escapeHtml(d.modelo || '')}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Estado del equipo *</label>
                    <select class="form-select" name="estadoEquipo" required>
                        ${opcionesEstado.map(e => `<option ${d.estadoEquipo === e ? 'selected' : ''}>${e}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cantidad *</label>
                    <input type="number" class="form-control" name="cantidadEquipos" min="1" value="${d.cantidadEquipos}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Descripción adicional</label>
                    <textarea class="form-control" name="descripcionAdicional" rows="3">${escapeHtml(d.descripcionAdicional || '')}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn-admin-cancelar" onclick="document.getElementById('donacionModal').classList.remove('active')">Cancelar</button>
                <button type="submit" class="btn-admin-guardar"><i class="bi bi-check-lg"></i> Guardar cambios</button>
            </div>
        </form>`;

        document.getElementById('formEditarDonacion').addEventListener('submit', async (e) => {
            e.preventDefault();
            await guardarEdicionDonacion(id, e.target);
        });

    } catch (error) {
        console.error(error);
        contenido.innerHTML = '<div class="alert alert-danger m-3">Error al conectar con el servidor.</div>';
    }
}

async function guardarEdicionDonacion(id, form) {
    const fd = new FormData(form);
    const datos = Object.fromEntries(fd.entries());
    datos.cantidadEquipos = parseInt(datos.cantidadEquipos) || 1;

    try {
        const response = await fetch(`${BASE_URL}donaciones/actualizar/${id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        });
        const resData = await response.json();

        if (resData.success) {
            Swal.fire('Actualizada', resData.message, 'success');
            document.getElementById('donacionModal').classList.remove('active');
            cargarTabla(`${BASE_URL}donaciones/apiList`);
            cargarKpis();
        } else {
            Swal.fire('Error', resData.message, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Ocurrió un error al actualizar la donación', 'error');
    }
}
