<?php
/**
 * molecule: card-destacada — noticia destacada del home (carrusel)
 * Contrato: $noticia ← fge_consulta('noticias', ['destacado' => true])[0]
 * keys usadas: titulo, imagen ('' → placeholder), url.
 */
$noticia = $noticia ?? null;
?>
<!-- molecule/card-destacada -->
<article class="bg-neutral-200 rounded-3 p-4 p-md-5 position-relative d-flex flex-column justify-content-between flex-grow-1 min-vh-40">
  <div class="position-absolute top-0 end-0 p-4 d-flex gap-2" role="group" aria-label="Controles del carrusel">
    <span class="bg-purple-950 rounded-circle d-inline-block" style="width: 10px; height: 10px;"></span>
    <span class="border border-secondary rounded-circle d-inline-block" style="width: 10px; height: 10px;"></span>
    <span class="border border-secondary rounded-circle d-inline-block" style="width: 10px; height: 10px;"></span>
    <span class="border border-secondary rounded-circle d-inline-block" style="width: 10px; height: 10px;"></span>
  </div>

  <div class="my-auto pt-4 max-w-lg">
    <div class="mb-3 text-secondary">
      <?php if (!empty($noticia['imagen'])) : ?>
        <img src="<?= $fge_base ?>/<?= htmlspecialchars($noticia['imagen']) ?>" class="img-fluid rounded" alt="">
      <?php else: ?>
        <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24" role="img" aria-label="Ícono de imagen">
          <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"></path>
        </svg>
      <?php endif; ?>
    </div>
    <h2 class="h2 fw-extrabold text-brand-primary tracking-tight mb-4">
      <?= htmlspecialchars($noticia['titulo']) ?>
    </h2>
    <a href="<?= htmlspecialchars($noticia['url']) ?>" class="btn-fge btn-fge--primary btn-sm fw-semibold rounded px-3">Ver más</a>
  </div>
</article>
