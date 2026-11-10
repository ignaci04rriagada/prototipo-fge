<?php
/**
 * organism: footer-fge (GLOBAL — todas las páginas)
 * Consumo: data/menu.php, data/paises.php
 * ⚠️ CONTRA WP: las 3 columnas (Navegación, Transparencia, Contacto) son
 * contenido administrable → en el tema serán dynamic_sidebar()
 * sobre zonas 'footer_navegacion' / 'footer_transparencia' /
 * 'footer_contacto' (ver widgets-functions del tema).
 * El logo/branding + legal son marhandles estructurales (quedan en markup).
 */
$menu       = fge_datos('menu');
$fge_base   = fge_base();
?>
<!-- organism/footer-fge -->
<footer class="bg-purple-950 text-white pt-5 pb-4">
  <div class="container">
    <div class="row g-4 pb-4">

      <!-- Info Branding (estructural) -->
      <div class="col-12 col-md-3">
        <div class="d-flex align-items-center gap-2 mb-3">
          <svg width="24" height="24" class="text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
          </svg>
          <div class="d-flex flex-column lh-1">
            <span class="fw-bold text-white-50 text-uppercase fs-xxs">FUNDACIÓN</span>
            <span class="fw-black text-white text-uppercase fs-6">GESTIONAR</span>
            <span class="fw-bold text-white text-uppercase fs-xxs">ESPERANZAS</span>
          </div>
        </div>
        <p class="fs-xxs text-white-50">
          Esto es un párrafo pequeño para acompañar el logo de arriba y entregar un mensaje.
        </p>
      </div>

      <!-- Zona: Navegación (futuro widget / menú) -->
      <div class="col-12 col-md-3">
        <h2 class="fs-xs fw-bold text-white mb-3">Navegación</h2>
        <ul class="list-unstyled fs-xs d-flex flex-column gap-2 m-0">
          <li><a href="<?= $fge_base ?>/pages/page-home.php" class="footer-fge__link text-decoration-none">Inicio</a></li>
          <li><a href="#" class="footer-fge__link text-decoration-none">Selecciona un país</a></li>
          <li><a href="#" class="footer-fge__link text-decoration-none">Qué hacemos</a></li>
          <li><a href="#" class="footer-fge__link text-decoration-none">Involúcrate</a></li>
        </ul>
      </div>

      <!-- Zona: Transparencia (futuro widget / menú) -->
      <div class="col-12 col-md-3">
        <h2 class="fs-xs fw-bold text-white mb-3">Transparencia</h2>
        <ul class="list-unstyled fs-xs d-flex flex-column gap-2 m-0">
          <li><a href="#" class="footer-fge__link text-decoration-none">Gobernanza y Directorio</a></li>
          <li><a href="<?= $fge_base ?>/pages/page-transparencia.php" class="footer-fge__link text-decoration-none">Memorias anuales</a></li>
          <li><a href="#" class="footer-fge__link text-decoration-none">Impacto</a></li>
          <li><a href="<?= $fge_base ?>/pages/page-transparencia.php" class="footer-fge__link text-decoration-none">Informe financiero</a></li>
        </ul>
      </div>

      <!-- Zona: Contacto (futuro widget) -->
      <div class="col-12 col-md-3">
        <h2 class="fs-xs fw-bold text-white mb-3">Contacto</h2>
        <p class="fs-xs m-0">
          <a href="mailto:alianzas@gestionaresperanzas.com" class="footer-fge__link text-decoration-none">
            alianzas@gestionaresperanzas.com
          </a>
        </p>
      </div>
    </div>

    <!-- Legal / Copyright -->
    <div class="border-top border-secondary pt-3 d-flex flex-column flex-sm-row justify-content-between align-items-center fs-xxs text-white-50">
      <div>
        © <?= date('Y') ?> Fundación Gestionar Esperanzas. Todos los derechos reservados.
      </div>
      <div class="mt-2 mt-sm-0">
        <a href="#" class="footer-fge__link text-decoration-none">Política de Privacidad</a> |
        <a href="#" class="footer-fge__link text-decoration-none">Términos de Uso</a> |
        <a href="#" class="footer-fge__link text-decoration-none">Tratamiento de Datos</a>
      </div>
    </div>
  </div>
</footer>
