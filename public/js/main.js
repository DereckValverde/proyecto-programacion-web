function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    const div = document.createElement('div');
    div.textContent = String(text);
    return div.innerHTML;
}

function mostrarError(campoId, mensaje) {
    const errorEl = document.getElementById('error-' + campoId);
    const campo = document.getElementById(campoId) || document.querySelector('[name="' + campoId + '"]');
    if (errorEl) {
        errorEl.textContent = mensaje;
        errorEl.classList.add('visible');
    }
    if (campo) {
        campo.classList.add('is-invalid');
        campo.classList.remove('is-valid');
    }
}

function limpiarError(campoId) {
    const errorEl = document.getElementById('error-' + campoId);
    const campo = document.getElementById(campoId) || document.querySelector('[name="' + campoId + '"]');
    if (errorEl) {
        errorEl.textContent = '';
        errorEl.classList.remove('visible');
    }
    if (campo) {
        campo.classList.remove('is-invalid');
    }
}

function limpiarTodosLosErrores(form) {
    form.querySelectorAll('.field-error').forEach(function (el) {
        el.textContent = '';
        el.classList.remove('visible');
    });
    form.querySelectorAll('.is-invalid').forEach(function (el) {
        el.classList.remove('is-invalid');
    });
}

function validarCampoRequerido(campoId, nombreVisible) {
    const campo = document.getElementById(campoId) || document.querySelector('[name="' + campoId + '"]');
    if (!campo) return true;
    const valor = campo.value.trim();
    if (valor === '') {
        mostrarError(campoId, nombreVisible + ' es requerido.');
        return false;
    }
    limpiarError(campoId);
    return true;
}

function validarEmail(campoId) {
    const campo = document.getElementById(campoId) || document.querySelector('[name="' + campoId + '"]');
    if (!campo) return true;
    const valor = campo.value.trim();
    if (valor === '') {
        mostrarError(campoId, 'El correo es requerido.');
        return false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)) {
        mostrarError(campoId, 'Ingrese un correo válido.');
        return false;
    }
    limpiarError(campoId);
    return true;
}

function validarCantidad(campoId, nombreVisible) {
    const campo = document.getElementById(campoId) || document.querySelector('[name="' + campoId + '"]');
    if (!campo) return true;
    const valor = parseInt(campo.value, 10);
    if (isNaN(valor) || valor < 1) {
        mostrarError(campoId, nombreVisible + ' debe ser al menos 1.');
        return false;
    }
    limpiarError(campoId);
    return true;
}

function validarSelect(campoId, nombreVisible) {
    const campo = document.getElementById(campoId) || document.querySelector('[name="' + campoId + '"]');
    if (!campo) return true;
    if (campo.value === '' || campo.value === null) {
        mostrarError(campoId, 'Seleccione ' + nombreVisible + '.');
        return false;
    }
    limpiarError(campoId);
    return true;
}

