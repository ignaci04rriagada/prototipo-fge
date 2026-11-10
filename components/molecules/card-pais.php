<?php
/**
 * molecule: card-pais — tarjeta de acceso a página país (home)
 * Contrato: $pais slab ← data/paises.php[key] (futuro: get_terms pais)
 * keys usadas: nombre, slug. Enlace → la charla WP: archive-pais.
 */
$pais = $pais ?? null;
$fge_base = fge_base();
?>
<!-- molecule/card-pais -->
<article class="bg-neutral-200 rounded-3 p-3 flex-fill d-flex flex-column justify-content-between min-vh-20">
  <h3 class="m-0 align-self-start">
    <a href="<?= fge_url_pais($pais['slug']) ?>" class="badge bg-purple-950 fw-semibold fs-xxs text-decoration-none" aria-label="Abrir página de <?= htmlspecialchars($pais['nombre']) ?>">
      <?= htmlspecialchars($pais['nombre']) ?>
    </a>
  </h3>
  <a href="<?= $fge_base ?>/pages/page-pais.php?pais=<?= urlencode($pais['slug']) ?>" class="d-flex justify-content-center align-items-center text-secondary py-4 text-decoration-none" aria-label="Ir a <?= htmlspecialchars($pais['nombre']) ?>">
    <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"></path>
    </svg>
  </a>
</article>
