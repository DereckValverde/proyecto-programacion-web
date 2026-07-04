<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dona Tecnología, Cambia Vidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/LOGO.png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#inicio">
                <img src="img/LOGO.png" alt="ConectiTicos" class="navbar-logo"> ConectiTicos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menú">
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
                        <a class="nav-link btn-aplicar" href="#donar" data-section="donar">Aplicar para computadoras</a>
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
                    <p class="hero-description">Tu equipo usado puede ser la herramienta que alguien más necesita para estudiar, trabajar o emprender. Cada donación cuenta.</p>
                    <div>
                        <a href="#donar" class="btn-coral"><i class="fas fa-hand-holding-heart"></i> Donar computadoras</a>
                        <a href="#donar" class="btn-outline-white"><i class="fas fa-laptop"></i> Aplicar para computadoras</a>
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
                        <img src="https://placehold.co/600x500/007b8b/FFFFFF?text=Equipos+que+transforman" alt="Equipos tecnológicos donados">
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
                        <p>Entrega tus equipos en desuso. Los reacondicionamos y los llevamos a comunidades, escuelas y emprendedores que los necesitan.</p>
                        <span class="cta-btn pine">Donar ahora <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#contacto" class="cta-card">
                        <div class="cta-icon indigo"><i class="fas fa-graduation-cap"></i></div>
                        <h3>Aplicar para computadoras</h3>
                        <p>Representas a una escuela, fundación o comunidad. Solicita equipos tecnológicos para tus beneficiarios y transforma su futuro.</p>
                        <span class="cta-btn indigo">Aplicar ahora <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#contacto" class="cta-card">
                        <div class="cta-icon coral"><i class="fas fa-handshake"></i></div>
                        <h3>Ser aliado</h3>
                        <p>Empresa o institución: apoya con logística, financiamiento, voluntariado corporativo o donaciones de tu inventario.</p>
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
                    <p class="mission-text">Conectamos empresas y personas que tienen equipos tecnológicos en desuso con comunidades, escuelas y emprendedores que los necesitan para transformar su futuro.</p>
                    <p class="mission-secondary">Desde 2020, hemos facilitado la donación de más de 5,000 equipos, reduciendo la brecha digital y el desperdicio electrónico en toda la región.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://placehold.co/600x400/2d6758/FFFFFF?text=Tecnolog%C3%ADa+que+transforma" alt="Tecnología que transforma vidas">
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
                        <p>Entregás tu tecnología en desuso. Nosotros la reacondicionamos y se la damos a quien más la necesita.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pilar-card">
                        <div class="pilar-icon indigo"><i class="fas fa-school"></i></div>
                        <h4>Recibí tecnología</h4>
                        <p>Representás una organización. Solicitá equipos para tus beneficiarios y te ayudamos a cerrar la brecha digital.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pilar-card">
                        <div class="pilar-icon coral"><i class="fas fa-handshake"></i></div>
                        <h4>Colaborá con nosotros</h4>
                        <p>Empresa o institución: sé aliado estratégico con logística, financiamiento o voluntariado corporativo.</p>
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
            <p class="placeholder-hint"><i class="fas fa-arrow-down"></i> US-04: Contadores animados con Intersection Observer</p>
        </div>
    </section>

    <section id="como-donar" class="section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>¿Cómo donar?</h2>
                <p class="sh-subtitle">Cuatro pasos simples para transformar vidas</p>
            </div>
            <p class="placeholder-hint"><i class="fas fa-arrow-down"></i> US-05: Flujo de 4 pasos con iconos FA</p>
        </div>
    </section>

    <section id="donar" class="bg-alt section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Registrá tu Donación</h2>
                <p class="sh-subtitle">Completá el formulario para donar tus equipos</p>
            </div>
            <p class="placeholder-hint"><i class="fas fa-arrow-down"></i> US-08 a US-10: Formulario + tabla + filtro</p>
        </div>
    </section>

    <section id="aliados" class="section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Aliados</h2>
                <p class="sh-subtitle">Empresas que hacen posible esta labor</p>
            </div>
            <p class="placeholder-hint"><i class="fas fa-arrow-down"></i> US-06: Grid de logos aliados</p>
        </div>
    </section>

    <section id="testimonios" class="bg-alt section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Testimonios</h2>
                <p class="sh-subtitle">Historias de quienes han sido beneficiados</p>
            </div>
            <p class="placeholder-hint"><i class="fas fa-arrow-down"></i> US-07: Carrusel Bootstrap con testimonios</p>
        </div>
    </section>

    <section id="contacto" class="section-padding">
        <div class="container">
            <div class="section-header">
                <div class="sh-bar"></div>
                <h2>Contacto</h2>
                <p class="sh-subtitle">Estamos aquí para ayudarte</p>
            </div>
            <p class="placeholder-hint"><i class="fas fa-arrow-down"></i> US-11: Formulario de contacto + redes sociales</p>
        </div>
    </section>

    <footer class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><img src="img/LOGO.png" alt="ConectiTicos" class="footer-logo"> ConectiTicos</h5>
                    <p>Cerrando la brecha digital, una compu a la vez.</p>
                    <div class="footer-newsletter">
                        <p>Recibí novedades</p>
                        <div class="input-group">
                            <input type="email" placeholder="tu@email.com">
                            <button type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                        <small class="form-text">Sin spam, solo info de campañas.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces rápidos</h5>
                    <ul>
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#mision">Cómo funciona</a></li>
                        <li><a href="#donar">Donar</a></li>
                        <li><a href="#impacto">Impacto</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Seguinos</h5>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <div class="contact-info">
                        <p class="footer-small"><i class="fas fa-envelope"></i> info@donatech.org</p>
                        <p class="footer-small"><i class="fas fa-phone"></i> +506 8888-7777</p>
                    </div>
                </div>
            </div>
            <hr>
            <p class="copyright">&copy; <span id="year"></span> ConectiTicos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>