<?php
/**
 * pages/page-home.php — piloto del patrón (landing de la fundación)
 *
 * FUTURA CABECERA public WP (al migrar, solo agregar arriba):
 *   Template Name: Página de Inicio
 *   (asignable en Ajustes → Lectura como página estática)
 *
 * Toda la estructura: shells + fge_componente + consultas data/.
 * El hero-col de esta página es HOME-ONLY (única vista que lo usa).
 * Las noticias provienen del "CPT" noticias vía fge_consulta()
 * (futuro WP_Query: post_type=post, meta destacado=true post destacada).
 */

include '../bootstrap.php';

$fge_titulo = 'Fundación Gestionar Esperanzas';

// ── Data de la página ────────────────────────────────────────────
$noticia_destacada = fge_consulta('noticias', ['destacado' => true])[0] ?? null;
$alertas           = fge_datos('campanas');
$paises            = fge_paises();
$metricas          = fge_datos('metricas');
$alianzas          = fge_consulta('alianzas');
$colaborar         = fge_datos('colaborar');
$testimonios       = fge_consulta('testimonios', ['destacado_internacional' => true]); // el cliente destacó, no por país

include '../includes/head.php';
include '../includes/header.php';
?>

<main>
  <!-- Título H1 global accesible para jerarquía correcta de la landing -->
  <h1 class="visually-hidden">Fundación Gestionar Esperanzas</h1>

  <?php /* ── HERO LAYER (HOME-ONLY): destacada + alertas + países ───── */ ?>
  <div class="container py-4">
    <div class="row g-4">
      <!-- Columna Izquierda: Noticia Destacada y Alertas -->
      <div class="col-12 col-lg-8 d-flex flex-column gap-4">

        <?php if ($noticia_destacada): fge_componente('molecules/card-destacada', ['noticia' => $noticia_destacada, 'fge_base' => fge_base()]); endif; ?>

        <?php fge_componente('molecules/resumen-alertas', ['resumen' => $alertas]); ?>
      </div>

      <!-- Columna Derecha: Tarjetas de Países -->
      <div class="col-12 col-lg-4 d-flex flex-column gap-3">
        <?php foreach ($paises as $pais_key => $pais_data): fge_componente('molecules/card-pais', ['pais' => $pais_data, 'fge_base' => fge_base()]); endforeach; ?>
      </div>
    </div>
  </div>

  <?php /* ── IMPACTO REGIONAL (futuro: transient métricas Google Sheets) ─ */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-brand-navy mb-1">Impacto regional</h2>
    <p class="fs-xs text-muted mb-4">Última actualización: <?= htmlspecialchars($metricas['actualizado']) ?></p>

    <div class="row row-cols-2 row-cols-md-4 g-3">
      <?php foreach ($metricas['items'] as $metrica_item): fge_componente('molecules/metrica-counter', ['metrica' => $metrica_item]); endforeach; ?>
    </div>
  </section>

  <?php /* ── BANNER TRANSPARENCIA ACTIVA ──────────────────────────────── */ ?>
  <?php fge_componente('molecules/banner-cta', [
      'cta' => ['titulo' => 'Transparencia activa', 'texto' => 'Ir a Transparencia', 'href' => fge_base() . '/pages/page-transparencia.php'],
  ]); ?>

  <?php /* ── ALIANZAS (futuro CPT alianzas) ──────────────────────────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-brand-navy mb-4">Alianzas</h2>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
      <?php foreach ($alianzas as $alianza_data):
        fge_componente('molecules/logo-alianza', ['alianza' => $alianza_data, 'fge_base' => fge_base()]);
      endforeach; ?>
    </div>
  </section>

  <?php /* ── CÓMO COLABORAR (SCF del Page en el tema) ─────────────────── */ ?>
  <section class="container py-4">
    <h2 class="h5 fw-bold text-brand-navy mb-1">Cómo colaborar</h2>
    <p class="fs-xs text-muted mb-4">Opciones reales de donación, voluntariado y alianzas para [país].</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($colaborar as $bloque_data): fge_componente('molecules/card-colaborar', ['bloque' => $bloque_data]); endforeach; ?>
    </div>
  </section>

  <?php /* ── TESTIMONIOS (futuro CPT testimonios) ────────────────────── */ ?>
  <section class="container py-4 pb-5">
    <h2 class="h5 fw-bold text-brand-navy mb-1">Testimonios</h2>
    <p class="fs-xs text-muted mb-4">Programas, proyectos y enfoques adaptados al contexto local, manteniendo la misma estructura de contenido para Chile, Argentina y Uruguay.</p>

    <div class="row g-4">
      <?php foreach ($testimonios as $testimonio_data): ?>
        <div class="col-12 col-md-4">
          <?php fge_componente('molecules/card-testimonio', ['testimonio' => $testimonio_data]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include '../includes/footer.php'; ?>
