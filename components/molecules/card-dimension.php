<?php
/**
 * molecule: card-dimension — tarjeta de dimensión de fortalecimiento
 * Contrato: $dimension ← fge_datos('dimensiones')[slug]
 * keys: nombre (uppercase en CSS), descripcion, slug (→ icono futuro).
 * 📐 Figma 478:2771: 4 cards 302×358, gap 48 (row g-4 ~24px en Bootstrap,
 * se respeta la grilla Bootstrap), título uppercase semibold.
 * Normalización de color: el mockup usaba success/info/danger (colores
 * fuera de paleta) → familia morada de marca (charta del cliente).
 * Consumo (futuro WP): term template de taxonomía `dimension`.
 */
$dimension = $dimension ?? [];
?>
<!-- molecule/card-dimension -->
<article class="card-dimension-fge card h-100 border-light-subtle rounded-3 p-3 bg-white">
  <div class="card-dimension-fge__icono rounded-circle d-flex align-items-center justify-content-center mb-3">
    <i class="bi <?= htmlspecialchars($dimension['icono'] ?? 'bi-bookmark') ?>" style="font-size: 22px;" aria-hidden="true"></i>
  </div>
  <h3 class="card-dimension-fge__titulo fs-xs fw-bold text-uppercase tracking-wider mb-2">
    <?= htmlspecialchars($dimension['nombre']) ?>
  </h3>
  <p class="card-dimension-fge__texto fs-xxs lh-base m-0">
    <?= htmlspecialchars($dimension['descripcion']) ?>
  </p>
</article>
