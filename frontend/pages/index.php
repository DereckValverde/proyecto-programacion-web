<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dona Tecnología, Cambia Vidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/images/LOGO.png">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#inicio">
                <img src="../assets/images/LOGO.png" alt="ConectiTicos" class="navbar-logo"> ConectiTicos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menú">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio" data-section="inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mision" data-section="mision">Historia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#impacto" data-section="impacto">Impacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aliados" data-section="aliados">Aliados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto" data-section="contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-aplicar" href="#solicitar" data-section="donar">Aplicar para
                            computadoras</a>
                        <!-- Se cambio el #donar por un #solicitar para que el boton aplique a la seccion correcta -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-donar" href="#donar" data-section="donar">Donar computadoras</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="inicio" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 hero-content">
                    <h1>Donar tecnología,<br><span class="highlight">cambiar vidas</span></h1>
                    <p class="hero-subtitle">Conectamos tecnología con quienes más la necesitan</p>
                    <p class="hero-description">Tu equipo usado puede ser la herramienta que alguien más necesita para
                        estudiar, trabajar o emprender. Cada donación cuenta.</p>
                    <div>
                        <a href="#donar" class="btn-coral"><i class="fas fa-hand-holding-heart"></i> Donar
                            computadoras</a>
                        <a href="#solicitar" class="btn-outline-white"><i class="fas fa-laptop"></i> Aplicar para
                            computadoras</a>
                        <!-- Se cambio el #donar por un #solicitar para que el boton aplique a la seccion correcta -->


                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">5000+</span>
                            <span class="stat-label">Equipos donados</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <span class="stat-number">200+</span>
                            <span class="stat-label">Comunidades</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <span class="stat-number">98%</span>
                            <span class="stat-label">Satisfacción</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-wrapper">
                        <img src="https://placehold.co/600x500/007b8b/FFFFFF?text=Equipos+que+transforman"
                            alt="Equipos tecnológicos donados">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="#donar" class="cta-card">
                        <div class="cta-icon pine"><i class="fas fa-laptop"></i></div>
                        <h3>Donar computadoras</h3>
                        <p>Entrega tus equipos en desuso. Los reacondicionamos y los llevamos a comunidades, escuelas y
                            emprendedores que los necesitan.</p>
                        <span class="cta-btn pine">Donar ahora <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#solicitar" class="cta-card">
                        <!-- Se cambio el #contacto por un #solicitar para que el tarjeta aplique a la zona correcta -->

                        <div class="cta-icon indigo"><i class="fas fa-graduation-cap"></i></div>
                        <h3>Aplicar para computadoras</h3>
                        <p>Representas a una escuela, fundación o comunidad. Solicita equipos tecnológicos para tus
                            beneficiarios y transforma su futuro.</p>
                        <span class="cta-btn indigo">Aplicar ahora <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#contacto" class="cta-card">
                        <div class="cta-icon coral"><i class="fas fa-handshake"></i></div>
                        <h3>Ser aliado</h3>
                        <p>Empresa o institución: apoya con logística, financiamiento, voluntariado corporativo o
                            donaciones de tu inventario.</p>
                        <span class="cta-btn coral">Ser aliado <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="mision">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-header text-start">
                        <div class="sh-bar"></div>
                        <p class="sh-label">Nuestra misión</p>
                        <h2>Tecnología que transforma comunidades</h2>
                    </div>
                    <p class="mission-text">Conectamos empresas y personas que tienen equipos tecnológicos en desuso con
                        comunidades, escuelas y emprendedores que los necesitan para transformar su futuro.</p>
                    <p class="mission-secondary">Desde 2020, hemos facilitado la donación de más de 5,000 equipos,
                        reduciendo la brecha digital y el desperdicio electrónico en toda la región.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://placehold.co/600x400/2d6758/FFFFFF?text=Tecnolog%C3%ADa+que+transforma"
                        alt="Tecnología que transforma vidas">
                </div>
            </div>
            <div class="section-header">
                <div class="sh-bar"></div>
                <p class="sh-label">Tres formas de participar</p>
                <h2>¿Cómo puedes sumarte?</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="pilar-card">
                        <div class="pilar-icon pine"><i class="fas fa-box-open"></i></div>
                        <h4>Doná tus equipos</h4>
                        <p>Entregás tu tecnología en desuso. Nosotros la reacondicionamos y se la damos a quien más la
                            necesita.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pilar-card">
                        <div class="pilar-icon indigo"><i class="fas fa-school"></i></div>
                        <h4>Recibí tecnología</h4>
                        <p>Representás una organización. Solicitá equipos para tus beneficiarios y te ayudamos a cerrar
                            la brecha digital.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pilar-card">
                        <div class="pilar-icon coral"><i class="fas fa-handshake"></i></div>
                        <h4>Colaborá con nosotros</h4>
                        <p>Empresa o institución: sé aliado estratégico con logística, financiamiento o voluntariado
                            corporativo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="impacto" class="bg-pine section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Nuestro Impacto</h2>
                <p class="sh-subtitle">Resultados que impulsan nuestra misión día a día</p>
            </div>
            <div class="impact-counters">
                <div class="counter-item">
                    <div class="counter-icon"><i class="fas fa-laptop"></i></div>
                    <span class="counter-number" data-target="5000">0</span><span class="counter-suffix">+</span>
                    <span class="counter-label">Equipos donados</span>
                </div>
                <div class="counter-item">
                    <div class="counter-icon"><i class="fas fa-users"></i></div>
                    <span class="counter-number" data-target="200">0</span><span class="counter-suffix">+</span>
                    <span class="counter-label">Comunidades beneficiadas</span>
                </div>
                <div class="counter-item">
                    <div class="counter-icon"><i class="fas fa-handshake"></i></div>
                    <span class="counter-number" data-target="150">0</span><span class="counter-suffix">+</span>
                    <span class="counter-label">Aliados corporativos</span>
                </div>
                <div class="counter-item">
                    <div class="counter-icon"><i class="fas fa-leaf"></i></div>
                    <span class="counter-number" data-target="450">0</span><span class="counter-suffix"> ton</span>
                    <span class="counter-label">CO&#8322; evitadas</span>
                </div>
            </div>
        </div>
    </section>

    <section id="como-donar" class="section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>¿Cómo donar?</h2>
                <p class="sh-subtitle">Cuatro pasos simples para transformar vidas</p>
            </div>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number pine">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h4>Registra</h4>
                    <p>Completá el formulario con los datos de tus equipos y tu información de contacto.</p>
                </div>
                <div class="step-card">
                    <div class="step-number teal">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h4>Prepara</h4>
                    <p>Reúne los equipos que deseás donar y verificá que estén en buen estado.</p>
                </div>
                <div class="step-card">
                    <div class="step-number coral">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h4>Entrega</h4>
                    <p>Coordinamos la recogida o vos los dejás en uno de nuestros puntos de acopio.</p>
                </div>
                <div class="step-card">
                    <div class="step-number indigo">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Impacta</h4>
                    <p>Tu donación llega a comunidades, escuelas y emprendedores que la necesitan.</p>
                </div>
            </div>
        </div>
    </section>

