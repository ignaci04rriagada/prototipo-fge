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
  <div class="position-relative">
    <div class="bg-neutral-200 ratio ratio-16x9 d-flex align-items-center justify-content-center">
      <?php if (!empty($org['imagen'])) : ?>
        <img src="<?= $fge_base ?>/<?= htmlspecialchars($org['imagen']) ?>" class="img-fluid" alt="">
      <?php else: ?>
        <i class="bi bi-image text-secondary opacity-50 d-flex align-items-center justify-content-center" style="font-size: 32px;" aria-hidden="true"></i>
      <?php endif; ?>
    </div>
    <!-- badge FUERA del ratio: Bootstrap .ratio > * fuerza width/height 100%
         a todo hijo directo — el badge se estiraría a todo el visual -->
    <span class="badge rounded-1 position-absolute top-0 start-0 m-2 fs-xxs text-secondary fw-medium">Programa</span>
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
