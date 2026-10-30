<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundación Gestionar Esperanzas - Prototipo V0.2.0</title>

    <!-- Google Fonts para cargar Envolventa (fallback) y Lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3 CSS Base -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Tu Hoja de Estilos Principal BEM -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Estilos de componentes de prueba (Atoms/Molecules) usando tus CSS Tokens -->
    <style>
    /* ATOM: Botones (.btn-fge) */
    .btn-fge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: var(--fge-space-xs);
        padding: var(--fge-space-sm) var(--fge-space-lg);
        font-family: var(--fge-font-family-base);
        font-size: var(--fge-font-size-base);
        font-weight: var(--fge-font-weight-bold);
        border-radius: var(--fge-radius-md);
        border: 2px solid transparent;
        transition: var(--fge-transition-base);
        cursor: pointer;
        text-decoration: none;
    }

    .btn-fge--primary {
        background-color: var(--fge-color-brand-primary);
        color: var(--fge-color-text-inverse);
    }

    .btn-fge--primary:hover {
        background-color: var(--fge-color-brand-hover);
        color: var(--fge-color-text-inverse);
    }

    .btn-fge--action {
        background-color: var(--fge-color-action-primary);
        color: var(--fge-color-text-inverse);
    }

    .btn-fge--action:hover {
        opacity: 0.9;
        color: var(--fge-color-text-inverse);
    }

    .btn-fge--donate {
        background-color: var(--fge-color-action-donate);
        color: var(--fge-color-text-main);
    }

    .btn-fge--donate:hover {
        filter: brightness(0.95);
        color: var(--fge-color-text-main);
    }

    .btn-fge--outline {
        background-color: transparent;
        border-color: var(--fge-color-brand-primary);
        color: var(--fge-color-brand-primary);
    }

    .btn-fge--outline:hover {
        background-color: var(--fge-color-brand-primary);
        color: var(--fge-color-text-inverse);
    }

    /* MOLECULE: Tarjeta de Proyectos (.card-fge) */
    .card-fge {
        background-color: var(--fge-color-bg-surface);
        border-radius: var(--fge-radius-lg);
        padding: var(--fge-space-lg);
        box-shadow: var(--fge-shadow-sm);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: var(--fge-transition-base);
        border: 1px solid var(--fge-color-border-subtle);
    }

    .card-fge:hover {
        box-shadow: var(--fge-shadow-md);
        transform: translateY(-4px);
    }

    .card-fge__tag {
        display: inline-block;
        padding: var(--fge-space-2xs) var(--fge-space-xs);
        border-radius: var(--fge-radius-sm);
        font-size: var(--fge-font-size-sm);
        font-weight: var(--fge-font-weight-bold);
        color: var(--fge-color-text-inverse);
        margin-bottom: var(--fge-space-xs);
        align-self: flex-start;
    }

    .card-fge__tag--cyan {
        background-color: var(--fge-color-cyan-base);
    }

    .card-fge__tag--green {
        background-color: var(--fge-color-green-base);
        border-radius: var(--fge-radius-pill);
    }

    .card-fge__title {
        font-size: var(--fge-font-size-xl);
        color: var(--fge-color-brand-primary);
        margin-bottom: var(--fge-space-xs);
    }

    .card-fge__text {
        color: var(--fge-color-text-muted);
        font-size: var(--fge-font-size-base);
    }

    /* ORGANISM: Hero section (.hero-fge) */
    .hero-fge {
        background-color: var(--fge-color-bg-surface);
        padding: var(--fge-space-3xl) 0;
        border-bottom: 2px solid var(--fge-color-border-subtle);
        margin-bottom: var(--fge-space-2xl);
    }

    /* Navbar Brand Override */
    .header-fge {
        background-color: var(--fge-color-white);
        box-shadow: var(--fge-shadow-sm);
        padding: var(--fge-space-md) 0;
    }
    </style>
</head>