<!-- Aca se agrego el formulario para la gente que desea donar equipo -->
    <section id="donar" class="bg-alt section-padding">

        <div class="container">

            <div class="section-header">
                <div class="sh-bar"></div>
                <p class="sh-label">Quiero donar</p>
                <h2>Registrá tu Donación</h2>
                <p class="sh-subtitle">
                    Completá este formulario únicamente si deseás ofrecer
                    equipos tecnológicos para donación.
                </p>
            </div>

            <div class="public-form-card donation-form-card">

                <div class="form-message donation-message">

                    <i class="fas fa-hand-holding-heart"></i>

                    <div>
                        <h3>Donación de equipos</h3>
                        <p>
                            Este formulario es para empresas que desean
                            <strong>donar equipos tecnológicos.</strong>
                        </p>
                    </div>

                </div>
                <form action="" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombreDonante" class="form-label">
                                Nombre completo
                            </label>

                            <input type="text" class="form-control" id="nombreDonante" name="nombreDonante"
                                placeholder="Ingrese su nombre" required>

                        </div>
                        <div class="col-md-6">
                            <label for="emailDonante" class="form-label">
                                Correo electrónico
                            </label>

                            <input type="email" class="form-control" id="emailDonante" name="emailDonante"
                                placeholder="correo@ejemplo.com" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefonoDonante" class="form-label">
                                Teléfono
                            </label>

                            <input type="tel" class="form-control" id="telefonoDonante" name="telefonoDonante"
                                placeholder="8888-8888" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoEquipoDonacion" class="form-label">
                                Tipo de equipo
                            </label>

                            <select class="form-select" id="tipoEquipoDonacion" name="tipoEquipoDonacion" required>

                                <option value="" selected disabled>
                                    Seleccione un equipo
                                </option>
                                <option value="Laptop">Laptop</option>
                                <option value="Computadora de escritorio">
                                    Computadora de escritorio
                                </option>
                                <option value="Monitor">Monitor</option>
                                <option value="Teclado">Teclado</option>
                                <option value="Mouse">Mouse</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Impresora">Impresora</option>
                                <option value="Otro">Otro</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="marcaEquipo" class="form-label">
                                Marca
                            </label>

                            <input type="text" class="form-control" id="marcaEquipo" name="marcaEquipo"
                                placeholder="Ej: Dell">
                        </div>
                        <div class="col-md-6">
                            <label for="modeloEquipo" class="form-label">
                                Modelo
                            </label>

                            <input type="text" class="form-control" id="modeloEquipo" name="modeloEquipo"
                                placeholder="Ej: Latitude 5420">
                        </div>
                        <div class="col-md-6">
                            <label for="estadoEquipo" class="form-label">
                                Estado del equipo
                            </label>

                            <select class="form-select" id="estadoEquipo" name="estadoEquipo" required>
                                <option value="" selected disabled>
                                    Seleccione el estado
                                </option>
                                <option value="Nuevo">Nuevo</option>
                                <option value="Bueno">Bueno</option>
                                <option value="Regular">Regular</option>
                                <option value="Malo">Malo</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="cantidadDonacion" class="form-label">
                                Cantidad de equipos
                            </label>

                            <input type="number" class="form-control" id="cantidadDonacion" name="cantidadDonacion"
                                min="1" placeholder="1" required>
                        </div>
                        <div class="col-12">
                            <label for="descripcionDonacion" class="form-label">
                                Descripción adicional
                            </label>

                            <textarea class="form-control" id="descripcionDonacion" name="descripcionDonacion" rows="4"
                                placeholder="Contanos cualquier detalle adicional sobre los equipos"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" name="enviarDonacion" class="public-form-btn donation-form-btn">
                                <i class="fas fa-hand-holding-heart"></i>
                                Registrar donación
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Aca se agrego el formulario para las empresas que desean solicitar equipo -->
    <section id="solicitar" class="section-padding">

        <div class="container">

            <div class="section-header">
                <div class="sh-bar"></div>
                <p class="sh-label request-label">Necesito equipos</p>
                <h2>Solicitá Equipos Tecnológicos</h2>
                <p class="sh-subtitle">
                    Completá este formulario únicamente si necesitás
                    solicitar equipos para una organización o comunidad.
                </p>
            </div>

            <div class="public-form-card request-form-card">

                <div class="form-message request-message">

                    <i class="fas fa-laptop"></i>

                    <div>
                        <h3>Solicitud de equipos</h3>
                        <p>
                            Este formulario es para organizaciones o comunidades que
                            <strong>necesitan recibir equipos tecnológicos.</strong>
                        </p>
                    </div>

                </div>

                <form action="" method="POST">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label for="nombreSolicitante" class="form-label">
                                Nombre del solicitante
                            </label>

                            <input type="text" class="form-control" id="nombreSolicitante" name="nombreSolicitante"
                                placeholder="Ingrese su nombre" required>

                        </div>

                        <div class="col-md-6">

                            <label for="emailSolicitante" class="form-label">
                                Correo electrónico
                            </label>

                            <input type="email" class="form-control" id="emailSolicitante" name="emailSolicitante"
                                placeholder="correo@ejemplo.com" required>

                        </div>

                        <div class="col-md-6">

                            <label for="telefonoSolicitante" class="form-label">
                                Teléfono
                            </label>

                            <input type="tel" class="form-control" id="telefonoSolicitante" name="telefonoSolicitante"
                                placeholder="8888-8888" required>

                        </div>

                        <div class="col-md-6">

                            <label for="organizacionSolicitante" class="form-label">
                                Nombre de la organización
                            </label>

                            <input type="text" class="form-control" id="organizacionSolicitante"
                                name="organizacionSolicitante" placeholder="Nombre de la organización" required>

                        </div>

                        <div class="col-md-6">

                            <label for="tipoOrganizacion" class="form-label">
                                Tipo de organización
                            </label>

                            <select class="form-select" id="tipoOrganizacion" name="tipoOrganizacion" required>

                                <option value="" selected disabled>
                                    Seleccione una opción
                                </option>
                                <option value="Escuela">Escuela</option>
                                <option value="Colegio">Colegio</option>
                                <option value="Universidad">Universidad</option>
                                <option value="Fundación">Fundación</option>
                                <option value="Asociación">Asociación</option>
                                <option value="Comunidad">Comunidad</option>
                                <option value="Emprendimiento">Emprendimiento</option>
                                <option value="Otra">Otra</option>

                            </select>

                        </div>
                        <div class="col-md-6">

                            <label for="equipoSolicitado" class="form-label">
                                Equipo solicitado
                            </label>

                            <select class="form-select" id="equipoSolicitado" name="equipoSolicitado" required>

                                <option value="" selected disabled>
                                    Seleccione un equipo
                                </option>
                                <option value="Laptop">Laptop</option>
                                <option value="Computadora de escritorio">
                                    Computadora de escritorio
                                </option>
                                <option value="Monitor">Monitor</option>
                                <option value="Teclado">Teclado</option>
                                <option value="Mouse">Mouse</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Impresora">Impresora</option>
                                <option value="Otro">Otro</option>

                            </select>

                        </div>
                        <div class="col-md-6">

                            <label for="cantidadSolicitud" class="form-label">
                                Cantidad de equipos
                            </label>

                            <input type="number" class="form-control" id="cantidadSolicitud" name="cantidadSolicitud"
                                min="1" placeholder="1" required>

                        </div>
                        <div class="col-12">

                            <label for="motivoSolicitud" class="form-label">
                                Motivo de la solicitud
                            </label>

                            <textarea class="form-control" id="motivoSolicitud" name="motivoSolicitud" rows="5"
                                placeholder="Explicanos para qué se utilizarán los equipos y quiénes serán los beneficiarios"
                                required></textarea>

                        </div>
                        <div class="col-12">

                            <button type="submit" name="enviarSolicitud" class="public-form-btn request-form-btn">

                                <i class="fas fa-paper-plane"></i>
                                Enviar solicitud de equipos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="aliados" class="section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Aliados</h2>
                <p class="sh-subtitle">Empresas que hacen posible esta labor</p>
            </div>
            <div class="allies-marquee-wrapper">
                <div class="allies-marquee">
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                    <span class="allies-marquee-text">Próximamente</span>
                    <span class="allies-marquee-line"></span>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonios" class="bg-alt section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Testimonios</h2>
                <p class="sh-subtitle">Historias de quienes han sido beneficiados</p>
            </div>
            <div id="testimoniosCarousel" class="carousel slide testimonials-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial-card">
                            <p class="testimonial-text">Gracias a ConectiTicos, nuestros estudiantes de la escuela rural de San Carlos ahora cuentan con laptops para sus tareas. El impacto en su rendimiento académico ha sido increíble.</p>
                            <div class="testimonial-author">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="María" class="testimonial-avatar">
                                <div class="testimonial-info">
                                    <h5>María Fernández</h5>
                                    <p>Directora, Escuela Rural San Carlos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial-card">
                            <p class="testimonial-text">Donamos 30 laptops que ya no usábamos en la empresa. El proceso fue muy sencillo y ahora sabemos que están ayudando a emprendedores en Limón. Una experiencia excelente.</p>
                            <div class="testimonial-author">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos" class="testimonial-avatar">
                                <div class="testimonial-info">
                                    <h5>Carlos Mora</h5>
                                    <p>Gerente de TI, TechCorp CR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial-card">
                            <p class="testimonial-text">Con las computadoras recibidas pudimos crear un centro de capacitación digital para mujeres emprendedoras. Más de 80 personas ya se capacitaron en ofimática y emprendimiento.</p>
                            <div class="testimonial-author">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Laura" class="testimonial-avatar">
                                <div class="testimonial-info">
                                    <h5>Laura Jiménez</h5>
                                    <p>Coordinadora, Fundación Futuro Digital</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#testimoniosCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#testimoniosCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#testimoniosCarousel" data-bs-slide-to="2"></button>
                </div>
            </div>
        </div>
    </section>

 <section id="contacto" class="section-padding">
    <div class="container">

        <div class="section-header">
            <div class="sh-bar"></div>
            <h2>Contacto</h2>
            <p class="sh-subtitle">Estamos aquí para ayudarte</p>
        </div>

        <div class="row g-4">

            <!-- Formulario -->
            <div class="col-lg-7">

                <div class="card shadow border-0 h-100">

                    <div class="card-body p-4">

                        <h4 class="mb-4">Envíanos un mensaje</h4>

                        <form>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" placeholder="Tu nombre">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" placeholder="correo@ejemplo.com">
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asunto</label>
                                <input type="text" class="form-control" placeholder="Asunto del mensaje">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Mensaje</label>
                                <textarea class="form-control" rows="6" placeholder="Escribe tu mensaje"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-paper-plane"></i>
                                Enviar mensaje
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Información -->
            <div class="col-lg-5">

                <div class="card shadow border-0 mb-4">

                    <div class="card-body">

                        <h4 class="mb-4">Información de contacto</h4>

                        <p>
                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                            San José, Costa Rica
                        </p>

                        <p>
                            <i class="fas fa-phone text-success me-2"></i>
                            +506 8888-7777
                        </p>

                        <p>
                            <i class="fas fa-envelope text-success me-2"></i>
                            info@conectiticos.org
                        </p>

                    </div>

                </div>

                <div class="card shadow border-0">

                    <div class="card-body text-center">

                        <h4 class="mb-4">Síguenos</h4>

                        <a href="#" class="btn btn-outline-primary rounded-circle m-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#" class="btn btn-outline-danger rounded-circle m-2">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="#" class="btn btn-outline-info rounded-circle m-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                        <a href="#" class="btn btn-outline-success rounded-circle m-2">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>