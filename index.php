<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundación Gestionar Esperanzas</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Hoja de estilos principal con tokens y átomos -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- ORGANISMO: Header / Navbar principal -->
    <header class="header-fge border-bottom">

        <!-- ORGANISMO: Topbar (.topbar-fge) -->
        <div class="topbar-fge">
            <div class="container-fluid">
                <div class="topbar-fge__container">

                    <!-- MOLÉCULA: Selector de País -->
                    <div class="topbar-fge__country-selector country-dropdown-fge">
                        <button class="country-dropdown-fge__toggle" type="button" id="countrySelector"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            aria-label="Seleccionar país (Actual: Chile)">
                            <i class="bi bi-globe country-dropdown-fge__icon" aria-hidden="true"></i>
                            <span class="country-dropdown-fge__label">Chile</span>
                            <i class="bi bi-chevron-down country-dropdown-fge__chevron" aria-hidden="true"></i>
                        </button>

                        <!-- Menú Desplegable -->
                        <ul class="dropdown-menu country-dropdown-fge__menu" aria-labelledby="countrySelector">
                            <li><a class="dropdown-item country-dropdown-fge__item country-dropdown-fge__item--active"
                                    href="#">Chile</a></li>
                            <li><a class="dropdown-item country-dropdown-fge__item" href="#">Argentina</a></li>
                            <li><a class="dropdown-item country-dropdown-fge__item" href="#">Perú</a></li>
                        </ul>
                    </div>

                    <!-- MOLÉCULA: Redes Sociales -->
                    <nav class="topbar-fge__socials" aria-label="Redes sociales de la fundación">
                        <ul class="topbar-fge__social-list">
                            <li class="topbar-fge__social-item">
                                <a href="#" class="topbar-fge__social-link" aria-label="Visita nuestro Instagram">
                                    <i class="bi bi-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="topbar-fge__social-item">
                                <a href="#" class="topbar-fge__social-link" aria-label="Visita nuestro Facebook">
                                    <i class="bi bi-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="topbar-fge__social-item">
                                <a href="#" class="topbar-fge__social-link" aria-label="Visita nuestro LinkedIn">
                                    <i class="bi bi-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>

        <!-- Navegación Principal -->
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container-fluid px-lg-5">

                <!-- Logo FGE -->
                <a class="navbar-brand fw-bold text-uppercase tracking-wide" href="#"
                    style="color: var(--fge-color-brand-primary);">
                    <i class="bi bi-heart-pulse-fill me-1" style="color: var(--fge-color-action-primary);"></i>
                    FGE Esperanza
                </a>

                <!-- Botón Hamburger para Móviles -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarFGE" aria-controls="navbarFGE" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menú de Enlaces y CTAs -->
                <div class="collapse navbar-collapse" id="navbarFGE">

                    <!-- Links Centrales (Átomos .nav-link-fge) -->
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-4">
                        <li class="nav-item">
                            <a class="nav-link-fge nav-link-fge--active" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-fge" href="#">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-fge" href="#">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-fge" href="#">Transparencia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-fge" href="#">Contacto</a>
                        </li>
                    </ul>

                    <!-- Botones de Acción (Átomos .btn-fge) -->
                    <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                        <a href="#" class="btn-fge btn-fge--secondary">
                            Voluntariado
                        </a>
                        <a href="#" class="btn-fge btn-fge--primary">
                            <i class="bi bi-heart-fill icon-fge"></i>
                            Donar
                        </a>
                    </div>

                </div>

            </div>
        </nav>
    </header>

    <!-- Contenido de prueba de la grilla -->
    <main class="py-5">
        <div class="container-fluid px-lg-5">
            <div class="row">
                <div class="col-12">
                    <span class="badge-fge mb-3">MAMP Prototype</span>
                    <h1 style="font-family: var(--fge-font-family-heading); color: var(--fge-color-brand-primary);">
                        Fundación Gestionar Esperanzas
                    </h1>
                    <p class="lead">Entorno modular PHP en ejecución previa al desarrollo de WordPress.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5.3 JS Bundle con Popper (Necesario para el dropdown del selector de país) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>