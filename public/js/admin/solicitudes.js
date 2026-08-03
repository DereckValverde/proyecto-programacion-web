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