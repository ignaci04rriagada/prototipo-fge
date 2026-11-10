<?php
/**
 * molecule: paso-proceso — tarjeta numerada de un proceso (paso 01-04)
 * Contrato: $paso keys: n (número visual), titulo, detalle.
 * 📐 alianzas.html / Figma 478:3634 se "Proceso": cards sin borde, número
 * grande arriba (normalizado: los 4 colores de paso del mockup eran
 * danger/info/success → morado marca).
 * Consumo (futuro WP): post type `paso` (menu_order).
 */
$paso = $paso ?? [];
?>
<!-- molecule/paso-proceso -->
<article class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white">
  <span class="paso-proceso-fge__numero h4 fw-bold mb-2 d-block"><?= htmlspecialchars($paso['n']) ?></span>
  <h3 class="fs-xs fw-bold text-brand-primary mb-2"><?= htmlspecialchars($paso['titulo']) ?></h3>
  <p class="fs-xxs text-secondary lh-base m-0"><?= htmlspecialchars($paso['detalle']) ?></p>
</article>
