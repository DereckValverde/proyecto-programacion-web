    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src=<?= BASE_URL . 'public/images/LOGO.png' ?> alt=" ConectiTicos" class="navbar-logo"> ConectiTicos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menú">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL . 'auth/dashboard' ?>" data-section="inicio">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . 'auth/solicitudes' ?>" data-section="mision">Gestión de Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . 'auth/donaciones' ?>" data-section="impacto">Gestión de Donaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . 'auth/logout' ?>"><i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>