<?php
/**
 * organism: navbar-fge (GLOBAL — todas las páginas)
 * Consumo: $menu ← data/menu.php (futuro: wp_nav_menu 'menu-superior' +
 * walker Bootstrap 5 — assets/templates/navs/ del tema).
 * Parámetros: $ancla (bool) → si true, los href se transforman en URLs
 * de páginas (page-*), si false quedan anclas para la landing.
 */
$menu   = fge_datos('menu');
$ancla  = $ancla ?? false; // default: enlaces a páginas reales (multi-page)
$fge_base = fge_base();

// Resolución de hrefs (data/menu.php declara RUTAS REALES de páginas):
// rutas relativas → absolutas con fge_base(); las anclas (#...) quedan tal
// cual (contextos one-pager/$ancla=true). Con las 8 páginas maquetadas
// ningún enlace de navegación queda roto.
$fge_href = function ($href) use ($ancla) {
    if ($ancla || $href === '#' || str_starts_with($href, 'http')) {
        return $href;
    }
    return fge_base() . '/' . ltrim($href, '/');
};
?>
<!-- organism/navbar-fge -->
<header class="bg-white border-bottom sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light py-3" aria-label="Navegación principal">
    <div class="container">

      <!-- Logo (futuro: the_custom_logo() sobre markup Bootstrap) -->
      <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $fge_base ?>/pages/page-home.php">
        <svg width="32" height="32" class="text-brand-primary" fill="currentColor" viewBox="0 0 24 24" role="img" aria-label="Logo Fundación">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
        </svg>
        <div class="d-flex flex-column lh-1">
          <span class="fw-bold text-muted text-uppercase fs-xxs tracking-wider">FUNDACIÓN</span>
          <span class="fw-black text-brand-primary text-uppercase fs-6 tracking-tight">GESTIONAR</span>
          <span class="fw-bold text-brand-primary text-uppercase fs-xxs tracking-wider">ESPERANZAS</span>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir menú de navegación">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
        <ul class="navbar-nav align-items-lg-center gap-lg-3">
          <?php foreach ($menu['items'] as $item) : ?>
          <li class="nav-item">
            <a class="nav-link-fge fs-xs" href="<?= $fge_href($item['href']) ?>"><?= htmlspecialchars($item['texto']) ?></a>
          </li>
          <?php endforeach; ?>
          <li class="nav-item ms-lg-2">
            <a class="btn-fge btn-fge--primary rounded-pill px-4 btn-sm fw-bold fs-xs" href="<?= $fge_href($menu['donar']['href']) ?>">
              <?= htmlspecialchars($menu['donar']['texto']) ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
