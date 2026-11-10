<?php
/**
 * page: page-transparencia — Transparencia (Template Name: Transparencia en WP)
 * Fuente de diseño combinada (10/11/2026):
 *   - transparencia.html (mockup del compañero): TABS POR PAÍS para Informes
 *     y Memorias — el diseño estructural preferido por el cliente.
 *   - Figma 478:3987 (MCP): hero (H1 purple-800 + imagen 606×354), banner CTA
 *     purple-900 con 2 acciones, tipografía de headings.
 * 🔑 Regla de DIRECTORIO: el cliente administra por documento país, año y
 *    archivo (ver data/posts-transparencia.php) — los tabs se generan de
 *    data/paises.php y los paneles se llenan según lo subido.
 * Consultas → WP: CPT `transparencia` (tax tipo_documento + pais) + CPT `equipo`.
 */
require __DIR__ . '/../bootstrap.php';

$hero = ['titulo' => 'Transparencia',
         'texto'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ipsum est, molestie non varius ut, finibus sit amet dolor. Aliquam id finibus mauris.',
         'imagen' => 'assets/img/bg-transparencia.jpg'];
$equipo   = fge_consulta('equipo');

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main>
  <?php include __DIR__ . '/../components/organisms/hero-simple.php'; ?>

  <?php
  fge_componente('molecules/tabs-documentos', ['config' => [
      'id'         => 'informes',
      'titulo'     => 'Informes financieros',
      'tipo'       => 'informes_financieros',
      'etiqueta'   => 'Informe financiero',
      'documentos' => fge_consulta('transparencia', ['tipo' => 'informes_financieros']),
  ]]);

  fge_componente('molecules/tabs-documentos', ['config' => [
      'id'         => 'memorias',
      'titulo'     => 'Memorias',
      'tipo'       => 'memorias',
      'etiqueta'   => 'Memoria anual',
      'documentos' => fge_consulta('transparencia', ['tipo' => 'memorias']),
  ]]);

  fge_componente('molecules/banner-cta', [
      'cta' => ['titulo' => 'Involúcrate', 'fondo' => 'navy', 'acciones' => [
          ['texto' => 'Como empresa', 'href' => '#', 'estilo' => 'principal'],
          ['texto' => 'Donación única', 'href' => '#', 'estilo' => 'secundario'],
      ]],
  ]);
  ?>

  <section class="container py-4 pb-5">
    <h2 class="h2 fw-semibold text-brand-primary text-center mb-4">Gobernanza</h2>
    <div class="row g-4">
      <?php foreach ($equipo as $directivo) : ?>
        <div class="col-12 col-md-4">
          <?php fge_componente('molecules/card-directivo', ['directivo' => $directivo]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
