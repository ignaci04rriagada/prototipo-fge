<?php
/**
 * page: page-noticias — Grilla de Noticias (Template Name: Noticias en WP)
 * Fuente de diseño: noticia-grilla.html (estructura del compañero):
 * hero simple (el único de las internas) → sidebar de filtros + grilla 2 col.
 * ⚙️ Filters funcionales por query string (país, programa); respuesta
 * futura WP: archive-noticias con facets.
 * Consultas → WP: post nativo con tax pais/linea_programa/category.
 */
require __DIR__ . '/../bootstrap.php';

$hero = ['titulo' => 'Noticias',
         'texto'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ipsum est, molestie non varius ut, finibus sit amet dolor. Aliquam id finibus mauris.',
         'imagen' => ''];

$filtro_pais  = $_GET['pais'] ?? '';
$filtro_progr = $_GET['programa'] ?? '';
$filtros      = [];
if ($filtro_pais !== '') {
    $filtros['pais'] = $filtro_pais;
    if (!array_key_exists($filtro_pais, fge_paises())) $filtros['pais'] = fge_pais_slug(); // inactivo → fallback
}
if ($filtro_progr !== '') {
    $filtros['linea_programa'] = $filtro_progr;
}
$noticias = fge_consulta('noticias', $filtros);

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main>
  <?php include __DIR__ . '/../components/organisms/hero-simple.php'; ?>

  <section class="container pb-5">
    <div class="row g-4">
      <?php fge_componente('molecules/filtros-noticia'); ?>

      <div class="col-12 col-md-9">
        <?php if ($noticias) : ?>
          <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($noticias as $noticia_data) : ?>
              <div class="col">
                <?php fge_componente('molecules/card-noticia', ['noticia' => $noticia_data]); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="fs-xs text-muted">No hay noticias para este filtro todavía.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
