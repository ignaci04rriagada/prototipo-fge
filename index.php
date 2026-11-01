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

        <!-- Barra Superior (Topbar) para País e Info rápida -->
        <div class="topbar-fge bg-light py-1 border-bottom">
            <div class="container-fluid px-lg-5">
                <div class="d-flex justify-content-between align-items-center">

                    <!-- Selector de País (Átomo con BI Icons) -->
                    <div class="country-dropdown-wrapper position-relative">
                        <button class="country-select-fge" type="button" id="countrySelector" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-globe icon-fge"></i>
                            <span>Chile</span>
                            <i class="bi bi-chevron-down country-select-fge__icon"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm border-0 mt-1" aria-labelledby="countrySelector">
                            <li><a class="dropdown-item" href="#">Chile</a></li>
                            <li><a class="dropdown-item" href="#">Argentina</a></li>
                            <li><a class="dropdown-item" href="#">Perú</a></li>
                        </ul>
                    </div>

                    <!-- Redes o contacto rápido (Opcional) -->
                    <div class="d-none d-md-flex gap-3 align-items-center text-muted fs-6">
                        <a href="#" class="text-secondary text-decoration-none"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-secondary text-decoration-none"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-secondary text-decoration-none"><i class="bi bi-linkedin"></i></a>
                    </div>

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