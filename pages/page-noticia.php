<?php
/**
 * page: page-noticia — Noticia individual (Template Name: Noticia en WP)
 * Fuente: nooticia.html del compañero (breadcrumb → tag → encabezado →
 * figure 21:9 → cuerpo+blockquote → sidebar "En esta noticia" →
 * relacionadas). El encabezado de artículo usa hero-simple (el único de
 * las internas) y lo precede el breadcrumb + badge de categoría.
 * ⚙️ Prototipo: single por ?id=<id> — en WP: single.post.
 * Consultas → WP: post nativo, relaciones tax pais/programa, destacadas 3.
 */
require __DIR__ . '/../bootstrap.php';

$todas = fge_consulta('noticias');
$id_n  = (int) ($_GET['id'] ?? 0);
$noticia = $todas[$id_n] ?? null;

// fallback elegante: id inexistente → primera noticia con contenido
if (!$noticia) {
    foreach ($todas as $snippet) if (!empty($snippet['secciones'])) { $noticia = $snippet; break; }
}
if (!$noticia) { $noticia = $todas[0]; }

$paises_not  = fge_paises();
$pais_notica = $noticia['pais'] ? ($paises_not[$noticia['pais']] ?? null) : null;
$relacionadas = array_values(array_filter($todas, fn ($n) => !empty($n['secciones']) && $n['id'] !== $noticia['id']));
$relacionadas = array_slice($relacionadas, 0, 3);

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="Miga de pan" class="mb-3">
    <ol class="breadcrumb fs-xs text-secondary mb-0">
      <li class="breadcrumb-item"><a href="<?= fge_base() ?>/pages/page-home.php" class="text-decoration-none text-secondary">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= fge_base() ?>/pages/page-noticias.php" class="text-decoration-none text-secondary">Noticias</a></li>
      <li class="breadcrumb-item active text-muted" aria-current="page"><?= htmlspecialchars($noticia['titulo']) ?></li>
    </ol>
  </nav>

  <!-- Categoría / tag del artículo (WP nativo) -->
  <div class="mb-2">
    <span class="badge badge-fge--soft text-uppercase fw-semibold fs-xxs px-2 py-1 rounded-1">Comunidad</span>
  </div>

  <?php
  // HERO ÚNICO de las internas: H1 + extracto izq + imagen der (fge-consistente)
  $hero = ['titulo' => $noticia['titulo'],
           'texto'  => $noticia['subtitulo'],
           'imagen' => $noticia['imagen']];
  include __DIR__ . '/../components/organisms/hero-simple.php';
  ?>

  <!-- Metadata del artículo -->
  <div class="fs-xxs text-muted d-flex flex-wrap align-items-center gap-2 mb-4">
    <span class="fw-medium text-dark">Equipo de Comunicación FGE</span>
    <span>|</span>
    <span><?= htmlspecialchars(date('j \d\e F \d\e Y', strtotime($noticia['fecha'] ?? 'now'))) ?></span>
    <span>|</span>
    <span><?= (int) ($noticia['tiempo_lectura'] ?? 3) ?> min de lectura</span>
  </div>

  <!-- Figure principal 21:9 -->
  <figure class="mb-5">
    <div class="ratio ratio-21x9 rounded overflow-hidden mapa-ubicacion-fge__visual" style="max-height: 440px;">
      <?php if (!empty($noticia['imagen'])) : ?>
        <img src="<?= fge_base() ?>/<?= htmlspecialchars($noticia['imagen']) ?>" class="object-fit-cover w-100 h-100" alt="">
      <?php else: ?>
        <i class="bi bi-image text-secondary opacity-50 d-flex align-items-center justify-content-center" style="font-size: 56px;" aria-hidden="true"></i>
      <?php endif; ?>
    </div>
    <figcaption class="d-flex justify-content-between fs-xxs text-muted mt-2 px-1">
      <span>Imagen de muestra: espacio para la fotografía de la noticia.</span>
      <span><?= $noticia['credito_foto'] ? 'Crédito: ' . htmlspecialchars($noticia['credito_foto']) : '' ?></span>
    </figcaption>
  </figure>

  <div class="row g-4 g-lg-5 align-items-start mb-5 articulo-noticia-fge">
    <article class="col-12 col-lg-8 fs-xs text-secondary lh-lg">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

      <?php foreach (($noticia['secciones'] ?? []) as $seccion) : ?>
        <h2 class="h5 fw-bold text-brand-primary mt-4 mb-2"><?= htmlspecialchars($seccion['titulo']) ?></h2>
        <p class="mb-4"><?= htmlspecialchars($seccion['texto']) ?></p>

        <?php if (!empty($noticia['cita']) && $seccion === ($noticia['secciones'][0] ?? null)) : ?>
          <figure class="my-4 ps-3 border-start border-3">
            <blockquote class="blockquote fs-xs text-dark fst-italic mb-1">
              "<?= htmlspecialchars($noticia['cita']['texto']) ?>"
            </blockquote>
            <figcaption class="blockquote-footer fs-xxs text-muted mb-0"><?= htmlspecialchars($noticia['cita']['autor']) ?></figcaption>
          </figure>
        <?php endif; ?>
      <?php endforeach; ?>

      <!-- Compartir -->
      <div class="pt-4 border-top mt-5">
        <h2 class="fs-xs fw-bold text-brand-primary mb-3">Comparte esta noticia</h2>
        <div class="d-flex flex-wrap align-items-center gap-2">
          <button type="button" class="btn btn-outline-secondary btn-sm fs-xxs px-3 py-1"><i class="bi bi-whatsapp"></i> WhatsApp</button>
          <button type="button" class="btn btn-outline-secondary btn-sm fs-xxs px-3 py-1"><i class="bi bi-facebook"></i> Facebook</button>
          <button type="button" class="btn btn-outline-secondary btn-sm fs-xxs px-3 py-1"><i class="bi bi-link-45deg"></i> Copiar enlace</button>
        </div>
      </div>
    </article>

    <!-- Sidebar: en esta noticia -->
    <aside class="col-12 col-lg-4 ps-lg-4">
      <div class="border-start ps-3 py-1" style="border-color: var(--fge-color-border-subtle) !important;">
        <h2 class="fs-xs fw-bold text-brand-primary mb-2">En esta noticia</h2>
        <ul class="list-unstyled fs-xxs d-flex flex-column gap-1 m-0">
          <?php foreach (($noticia['secciones'] ?? []) as $seccion_toc) : ?>
            <li><a href="#" class="text-secondary text-decoration-none"><?= htmlspecialchars($seccion_toc['titulo']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>
  </div>

  <!-- Relacionadas -->
  <section class="border-top pt-5 pb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="h5 fw-bold text-brand-primary m-0">Sigue conociendo nuestras historias</h2>
      <a href="<?= fge_base() ?>/pages/page-noticias.php" class="btn btn-outline-secondary btn-sm fs-xxs px-3 py-1">Ver todas las noticias</a>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($relacionadas as $rel) : ?>
        <div class="col">
          <?php fge_componente('molecules/card-noticia', ['noticia' => $rel]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
