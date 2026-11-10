<?php
/**
 * organism: mapa-ubicacion — sección "Donde encontrarnos" (page-que-hacemos)
 * 📐 Figma 478:2771 sección mapa (MCP): container 1280 (legible del design
 * context), heading del tamaño del sistema + captura/recuadro del mapa
 * como imagen. Hoy: placeholder (la captura real va en
 * assets/img/mapa-ubicacion.jpg cuando la defina el cliente).
 * Contrato: $mapa keys opcionales: titulo, imagen, alt.
 * Consumo (futuro WP): block SCF tipo embed/map con dirección del centro.
 */
$mapa = $mapa ?? [];
$fge_base = fge_base();
?>
<!-- organism/mapa-ubicacion -->
<section class="mapa-ubicacion-fge container pb-5">
  <h2 class="h2 fw-semibold text-brand-primary mb-3">
    <?= htmlspecialchars($mapa['titulo'] ?? 'Donde encontrarnos') ?>
  </h2>
  <div class="mapa-ubicacion-fge__visual rounded overflow-hidden ratio ratio-21x9 border d-flex align-items-center justify-content-center" style="min-height: 300px;">
    <?php if (!empty($mapa['imagen']) && file_exists(__DIR__ . '/../../assets/img/' . $mapa['imagen'])) : ?>
      <img src="<?= $fge_base ?>/assets/img/<?= htmlspecialchars($mapa['imagen']) ?>" class="w-100 h-100 object-fit-cover" loading="lazy" alt="<?= htmlspecialchars($mapa['alt'] ?? '') ?>">
    <?php else: ?>
      <div class="px-4">
        <i class="bi bi-image text-secondary opacity-50 d-flex align-items-center justify-content-center h-100" style="font-size: 56px;" aria-hidden="true"></i>
      </div>
    <?php endif; ?>
  </div>
</section>