document.addEventListener('DOMContentLoaded', function () {

    var navLinks = document.querySelectorAll('.navbar .nav-link');
    var sections = document.querySelectorAll('section[id]');
    var navbar = document.getElementById('mainNavbar');

    navLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var targetId = this.getAttribute('href').substring(1);
            var targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
                var navbarCollapse = document.getElementById('navbarNav');
                var bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                navLinks.forEach(function (link) {
                    link.classList.remove('active');
                });
                var activeLink = document.querySelector(
                    '.navbar .nav-link[data-section="' + entry.target.id + '"]'
                );
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });
    }, { threshold: 0.3 });

    sections.forEach(function (section) {
        observer.observe(section);
    });

    window.addEventListener('scroll', function () {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    var yearSpan = document.getElementById('year');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }

    function animateCounter(element, target, duration) {
        var start = 0;
        var startTime = null;
        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = Math.floor(eased * target);
            element.textContent = current.toLocaleString('es-CR');
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                element.textContent = target.toLocaleString('es-CR');
            }
        }
        requestAnimationFrame(step);
    }

    var countersSection = document.getElementById('impacto');
    var countersAnimated = false;

    if (countersSection) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !countersAnimated) {
                    countersAnimated = true;
                    var counterNumbers = countersSection.querySelectorAll('.counter-number');
                    counterNumbers.forEach(function (counter) {
                        var target = parseInt(counter.getAttribute('data-target'), 10);
                        animateCounter(counter, target, 2000);
                    });
                }
            });
        }, { threshold: 0.4 });
        counterObserver.observe(countersSection);
    }

    var formDonacion = document.getElementById('formDonacion');
    if (formDonacion) {
        formDonacion.setAttribute('novalidate', '');

        formDonacion.querySelector('[name="nombreDonador"]').addEventListener('input', function () {
            validarCampoRequerido('nombreDonador', 'El nombre');
        });
        formDonacion.querySelector('[name="correoDonador"]').addEventListener('input', function () {
            validarEmail('correoDonador');
        });
        formDonacion.querySelector('[name="telefonoDonador"]').addEventListener('input', function () {
            validarCampoRequerido('telefonoDonador', 'El teléfono');
        });
        formDonacion.querySelector('[name="tipoEquipo"]').addEventListener('change', function () {
            validarSelect('tipoEquipoDonacion', 'un tipo de equipo');
        });
        formDonacion.querySelector('[name="estadoEquipo"]').addEventListener('change', function () {
            validarSelect('estadoEquipo', 'el estado del equipo');
        });
        formDonacion.querySelector('[name="cantidadEquipos"]').addEventListener('input', function () {
            validarCantidad('cantidadDonacion', 'La cantidad');
        });

        var tipoDonador = document.getElementById('tipoDonador');
        var detalleDonadorGroup = document.getElementById('detalleDonadorGroup');
        if (tipoDonador) {
            tipoDonador.addEventListener('change', function () {
                detalleDonadorGroup.style.display = this.value === 'Empresa' ? '' : 'none';
            });
        }

        formDonacion.addEventListener('submit', async function (e) {
            e.preventDefault();
            limpiarTodosLosErrores(formDonacion);

            var errores = false;
            if (!validarCampoRequerido('nombreDonador', 'El nombre')) errores = true;
            if (!validarEmail('correoDonador')) errores = true;
            if (!validarCampoRequerido('telefonoDonador', 'El teléfono')) errores = true;
            if (!validarSelect('tipoEquipoDonacion', 'un tipo de equipo')) errores = true;
            if (!validarSelect('estadoEquipo', 'el estado del equipo')) errores = true;
            if (!validarCantidad('cantidadDonacion', 'La cantidad')) errores = true;

            if (errores) return;

            var btn = formDonacion.querySelector('button[type="submit"]');
            var textoOriginal = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';

            var alertDiv = document.getElementById('donacionAlert');
            alertDiv.style.display = 'none';

            var formData = new FormData(formDonacion);
            var payload = {};
            formData.forEach(function (value, key) {
                payload[key] = value;
            });

            try {
                var response = await fetch(BASE_URL + 'formularios/donacion', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                var resData = await response.json();

                if (resData.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Donación registrada',
                        text: resData.message,
                        confirmButtonColor: '#2d6758',
                        confirmButtonText: 'Entendido'
                    });
                    formDonacion.reset();
                    formDonacion.querySelectorAll('.is-valid').forEach(function (el) {
                        el.classList.remove('is-valid');
                    });
                } else {
                    var mensaje = resData.message || 'Verifique los datos e intente nuevamente.';
                    if (Array.isArray(resData.errores)) {
                        mensaje = resData.errores.join(' ');
                    }
                    alertDiv.className = 'form-alert alert-danger';
                    alertDiv.textContent = mensaje;
                    alertDiv.style.display = 'block';
                }
            } catch (error) {
                console.error(error);
                alertDiv.className = 'form-alert alert-danger';
                alertDiv.textContent = 'Ocurrió un error al enviar. Intente nuevamente.';
                alertDiv.style.display = 'block';
            } finally {
                btn.disabled = false;
                btn.innerHTML = textoOriginal;
            }
        });
    }

    var formSolicitud = document.getElementById('formSolicitud');
    if (formSolicitud) {
        formSolicitud.setAttribute('novalidate', '');

        formSolicitud.querySelector('[name="nombreSolicitante"]').addEventListener('input', function () {
            validarCampoRequerido('nombreSolicitante', 'El nombre');
        });
        formSolicitud.querySelector('[name="correoSolicitante"]').addEventListener('input', function () {
            validarEmail('correoSolicitante');
        });
        formSolicitud.querySelector('[name="telefonoSolicitante"]').addEventListener('input', function () {
            validarCampoRequerido('telefonoSolicitante', 'El teléfono');
        });
        formSolicitud.querySelector('[name="nombreOrganizacion"]').addEventListener('input', function () {
            validarCampoRequerido('organizacionSolicitante', 'El nombre de la organización');
        });
        formSolicitud.querySelector('[name="tipoOrganizacion"]').addEventListener('change', function () {
            validarSelect('tipoOrganizacion', 'un tipo de organización');
        });
        formSolicitud.querySelector('[name="tipoEquipo"]').addEventListener('change', function () {
            validarSelect('equipoSolicitado', 'un equipo');
        });
        formSolicitud.querySelector('[name="cantidadEquipos"]').addEventListener('input', function () {
            validarCantidad('cantidadSolicitud', 'La cantidad');
        });
        formSolicitud.querySelector('[name="motivoSolicitud"]').addEventListener('input', function () {
            validarCampoRequerido('motivoSolicitud', 'El motivo');
        });

        formSolicitud.addEventListener('submit', async function (e) {
            e.preventDefault();
            limpiarTodosLosErrores(formSolicitud);

            var errores = false;
            if (!validarCampoRequerido('nombreSolicitante', 'El nombre')) errores = true;
            if (!validarEmail('correoSolicitante')) errores = true;
            if (!validarCampoRequerido('telefonoSolicitante', 'El teléfono')) errores = true;
            if (!validarCampoRequerido('organizacionSolicitante', 'El nombre de la organización')) errores = true;
            if (!validarSelect('tipoOrganizacion', 'un tipo de organización')) errores = true;
            if (!validarSelect('equipoSolicitado', 'un equipo')) errores = true;
            if (!validarCantidad('cantidadSolicitud', 'La cantidad')) errores = true;
            if (!validarCampoRequerido('motivoSolicitud', 'El motivo')) errores = true;

            if (errores) return;

            var btn = formSolicitud.querySelector('button[type="submit"]');
            var textoOriginal = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';

            var alertDiv = document.getElementById('solicitudAlert');
            alertDiv.style.display = 'none';

            var formData = new FormData(formSolicitud);
            var payload = {};
            formData.forEach(function (value, key) {
                payload[key] = value;
            });

            try {
                var response = await fetch(BASE_URL + 'formularios/solicitud', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                var resData = await response.json();

                if (resData.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Solicitud registrada',
                        text: resData.message,
                        confirmButtonColor: '#2d6758',
                        confirmButtonText: 'Entendido'
                    });
                    formSolicitud.reset();
                } else {
                    var mensaje = resData.message || 'Verifique los datos e intente nuevamente.';
                    if (Array.isArray(resData.errores)) {
                        mensaje = resData.errores.join(' ');
                    }
                    alertDiv.className = 'form-alert alert-danger';
                    alertDiv.textContent = mensaje;
                    alertDiv.style.display = 'block';
                }
            } catch (error) {
                console.error(error);
                alertDiv.className = 'form-alert alert-danger';
                alertDiv.textContent = 'Ocurrió un error al enviar. Intente nuevamente.';
                alertDiv.style.display = 'block';
            } finally {
                btn.disabled = false;
                btn.innerHTML = textoOriginal;
            }
        });
    }

    var formContacto = document.getElementById('formContacto');
    if (formContacto) {
        formContacto.setAttribute('novalidate', '');

        formContacto.querySelector('[name="nombre"]').addEventListener('input', function () {
            validarCampoRequerido('contactoNombre', 'El nombre');
        });
        formContacto.querySelector('[name="correo"]').addEventListener('input', function () {
            validarEmail('contactoCorreo');
        });
        formContacto.querySelector('[name="asunto"]').addEventListener('input', function () {
            validarCampoRequerido('contactoAsunto', 'El asunto');
        });
        formContacto.querySelector('[name="mensaje"]').addEventListener('input', function () {
            validarCampoRequerido('contactoMensaje', 'El mensaje');
        });

        formContacto.addEventListener('submit', async function (e) {
            e.preventDefault();
            limpiarTodosLosErrores(formContacto);

            var errores = false;
            if (!validarCampoRequerido('contactoNombre', 'El nombre')) errores = true;
            if (!validarEmail('contactoCorreo')) errores = true;
            if (!validarCampoRequerido('contactoAsunto', 'El asunto')) errores = true;
            if (!validarCampoRequerido('contactoMensaje', 'El mensaje')) errores = true;

            if (errores) return;

            var btn = formContacto.querySelector('button[type="submit"]');
            var textoOriginal = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';

            var alertDiv = document.getElementById('contactoAlert');
            alertDiv.style.display = 'none';

            var formData = new FormData(formContacto);
            var payload = {};
            formData.forEach(function (value, key) {
                payload[key] = value;
            });

            try {
                var response = await fetch(BASE_URL + 'formularios/contacto', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                var resData = await response.json();

                if (resData.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Mensaje enviado',
                        text: resData.message,
                        confirmButtonColor: '#2d6758',
                        confirmButtonText: 'Entendido'
                    });
                    formContacto.reset();
                } else {
                    var mensaje = resData.message || 'Verifique los datos e intente nuevamente.';
                    if (Array.isArray(resData.errores)) {
                        mensaje = resData.errores.join(' ');
                    }
                    alertDiv.className = 'form-alert alert-danger';
                    alertDiv.textContent = mensaje;
                    alertDiv.style.display = 'block';
                }
            } catch (error) {
                console.error(error);
                alertDiv.className = 'form-alert alert-danger';
                alertDiv.textContent = 'Ocurrió un error al enviar. Intente nuevamente.';
                alertDiv.style.display = 'block';
            } finally {
                btn.disabled = false;
                btn.innerHTML = textoOriginal;
            }
        });
    }

});
