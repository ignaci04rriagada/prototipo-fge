<?php
/**
 * organism: topbar-paises (GLOBAL — todas las páginas)
 * Consumo: data/paises.php (términos de taxonomía pais)
 * Dropdown real Bootstrap (data-bs-toggle="dropdown"): cada país envía a
 * el molde page-pais.php?pais=slug  |  En WP: get_terms('pais') + archive-pais.
 * Cuidado CSS: dropdown del topbar con z-index sobre el navbar sticky.
 */
$paises   = fge_paises();
$fge_base = fge_base();
?>
<!-- organism/topbar-paises (dropdown funcional) -->
<div class="bg-purple-950 text-white py-1 fge-topbar-paises">
  <div class="container d-flex justify-content-end align-items-center">
    <div class="dropdown">
      <a href="#" class="fge-topbar-paises__toggle text-decoration-none d-flex align-items-center gap-1 fs-xs" id="fgeDropdownPaises" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span>Selecciona un país</span>
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
          <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
        </svg>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="fgeDropdownPaises">
        <?php foreach ($paises as $pais_data): ?>
        <li>
          <a class="dropdown-item fs-xs" href="<?= $fge_base ?>/pages/page-pais.php?pais=<?= urlencode($pais_data['slug']) ?>">
            <?= htmlspecialchars($pais_data['nombre']) ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
