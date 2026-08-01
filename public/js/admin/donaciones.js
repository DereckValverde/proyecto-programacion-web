document.addEventListener('DOMContentLoaded', (e) => {
    cargarTabla(`${BASE_URL}donaciones/apiList`); // Carga todos los registros de donaciones en la tabla

    /*Cargar las KPIs*/
    cargarKpis();

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

                        <button title="Aceptar Donación" class="boton-acciones btn-aceptar">
                            <i class="bi bi-check-lg"></i>
                        </button>

                        <button title="Rechazar Donación" class="boton-acciones btn-rechazar">
                            <i class="bi bi-x"></i>
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

    // Total Donaciones
    const kpiTotalDonaciones = document.getElementById('kpiTotalDonaciones');

    const responseDonaciones = await fetch(`${BASE_URL}donaciones/apiList`);
    const donaciones = await responseDonaciones.json();

    kpiTotalDonaciones.textContent = donaciones.length;


    // Pendientes de Revisar
    const kpiPendientes = document.getElementById('kpiPendientes');

    const responsePendientes = await fetch(`${BASE_URL}donaciones/apiListEstado/Pendiente`);
    const donacionesPendientes = await responsePendientes.json();

    kpiPendientes.textContent = donacionesPendientes.length;

    //Donaciones Aceptadas
    const kpiAceptadas = document.getElementById('kpiAceptadas');
    
    const responseAceptadas = await fetch(`${BASE_URL}donaciones/apiListEstado/Aceptada`);
    const donacionesAceptadas = await responseAceptadas.json();

    kpiAceptadas.textContent = donacionesAceptadas.length;

    //Donaciones Rechazadas
    const kpiRechazadas = document.getElementById('kpiRechazadas');

    const responseRechazadas = await fetch(`${BASE_URL}donaciones/apiListEstado/Rechazada`);
    const donacionesRechazadas = await responseRechazadas.json();

    kpiRechazadas.textContent = donacionesRechazadas.length;
}