<?php
/**
 * molecule: card-caso-org — tarjeta de caso de organización territorial
 * (variante de card-organizacion para page-que-hacemos: ratio 4x3, badge
 * de país, pie "Objetivos informados").
 * Contrato: $caso ← fge_consulta('casos', ['destacado' => true])[n]
 * keys: nombre, pais (slug → data/paises.php), historia, imagen ('' → placeholder).
 * 📐 Figma 478:2771: cards 410×450, tag de país arriba-izq del visual.
 * Regla país/activo: el badge solo se pinta si el país está activo
 * (fge_paises()); atrás quedan los futuros países de expansión.
 * Consumo (futuro WP): archive item del CPT `organizaciones` (flag destacado).
 */
$caso     = $caso ?? [];
$fge_base = fge_base();
$paises   = fge_paises();
$pais_activo = $paises[$caso['pais']] ?? null;
?>
<!-- molecule/card-caso-org -->
<article class="card h-100 border-light-subtle rounded-3 p-3 bg-white d-flex flex-column justify-content-between">
  <div>
    <div class="card-caso-org-fge__visual position-relative rounded ratio ratio-4x3 mb-3 border d-flex align-items-center justify-content-center">
      <?php if ($pais_activo) : ?>
        <span class="badge badge-fge--pais text-uppercase position-absolute top-0 start-0 m-2 fs-xxs"><?= htmlspecialchars($pais_activo['nombre']) ?></span>
      <?php endif; ?>
      <?php if (!empty($caso['imagen'])) : ?>
        <img src="<?= $fge_base ?>/<?= htmlspecialchars($caso['imagen']) ?>" class="w-100 h-100 object-fit-cover" alt="">
      <?php else: ?>
        <i class="bi bi-image text-secondary opacity-50" style="font-size: 32px;" aria-hidden="true"></i>
      <?php endif; ?>
    </div>
    <h3 class="fs-xs fw-bold text-brand-primary mb-2"><?= htmlspecialchars($caso['nombre']) ?></h3>
    <p class="fs-xxs lh-base text-secondary mb-3"><?= htmlspecialchars($caso['historia']) ?></p>
  </div>
  <div class="border-top pt-2 mt-auto">
    <span class="fs-xxs text-uppercase fw-semibold text-muted">Objetivos informados:</span>
  </div>
</article>
