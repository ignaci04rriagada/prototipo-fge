<?php
/**
 * pages/page-pais.php — MOLDE PARAMÉTRICO (una plantilla, N países)
 *
 * FUTURA CABECERA WP: Template Name: Página de País
 * (En producción el parámetro viene de la taxonomía: get_queried_object()
 *  sobre /pais/[slug]; en prototipo: ?pais=argentina|uruguay|colombia)
 *
 * Regla del molde: ni una sola línea menciona un país concreto.
 * Toda pieza es organismo/molécula con consulta filtrada por $pais_slug.
 */
include '../bootstrap.php';

$pais_slug = fge_pais_slug();
$pais      = fge_pais($pais_slug);                          // campos SCF término
$impacto   = fge_datos('impacto-local')[$pais_slug] ?? [];
$programas     = fge_consulta('programas',      ['pais' => $pais_slug]);
$organizaciones= fge_consulta('organizaciones',  ['pais' => $pais_slug]);
$noticias_pais = fge_consulta('noticias',        ['pais' => $pais_slug]);
$testimonios_p = fge_consulta('testimonios',     ['pais' => $pais_slug]);
$colaborar     = fge_datos('colaborar');
$fge_base      = fge_base();

$fge_titulo = $pais['nombre'] . ' — Fundación Gestionar Esperanzas';

include '../includes/head.php';
include '../includes/header.php';
?>

<main>
  <?php fge_componente('organisms/hero-pais', ['pais' => $pais]); ?>

  <?php /* ── IMPACTO LOCAL (futuro: transient metrics_pais) ──────────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-dark mb-1">Impacto local</h2>
    <p class="fs-xxs text-muted mb-4">Última actualización: <?= htmlspecialchars($impacto['actualizado'] ?? '') ?></p>

    <div class="row row-cols-2 row-cols-sm-4 g-3">
      <?php foreach (($impacto['items'] ?? []) as $metrica_item):
        fge_componente('molecules/metrica-counter', ['metrica' => $metrica_item]);
      endforeach; ?>
    </div>
  </section>

  <?php /* ── ORGANIZACIONES (CPT; tarjeta en riesgo ← campaña activa) ── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-dark mb-4">Organizaciones</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($organizaciones as $org_data):
        fge_componente('molecules/card-organizacion', ['org' => $org_data, 'fge_base' => $fge_base]);
      endforeach; ?>
    </div>
  </section>

  <?php /* ── BANNER TRANSPARENCIA 1 (purpura) ───────────────────────── */ ?>
  <?php fge_componente('molecules/banner-cta', ['cta' => [
      'titulo' => 'Transparencia activa', 'texto' => 'Ir a Transparencia',
      'href' => fge_base() . '/pages/page-transparencia.php', 'fondo' => 'purple-banner',
  ]]); ?>

  <?php /* ── ALIANZAS (reutiliza la molécula del piloto intacta) ─────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-dark mb-4">Alianzas</h2>
    <div class="row row-cols-3 row-cols-sm-6 g-3">
      <?php foreach (fge_consulta('alianzas') as $alianza_data):
        fge_componente('molecules/logo-alianza', ['alianza' => $alianza_data, 'fge_base' => $fge_base]);
      endforeach; ?>
    </div>
  </section>

  <?php /* ── ACTUALIDAD Y NOTICIAS (consulta por país) ───────────────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-dark mb-1">Actualidad y noticias</h2>
    <p class="fs-xxs text-muted mb-4">Selección de hitos, historias y actualidad relevante para <?= htmlspecialchars($pais['nombre']) ?>.</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($noticias_pais as $noticia_data):
        fge_componente('molecules/card-noticia', ['noticia' => $noticia_data, 'fge_base' => $fge_base]);
      endforeach; ?>
    </div>
  </section>

  <?php /* ── TESTIMONIOS (consulta por país) ─────────────────────────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-dark mb-1">Testimonios</h2>
    <p class="fs-xxs text-muted mb-4">Programas, proyectos y enfoques adaptados al contexto local de <?= htmlspecialchars($pais['nombre']) ?>.</p>

    <div class="row g-4 align-items-stretch">
      <?php foreach ($testimonios_p as $testi_data): ?>
        <div class="col-12 col-md-4">
          <?php fge_componente('molecules/card-testimonio', ['testimonio' => $testi_data]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php /* ── CÓMO COLABORAR (reutiliza data + molécula del home) ─────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-dark mb-1">Cómo colaborar</h2>
    <p class="fs-xxs text-muted mb-4">Opciones reales de donación, voluntariado y alianzas para <?= htmlspecialchars($pais['nombre']) ?>.</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($colaborar as $bloque_data):
        fge_componente('molecules/card-colaborar', ['bloque' => $bloque_data]);
      endforeach; ?>
    </div>
  </section>

  <?php /* ── CONTACTO LOCAL (contenido del término país) ─────────────── */ ?>
  <?php fge_componente('molecules/contacto-local', ['pais' => $pais]); ?>
</main>

<?php include '../includes/footer.php'; ?>
