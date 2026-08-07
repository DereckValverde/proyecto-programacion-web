document.addEventListener('DOMContentLoaded', (e) => {
    cargarTabla(`${BASE_URL}donaciones/apiList`); // Carga todos los registros de donaciones en la tabla

    /*Llama a un endpoint que trae todas las KPIs y las caga*/
    cargarKpis();

    //Se marca el botón en en navbar
    document.getElementById('linkDonaciones').classList.add('active');

    /*Listener para cerrar el modal */
    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('donacionModal');

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    })

    /*Listener de los botones de filtro para cambiar color */
    const botones = document.querySelectorAll(".boton-filtro");

    botones.forEach(boton => {
        boton.addEventListener("click", () => {

            // Quitar la clase al botón que la tenga
            botones.forEach(b => b.classList.remove("boton-activo"));

            // Agregarla al botón presionado
            boton.classList.add("boton-activo");
        });
    });

    //Botones de filtro
    btnTodas = document.getElementById('btnTodas');
    btnPendientes = document.getElementById('btnPendientes');
    btnAceptadas = document.getElementById('btnAceptadas');
    btnRechazadas = document.getElementById('btnRechazadas');

    btnTodas.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}donaciones/apiList`);
    });

    btnPendientes.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}donaciones/apiListEstado/Pendiente`);
    })

    btnAceptadas.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}donaciones/apiListEstado/Aceptada`);
    })

    btnRechazadas.addEventListener('click', () => {
        cargarTabla(`${BASE_URL}donaciones/apiListEstado/Rechazada`);
    })


});

/*Función que carga la tabla dependiento
 del filtro que se le pase por URL */
async function cargarTabla(url) {
    const tbody = document.getElementById('donacionesTbody');


    try {

        const response = await fetch(url);
        const donaciones = await response.json();

        tbody.innerHTML = '';

        if (donaciones.length === 0) {
            tbody.innerHTML = '<tr><td colspan="11" class="text-center" text-muted>No hay donaciones registradas</td></tr>';

        } else {
            donaciones.forEach(donacion => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
                <td>${donacion.nombreDonador}</td>
                <td>${donacion.tipoEquipo}</td>
                <td>${donacion.marca}</td>
                <td>${donacion.modelo}</td>
                <td>
                    <span class="estado-equipo-${donacion.estadoEquipo.toLowerCase()}">${donacion.estadoEquipo}</span>
                    
                </td>
                <td>${donacion.cantidadEquipos}</td>
                <td>
                    <span class="estado-${donacion.estado.toLowerCase()}">
                        ${donacion.estado}
                    </span>
                </td>
                <td>${donacion.fechaRegistro.split(" ")[0]}</td>
                <td>
                    <div class="acciones">
                        <button title="Ver Más" class="boton-acciones btn-ver-mas" onclick= "verMas(${donacion.idDonacion})">
                            <i class="bi bi-eye-fill"></i>
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
    }

    botonActivo.classList.add('boton-activo');
}

/*Función que abre el modal y muestra 
los detalles de cada donación */
async function verMas(id) {

    // Abrir el modal
    const modal = document.getElementById('donacionModal');
    modal.classList.add('active');

    // Titulo del modal
    const tituloModal = document.getElementById('modalTitle');
    tituloModal.textContent = 'Detalle de Donación';

    // Contenido donde van a ir los detalles (ponemos un loader inicial opcional)
    const detallesDonacion = document.getElementById('detallesDonacion');
    detallesDonacion.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';

    try {
        // Hacer llamada a la api buscando por id
        const response = await fetch(`${BASE_URL}donaciones/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const data = result.data;

            // Detalles de la donación insertados en el HTML:
            detallesDonacion.innerHTML = `
            <div class="card shadow-sm border-0 w-100">
                <div class="card-header bg-light text-dark d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 py-3">
                    <h5 class="mb-0 text-break">Donación #${data.idDonacion}</h5>
                    <span class="estado-${data.estado.toLowerCase()}">${data.estado}</span>
                </div>
                <div class="card-body px-3 px-md-4">
                    <div class="row g-3">
                        <!-- Información del Donador -->
                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Información del Donador</h6>
                            <p class="mb-1 text-break"><strong>Nombre:</strong> ${data.nombreDonador}</p>
                            <p class="mb-1 text-break"><strong>Correo:</strong> ${data.correoDonador}</p>
                            <p class="mb-1 text-break"><strong>Teléfono:</strong> ${data.telefonoDonador}</p>
                        </div>

                        <!-- Detalles del Equipo -->
                        <div class="col-12 col-md-6">
                            <h6 class="text-muted border-bottom pb-2">Detalles del Equipo</h6>
                            <p class="mb-1 text-break"><strong>Marca / Modelo:</strong> ${data.marca} ${data.modelo}</p>
                            <p class="mb-1"><strong>Cantidad:</strong> ${data.cantidadEquipos}</p>
                            <p class="mb-1"><strong>Estado del equipo:</strong> ${data.estadoEquipo}</p>
                        </div>

                        <!-- Información Adicional -->
                        <div class="col-12 mt-3">
                            <h6 class="text-muted border-bottom pb-2">Información Adicional</h6>
                            <p class="mb-1 text-break"><strong>Descripción:</strong> ${data.descripcionAdicional || 'Sin descripción'}</p>
                            <p class="mb-1 text-break"><strong>Comentario Admin:</strong> ${data.comentarioAdministrador || 'Ninguno'}</p>
                        </div>

                        <!-- Fechas -->
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
                            <textarea class="form-control" id="comentarioAdmin" rows="3" placeholder="Escriba una reseña, opinión o comentario sobre esta donación..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="boton-acciones btn-rechazar px-3 py-1" onclick="rechazarSolicitud(${data.idDonacion})">
                                <i class="bi bi-x"></i> Rechazar
                            </button>
                            <button type="button" class="boton-acciones btn-aceptar px-3 py-1" onclick="aceptarDonacion(${data.idDonacion})">
                                <i class="bi bi-check-lg"></i> Aceptar
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

        const response = await fetch(`${BASE_URL}/donaciones/apiKpis`);
        const kpis = await response.json();

        console.log(`Respuesta de la carga de KPIs: ${response.ok}`);

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

async function rechazarSolicitud(id) {

    const comentario = document.getElementById('comentarioAdmin')?.value.trim() || null;

    //Validación a nivel de front para confirmar el rechazo de la solicitud (SweetAlert)
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

                console.log(resData);

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