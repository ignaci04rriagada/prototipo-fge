<?php
/**
 * organism: hero-simple — hero texto-izq / imagen-der (páginas internas)
 * Contrato: $hero keys: titulo, texto, imagen (ruta relativa de assets, '' →
 * placeholder), cta (OPCIONAL: ['texto' => ..., 'href' => ...] — Figma
 * 478:2773 Página-Qué hacemos pide CTA fucsia "Explorar nuestros programas";
 * páginas que no lo llevan simplemente no definen la key).
 * 📐 Figma 478:3989 (MCP): H1 Outfit Bold 47.78/56 purple-800 (= token
 *    --fge-font-size-5xl) · párrafo Lato 16/24 #616161 · imagen 606×354
 *    en columna derecha · gap 24 · alineación vertical centrada.
 * Diferencia con hero-pais: hero-pais es MOLDE de país (CTA + contrato
 * de término); este es el hero genérico de página interna sin CTA.
 * Consumo (futuro WP): template-part hero de los page templates internos.
 */
$hero = $hero ?? [];
?>
<!-- organism/hero-simple -->
<section class="container py-5">
  <div class="row align-items-center g-4">
    <div class="col-12 col-md-6">
      <h1 class="fw-bold text-brand-purple-800 mb-3" style="max-width: 540px;">
        <?= htmlspecialchars($hero['titulo']) ?>
      </h1>
      <p class="fs-xs lh-base m-0" style="max-width: 540px; color: var(--fge-color-text-muted);">
        <?= htmlspecialchars($hero['texto']) ?>
      </p>
      <?php if (!empty($hero['cta'])) : ?>
        <a href="<?= htmlspecialchars($hero['cta']['href'] ?? '#') ?>"
           class="btn-fge btn-fge--primary btn-sm rounded-pill d-inline-flex align-items-center gap-2 mt-4">
          <span><?= htmlspecialchars($hero['cta']['texto']) ?></span>
          <span aria-hidden="true">+</span>
        </a>
      <?php endif; ?>
    </div>
    <div class="col-12 col-md-6">
      <?php if (!empty($hero['imagen'])) : ?>
        <div class="rounded ratio ratio-16x9 overflow-hidden">
          <img src="<?= fge_base() ?>/<?= htmlspecialchars($hero['imagen']) ?>" class="w-100 h-100 object-fit-cover" alt="">
        </div>
      <?php else: ?>
        <div class="bg-brand-gray rounded d-flex align-items-center justify-content-center ratio ratio-16x9">
          <i class="bi bi-image text-secondary opacity-50" style="font-size: 48px;" aria-hidden="true"></i>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