<body>

    <!-- ORGANISMO: Header / Navbar -->
    <header class="header-fge sticky-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="bi bi-heart-pulse-fill text-danger fs-3 me-2"></i>
                    <span class="h4 mb-0" style="color: var(--fge-color-brand-primary);">
                        Fundación Gestionar Esperanzas
                    </span>
                </a>
                <div class="d-none d-md-flex align-items-center gap-3">
                    <a href="#proyectos" class="fw-bold">Proyectos</a>
                    <a href="#nosotros" class="fw-bold">Quiénes Somos</a>
                    <a href="#" class="btn-fge btn-fge--donate">
                        <i class="bi bi-heart-fill"></i> Doná Online
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ORGANISMO: Hero Principal -->
    <section class="hero-fge">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>Fortalecemos el desarrollo comunitario</h1>
                    <p class="lead text-muted">
                        Acompañamos a organizaciones sociales en Argentina, Chile y Uruguay brindando herramientas para
                        su crecimiento sostenible y mejorando la calidad de vida en contextos vulnerables.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#" class="btn-fge btn-fge--action">
                            <i class="bi bi-hand-index-thumb-fill"></i> Sumate como voluntario
                        </a>
                        <a href="#" class="btn-fge btn-fge--outline">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Conoce la guía
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="p-4 text-center rounded-4"
                        style="background-color: var(--fge-color-purple-base); color: white;">
                        <i class="bi bi-people-fill display-1"></i>
                        <h3 class="text-white mt-3">+500 Niños y niñas</h3>
                        <p class="mb-0 text-white-50">Impactados positivamente mediante nuestros programas solidarios en
                            comedores de la red.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ORGANISMO: Grilla de Proyectos Destacados -->
    <main class="container mb-5" id="proyectos">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Proyectos y Programas Activos</h2>
                <p class="text-muted">Conoce algunas de las iniciativas que estamos impulsando junto a las comunidades.
                </p>
            </div>
        </div>

        <!-- Demostración de la grilla de Figma con 24px de gutter -->
        <div class="row g-4">
            <!-- Proyecto 1 -->
            <div class="col-md-6 col-lg-4">
                <article class="card-fge">
                    <div>
                        <span class="card-fge__tag card-fge__tag--green">Sostenibilidad</span>
                        <h3 class="card-fge__title">Reciclado y Medio Ambiente</h3>
                        <p class="card-fge__text">
                            Transformamos papel en desuso en insumos esenciales para el desarrollo de infraestructuras
                            comunitarias en los comedores de la red.
                        </p>
                    </div>
                    <a href="#" class="btn-fge btn-fge--primary mt-3">
                        Ver detalle <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            <!-- Proyecto 2 -->
            <div class="col-md-6 col-lg-4">
                <article class="card-fge">
                    <div>
                        <span class="card-fge__tag card-fge__tag--cyan">Infancias</span>
                        <h3 class="card-fge__title">Día de las Infancias Inolvidable</h3>
                        <p class="card-fge__text">
                            Llevamos alegría, juegos y alimentos para celebrar a más de 500 niños y niñas participantes
                            de nuestros talleres de arte e inclusión.
                        </p>
                    </div>
                    <a href="#" class="btn-fge btn-fge--primary mt-3">
                        Ver detalle <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>

            <!-- Proyecto 3 -->
            <div class="col-md-6 col-lg-4">
                <article class="card-fge">
                    <div>
                        <span class="card-fge__tag card-fge__tag--green">Cultura</span>
                        <h3 class="card-fge__title">Subasta "Pinceladas de Futuro"</h3>
                        <p class="card-fge__text">
                            Un encuentro donde el arte se convierte en puente de oportunidades mediante la exposición de
                            obras hechas por chicos en comedores.
                        </p>
                    </div>
                    <a href="#" class="btn-fge btn-fge--primary mt-3">
                        Ver detalle <i class="bi bi-arrow-right"></i>
                    </a>
                </article>
            </div>
        </div>
    </main>

    <!-- ORGANISMO: Footer -->
    <footer class="py-4 mt-5"
        style="background-color: var(--fge-color-brand-dark); color: var(--fge-color-neutral-400);">
        <div class="container text-center">
            <p class="mb-1">Fundación Gestionar Esperanzas &copy; 2025 - Todos los derechos reservados.</p>
            <small>Prototipo en construcción | BEM + Tokens CSS + Bootstrap 5.3 Override</small>
        </div>
    </footer>

    <!-- Bootstrap JS (opcional si usas componentes interactivos) -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>