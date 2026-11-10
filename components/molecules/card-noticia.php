<?php
/**
 * molecule: card-noticia — tarjeta de grilla de noticias (reutilizable)
 * Contrato: $noticia ← fge_consulta('noticias', [...])[n]
 * keys: titulo, fecha, extracto/subtitulo, pais (→ badge nombre), imagen,
 * url. Usada por: page-pais, noticia-grilla (futura), archive-noticias.
 */
$noticia = $noticia ?? null;
$fge_base = fge_base();
$paises = fge_datos('paises');
$nombre_pais = $noticia['pais'] ? ($paises[$noticia['pais']]['nombre'] ?? '') : '';
$fecha_es = date('m/Y', strtotime($noticia['fecha'] ?? 'now'));
?>
<!-- molecule/card-noticia -->
<article class="card h-100 border-light-subtle rounded-1 overflow-hidden">
  <div class="position-relative">
    <div class="bg-neutral-200 ratio ratio-16x9 d-flex align-items-center justify-content-center">
      <?php if (!empty($noticia['imagen'])) : ?>
        <img src="<?= $fge_base ?>/<?= htmlspecialchars($noticia['imagen']) ?>" class="img-fluid" alt="">
      <?php else: ?>
        <i class="bi bi-image text-secondary opacity-50 d-flex align-items-center justify-content-center" style="font-size: 32px;" aria-hidden="true"></i>
      <?php endif; ?>
    </div>
    <?php if ($nombre_pais) : ?>
      <!-- badge FUERA del ratio: Bootstrap .ratio > * fuerza width/height 100%
           a todo hijo directo — el badge se estiraría a todo el visual -->
      <a href="<?= fge_url_pais($noticia['pais']) ?>" class="badge badge-fge--pais position-absolute top-0 start-0 m-2 fs-xxs text-decoration-none" aria-label="Noticias de <?= htmlspecialchars($nombre_pais) ?>">
        <?= htmlspecialchars($nombre_pais) ?>
      </a>
    <?php endif; ?>
    <?php if (!empty($noticia['linea_programa'])) : ?>
      <span class="badge badge-fge--soft rounded-pill position-absolute bottom-0 start-0 ms-2 mb-2 fs-xxs border border-light-subtle" style="translate: 0 50%;">
        <?= htmlspecialchars($noticia['linea_programa']) ?>
      </span>
    <?php endif; ?>
  </div>
  <div class="card-body d-flex flex-column justify-content-between p-3">
    <div>
      <h3 class="fs-xs fw-bold text-brand-primary mb-1"><?= htmlspecialchars($noticia['titulo']) ?></h3>
      <p class="fs-xxs text-secondary lh-base mb-3"><?= htmlspecialchars($noticia['subtitulo'] ?? '') ?></p>
    </div>
    <div class="d-flex align-items-center justify-content-between mt-auto">
      <span class="fs-xxs text-muted"><?= htmlspecialchars($fecha_es) ?></span>
      <a href="<?= htmlspecialchars($noticia['url']) ?>" class="btn btn-outline-secondary btn-sm fs-xxs rounded px-3 py-1">Leer más</a>
    </div>
  </div>
</article>
