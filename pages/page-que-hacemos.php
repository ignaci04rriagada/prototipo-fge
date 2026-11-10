<?php
/**
 * page: page-que-hacemos — Qué hacemos (Template Name: Qué hacemos en WP)
 * Fuente de diseño combinada:
 *   - Figma 478:2771 "Página - Qué hacemos" (MCP — el diseño DEFINITIVO):
 *     hero con H1 3-líneas purple-800 + CTA fucsia "Explorar nuestros
 *     programas" con icono · sección mapa (container 1280) · 4 dimensiones
 *     (cards 302×358) · 5 programas full-width con chip categoría + chips ·
 *     casos con badge de país ("OBJETIVOS INFORMADOS").
 *   - que-hacemos.html (mockup del compañero): mismo esqueleto — tomado
 *     como estructura, normalizado a tokens (los success/info/danger son
 *     colores fuera de paleta → familia morada de marca).
 * Hero: reuso hero-simple (HERO ÚNICO de todas las internas) extendido
 * con CTA opcional — mismas medidas y espaciado para todas las páginas.
 * Consultas → WP: CPT `programas` (5 oficiales con flag) + tax `dimension`
 * + CPT `organizaciones` (flag destacado).
 */
require __DIR__ . '/../bootstrap.php';

$hero           = ['titulo'    => 'Fortalecemos a quienes transforman sus comunidades.',
                   'texto'    => 'Somos una fundación que fortalece organizaciones comunitarias en Argentina, Chile y Uruguay, impulsando su desarrollo mediante formación, asesoramiento legal, mejora de infraestructura y proyectos productivos con enfoque en economía circular.',
                   'imagen'   => '',
                   'cta'      => ['texto' => 'Explorar nuestros programas', 'href' => '#programas']];
$dimensiones    = fge_datos('dimensiones');
$iniciativas    = fge_datos('posts-iniciativas');
$casos          = array_values(array_filter(fge_datos('posts-casos'), fn ($c) => !empty($c['destacado'])));

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main>
  <?php include __DIR__ . '/../components/organisms/hero-simple.php'; ?>

  <?php include __DIR__ . '/../components/organisms/mapa-ubicacion.php'; ?>

  <!-- Dimensiones de fortalecimiento (4 cards) -->
  <section class="container py-4">
    <h2 class="h2 fw-semibold text-brand-primary mb-4">
      Fortalecer organizaciones desde distintas dimensiones.
    </h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
      <?php foreach ($dimensiones as $slug => $dimension) : ?>
        <div class="col">
          <?php fge_componente('molecules/card-dimension', ['dimension' => $dimension + ['slug' => $slug]]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Iniciativas / programas (5 filas full-width) -->
  <section id="programas" class="container py-4">
    <div class="mb-4">
      <h2 class="h2 fw-semibold text-brand-primary mb-1">
        Iniciativas que responden a distintas necesidades de la red.
      </h2>
      <p class="fs-xs text-muted m-0">
        Cinco programas consolidados que canalizan recursos técnicos, humanos y materiales hacia las comunidades vulnerables.
      </p>
    </div>
    <div class="d-flex flex-column gap-4">
      <?php foreach ($iniciativas as $programa) : ?>
        <?php fge_componente('molecules/programa-fila', ['programa' => $programa]); ?>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Casos: la realidad de cada organización -->
  <section class="container py-4 pb-5">
    <div class="mb-4">
      <h2 class="h2 fw-semibold text-brand-primary mb-1">
        Cada organización tiene su propia realidad.
      </h2>
      <p class="fs-xs text-muted m-0">
        Conocé cómo se manifiesta el trabajo comunitario en el territorio y sus desafíos en desarrollo.
      </p>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 align-items-stretch">
      <?php foreach ($casos as $caso) : ?>
        <div class="col">
          <?php fge_componente('molecules/card-caso-org', ['caso' => $caso]); ?>
        </div>
      <?php endforeach; ?>
      <div class="col d-flex align-items-center justify-content-center p-3">
        <a href="#" class="btn-fge btn-fge--primary btn-sm rounded-pill px-5 py-2 shadow-sm">
          Ver todos
        </a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
