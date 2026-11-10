<?php
/**
 * molecule: card-organizacion — tarjeta de organización territorial
 * Contrato: $org ← fge_consulta('organizaciones', ['pais' => $slug])[n]
 * keys: nombre ( admite <br> en mockup → nl2br), tipo_servicio,
 * en_riesgo (badge Alerta + borde danger), imagen ('' → placeholder),
 * url.
 * Futuro: la condición "en_riesgo" la define la CAMPAÑA activa vinculada
 * (campanas_alertas.organizacion_vinculada), no un flag manual.
 */
$org = $org ?? null;
$fge_base = fge_base();
?>
<!-- molecule/card-organizacion -->
<article class="card h-100 <?= $org['en_riesgo'] ? 'border-danger' : 'border-light-subtle' ?> rounded-1 overflow-hidden">
  <div class="bg-brand-gray ratio ratio-16x9 position-relative d-flex align-items-center justify-content-center">
    <span class="position-absolute top-0 start-0 m-2 fs-xxs text-secondary fw-medium">Programa</span>
    <?php if (!empty($org['imagen'])) : ?>
      <img src="<?= $fge_base ?>/<?= htmlspecialchars($org['imagen']) ?>" class="img-fluid" alt="">
    <?php else: ?>
      <svg width="32" height="32" class="text-secondary opacity-50 position-absolute top-50 start-50 translate-middle" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"></path>
      </svg>
    <?php endif; ?>
  </div>
  <div class="card-body d-flex flex-column justify-content-between p-3">
    <div>
      <?php if (!empty($org['en_riesgo'])) : ?>
        <span class="badge bg-danger rounded-1 fs-xxs mb-1">Alerta</span>
      <?php endif; ?>
      <h3 class="fs-xs fw-bold text-dark mb-1 lh-sm"><?= nl2br(htmlspecialchars($org['nombre'])) ?></h3>
      <p class="fs-xxs text-muted mb-3"><?= htmlspecialchars($org['tipo_servicio']) ?></p>
    </div>
    <div>
      <a href="<?= htmlspecialchars($org['url']) ?>" class="btn btn-outline-secondary btn-sm fs-xxs rounded px-3 py-1">Leer más</a>
    </div>
  </div>
</article>
