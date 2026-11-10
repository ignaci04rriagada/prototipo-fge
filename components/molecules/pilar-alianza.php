<?php
/**
 * molecule: pilar-alianza — tarjeta de pilar de colaboración corporativa
 * Contrato: $pilar keys: nombre, eyebrow (etiqueta uppercase "01/CAPACIDADES"
 * — la numeración se agrega en el markup del loop), descripcion.
 * Normalización: eyebrow del mockup en success/info → morado marca.
 * Consumo (futuro WP): term card de taxonomía `pilar_alianza`.
 */
$pilar = $pilar ?? [];
$i     = $i ?? 0;
?>
<!-- molecule/pilar-alianza -->
<article class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white">
  <span class="pilar-alianza-fge__eyebrow fs-xxs fw-bold text-uppercase tracking-wider mb-2 d-block">
    <?= sprintf('%02d', $i + 1) ?> / <?= htmlspecialchars($pilar['eyebrow']) ?>
  </span>
  <h3 class="fs-xs fw-bold text-brand-primary mb-2"><?= htmlspecialchars($pilar['nombre']) ?></h3>
  <p class="fs-xxs text-secondary lh-base m-0"><?= htmlspecialchars($pilar['descripcion']) ?></p>
</article>
