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
  <div class="bg-brand-gray ratio ratio-16x9 position-relative d-flex align-items-center justify-content-center">
    <?php if ($nombre_pais) : ?>
      <a href="<?= fge_url_pais($noticia['pais']) ?>" class="badge bg-brand-dark position-absolute top-0 start-0 m-2 fs-xxs rounded-1 text-decoration-none" aria-label="Noticias de <?= htmlspecialchars($nombre_pais) ?>">
        <?= htmlspecialchars($nombre_pais) ?>
      </a>
    <?php endif; ?>
    <?php if (!empty($noticia['imagen'])) : ?>
      <img src="<?= $fge_base ?>/<?= htmlspecialchars($noticia['imagen']) ?>" class="img-fluid" alt="">
    <?php else: ?>
      <svg width="32" height="32" class="text-secondary opacity-50 position-absolute top-50 start-50 translate-middle" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"></path>
      </svg>
    <?php endif; ?>
  </div>
  <div class="card-body d-flex flex-column justify-content-between p-3">
    <div>
      <h3 class="fs-xs fw-bold text-dark mb-1"><?= htmlspecialchars($noticia['titulo']) ?></h3>
      <p class="fs-xxs text-muted mb-2"><?= htmlspecialchars($fecha_es) ?></p>
      <p class="fs-xxs text-secondary mb-3"><?= htmlspecialchars($noticia['subtitulo'] ?? '') ?></p>
    </div>
    <div>
      <a href="<?= htmlspecialchars($noticia['url']) ?>" class="btn btn-outline-secondary btn-sm fs-xxs rounded px-3 py-1">Leer más</a>
    </div>
  </div>
</article>
