<?php
/**
 * molecule: programa-fila — fila de programa/iniciativa (texto izq + imagen der)
 * Contrato: $programa ← fge_consulta('iniciativas')[n]
 * keys: categoria (chip badge), titulo, texto, chips [], imagen ('' →
 * placeholder), caso ['nombre','pais'] (línea "Caso destacado" del Figma),
 * campanias [] (línea uppercase del mockup para el programa donación).
 * 📐 Figma 478:2771: filas full-width 1280×286-384, contenido izq ~798px,
 * imagen 384×220 (≈16:9), chip categoría + Heading3 + chips outline.
 * Consumo (futuro WP): archive item del CPT `programas` (layout fila).
 */
$programa = $programa ?? [];
$fge_base = fge_base();
?>
<!-- molecule/programa-fila -->
<article class="programa-fila-fge card border-light-subtle rounded-3 p-4 bg-white shadow-sm">
  <div class="row align-items-center g-4">
    <div class="col-12 col-md-7">
      <span class="badge-fge badge-fge--soft fs-xxs fw-semibold px-2 py-1 rounded mb-2 d-inline-block">
        <?= htmlspecialchars($programa['categoria']) ?>
      </span>
      <h3 class="h6 fw-bold text-brand-primary mb-2">
        <?= htmlspecialchars($programa['titulo']) ?>
      </h3>
      <p class="fs-xs lh-base text-secondary mb-3">
        <?= htmlspecialchars($programa['texto']) ?>
      </p>
      <?php if (!empty($programa['campanias'])) : ?>
        <p class="fs-xxs text-uppercase fw-bold text-brand-primary tracking-wider mb-1">
          Campañas permanentes y estacionales:
        </p>
        <?php foreach ($programa['campanias'] as $campania) : ?>
          <p class="fs-xxs text-muted mb-2"><?= htmlspecialchars($campania) ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php if (!empty($programa['caso'])) : ?>
        <div class="d-flex align-items-center gap-2">
          <span class="fs-xs fw-semibold text-brand-primary">Caso destacado: <?= htmlspecialchars($programa['caso']['nombre']) ?></span>
          <span class="badge-fge badge-fge--pais text-uppercase fs-xxs fw-bold"><?= htmlspecialchars($programa['caso']['pais']) ?></span>
        </div>
      <?php endif; ?>
      <?php if (!empty($programa['chips'])) : ?>
        <div class="d-flex flex-wrap gap-2 fs-xxs text-secondary">
          <?php foreach ($programa['chips'] as $chip) : ?>
            <span class="programa-fila-fge__chip border rounded px-2 py-1"><?= htmlspecialchars($chip) ?></span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-12 col-md-5">
      <?php if (!empty($programa['imagen'])) : ?>
        <div class="rounded overflow-hidden ratio ratio-16x9">
          <img src="<?= $fge_base ?>/<?= htmlspecialchars($programa['imagen']) ?>" class="w-100 h-100 object-fit-cover" alt="">
        </div>
      <?php else: ?>
        <div class="programa-fila-fge__imagen rounded d-flex align-items-center justify-content-center ratio ratio-16x9 border">
          <i class="bi bi-image text-secondary opacity-50 d-flex align-items-center justify-content-center" style="font-size: 32px;" aria-hidden="true"></i>
        </div>
      <?php endif; ?>
    </div>
  </div>
</article>
