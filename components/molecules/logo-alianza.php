<?php
/**
 * molecule: logo-alianza — logo placeholder/real de la sección Alianzas
 * Contrato: $alianza ← fge_consulta('alianzas') → array con [logo, nombre, url_oficial]
 * logo='' → muestra ícono placeholder (igual que el mockup).
 */
$alianza = $alianza ?? null;
$fge_base = fge_base();
?>
<!-- molecule/logo-alianza -->
<div class="col" tabindex="0">
  <a href="<?= htmlspecialchars($alianza['url_oficial']) ?>" class="text-decoration-none">
    <div class="bg-neutral-200 rounded d-flex align-items-center justify-content-center text-secondary ratio ratio-1x1" title="<?= htmlspecialchars($alianza['nombre']) ?>">
      <?php if (!empty($alianza['logo'])) : ?>
        <img src="<?= $fge_base ?>/<?= htmlspecialchars($alianza['logo']) ?>" class="img-fluid p-3" alt="<?= htmlspecialchars($alianza['nombre']) ?>">
      <?php else: ?>
        <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"></path>
        </svg>
      <?php endif; ?>
    </div>
  </a>
</div>
