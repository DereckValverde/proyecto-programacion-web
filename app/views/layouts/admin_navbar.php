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
                        <a class="nav-link" href="<?= BASE_URL . 'auth/dashboard' ?>" data-section="inicio">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkSolicitudes" href="<?= BASE_URL . 'auth/solicitudes' ?>" data-section="mision">Gestión de Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkDonaciones" href="<?= BASE_URL . 'auth/donaciones' ?>" data-section="impacto">Gestión de Donaciones</a>
                    </li>

                    <li class="nav-item w-50 d-lg-none">
                        <hr class="my-2">
                    </li>

                    <li class="nav-item d-none d-lg-block px-3">
                        <div class="vr" style="height:30px;"></div>
                    </li>

                    <li>
                        <span class="text-black-50">dereck@gmail.com</span>
                    </li>



                    <li class="nav-item px-2">
                        <a class="nav-link" href="<?= BASE_URL . 'auth/logout' ?>"><i class="bi bi-box-arrow-right text-black-50"></i></a>
                    </li>
                </ul>



            </div>
        </div>
    </nav>