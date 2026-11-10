<?php
/**
 * molecule: banner-cta — banda CTA sólida
 * Contrato: $cta keys: titulo, texto, href, fondo ('navy'|'purple-banner'|'cyan'|'green-banner')
 *   — o `acciones` => [['texto','href','estilo' ('principal'|'secundario')...]]
 *   para multicTA (Figma Transparencia: principal rosado + secundario outline,
 *   ¡tical mismas clases del design system).
 * Reutilizable: home (navy) · page-pais (×3: purple-banner, cyan, green-banner)
 *   · page-transparencia (navy, 2 acciones).
 */
$cta = $cta ?? [];
$fondo = $cta['fondo'] ?? 'navy';
$acciones = $cta['acciones'] ?? null;
if ($acciones === null) {
    // Back-compat: contrato antiguo de una sola acción.
    $acciones = [['texto' => $cta['texto'] ?? 'Ver más', 'href' => $cta['href'] ?? '#', 'estilo' => 'principal']];
}
?>
<!-- molecule/banner-cta -->
<section class="bg-brand-<?= htmlspecialchars($fondo) ?> text-white py-3 my-4">
  <div class="container d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
    <h2 class="h4 fw-bold m-0"><?= htmlspecialchars($cta['titulo']) ?></h2>
    <div class="d-flex gap-3 flex-wrap">
      <?php foreach ($acciones as $accion) : ?>
        <a href="<?= htmlspecialchars($accion['href'] ?? '#') ?>"
          class="btn <?= ($accion['estilo'] ?? 'principal') === 'secundario' ? 'btn-outline-light' : 'btn-brand-fuchsia' ?> btn-sm px-4 fw-bold">
          <?= htmlspecialchars($accion['texto']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
