<?php
/**
 * page: page-alianzas — Alianzas corporativas (Template Name: Alianzas en WP)
 * Fuente de diseño: alianzas.html (estructura) + Figma 478:3634
 * "Página - Alianzas corporativas" (hero badge+H1+pilares = specs ya
 * mapeadas; form "Hablemos de tu empresa" container 680px).
 * Hero: reuso hero-single (el de todas las internas) con las keys
 * opcionales etiqueta ("ALIANZAS") y subtitulo ("¿A qué los invitamos?").
 * Consultas → WP: CPT `alianzas` (grilla logos) + tax pilar_alianza +
 * form propio del módulo (CF7/Fluent o REST).
 */
require __DIR__ . '/../bootstrap.php';

$hero        = ['etiqueta'   => 'Alianzas',
                'titulo'     => 'Alianzas Corporativas',
                'subtitulo'  => '¿A qué los invitamos?',
                'texto'      => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ipsum est, molestie non varius ut, finibus sit amet dolor. Aliquam id finibus mauris. Etiam vitae sodales augue.',
                'imagen'     => ''];
$pasos       = fge_datos('pasos-alianza');
$pilares     = fge_datos('pilares-alianza');
$alianzas    = fge_consulta('alianzas');

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main>
  <?php include __DIR__ . '/../components/organisms/hero-simple.php'; ?>

  <!-- De la intención a la acción (pasos 01-04) -->
  <section class="container py-4">
    <h2 class="h2 fw-semibold text-brand-primary mb-4">De la intención a la acción.</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
      <?php foreach ($pasos as $paso) : ?>
        <div class="col">
          <?php fge_componente('molecules/paso-proceso', ['paso' => $paso]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Cuatro formas de fortalecer la red -->
  <section class="container py-4">
    <h2 class="h2 fw-semibold text-brand-primary mb-4">Cuatro formas de fortalecer la red.</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
      <?php foreach (array_values($pilares) as $i => $pilar) : ?>
        <div class="col">
          <?php fge_componente('molecules/pilar-alianza', ['pilar' => $pilar, 'i' => $i]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Red de alianzas (logos) -->
  <section class="container py-4">
    <h2 class="h2 fw-semibold text-brand-primary mb-4">Empresas que ya colaboran.</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($alianzas as $alianza) : ?>
        <div class="col">
          <?php fge_componente('molecules/logo-alianza', ['alianza' => $alianza]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php include __DIR__ . '/../components/organisms/form-alianza.php'; ?>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
