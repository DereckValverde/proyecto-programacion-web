document.addEventListener('DOMContentLoaded', () => {

    //Acá va para cargar las tablas
    cargarTabla(`${BASE_URL}/solicitudes/apiList`);

    //Acá va para cargar los KPIs

    //Marcar botón en el navbar
    document.getElementById('linkSolicitudes').classList.add('active');
});

async function cargarTabla(url) {

    const solicitudesTbody = document.getElementById('solicitudesTbody');



    try {

        const response = await fetch(url);
        const solicitudes = await response.json();

        solicitudesTbody.innerHTML = '';

        if (solicitudes.length === 0) {
            tbody.innerHTML = '<tr><td colspan="11" class="text-center" text-muted>No hay solicitudes registradas</td></tr>';

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

                    <button title="Aceptar Donación" class="boton-acciones btn-aceptar">
                        <i class="bi bi-check-lg"></i>
                    </button>

                  <button title="Rechazar Donación" class="boton-acciones btn-rechazar">
                        <i class="bi bi-x"></i>
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