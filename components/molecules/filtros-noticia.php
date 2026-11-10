<?php
/**
 * molecule: filtros-noticia — sidebar de filtros de la grilla de noticias
 * (noticia-grilla.html del compañero: País / Programa / Fecha / Categoría).
 * ⚙️ Prototipo: País y Programa son funcionales (links ?pais= / ?programa=
 * que la consulta ya respeta). Fecha y Categoría quedan como UI de chips
 * deshabilitados — su regla de negocio (últimos 30 días, categoría WP
 * nativa) se define con el panel; al migrar son facets WP_Query.
 * 🔑 Regla de DIRECTORIO: los países y opciones vienen SIEMPRE de
 * fge_paises() y data/posts-iniciativas.php — nada hardcodeado.
 */
$pais_filtro    = $_GET['pais'] ?? '';
$programa_filtro = $_GET['programa'] ?? '';
$paises_filt     = fge_paises();
$programas_filt  = array_values(array_filter(array_column(fge_datos('posts-iniciativas'), 'titulo')));
?>
<!-- molecule/filtros-noticia -->
<aside class="col-12 col-md-3">
  <h2 class="fs-xs fw-bold text-brand-primary mb-3">Filtros</h2>

  <!-- Filtro: País -->
  <div class="mb-3">
    <h3 class="fs-xs fw-semibold text-brand-primary mb-2">País</h3>
    <div class="d-flex flex-wrap gap-1">
      <a href="?" class="btn btn-sm btn-filter-notifica <?= $pais_filtro === '' ? 'btn-filter-notifica--activo' : '' ?>">Todas</a>
      <?php foreach ($paises_filt as $slug_f => $pais_f) : ?>
        <a href="?pais=<?= htmlspecialchars($slug_f) ?>" class="btn btn-sm btn-filter-notifica <?= $pais_filtro === $slug_f ? 'btn-filter-notifica--activo' : '' ?>">
          <?= htmlspecialchars($pais_f['nombre']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Filtro: Programa -->
  <div class="mb-3">
    <h3 class="fs-xs fw-semibold text-brand-primary mb-2">Programa</h3>
    <div class="d-flex flex-column align-items-start gap-1">
      <?php foreach ($programas_filt as $programa_f) : $prog = urlencode($programa_f); ?>
        <a href="?programa=<?= $prog ?>" class="btn btn-sm btn-filter-notifica <?= $programa_filtro === $programa_f ? 'btn-filter-notifica--activo' : '' ?>">
          <?= htmlspecialchars($programa_f) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Filtro: Fecha (UI pendiente de regla de negocio) -->
  <div class="mb-3">
    <h3 class="fs-xs fw-semibold text-brand-primary mb-2">Fecha</h3>
    <div class="d-flex flex-wrap gap-1">
      <span class="btn btn-sm btn-filter-notifica disabled" aria-disabled="true">Últimos 30 días</span>
      <span class="btn btn-sm btn-filter-notifica disabled" aria-disabled="true">Este año</span>
    </div>
  </div>

  <!-- Filtro: Categoría (WP nativo — sin data aún) -->
  <div class="mb-3">
    <h3 class="fs-xs fw-semibold text-brand-primary mb-2">Categoría</h3>
    <div class="d-flex flex-wrap gap-1">
      <?php foreach (['Impacto', 'Alianzas', 'Transparencia', 'Programas'] as $cat) : ?>
        <span class="btn btn-sm btn-filter-notifica disabled" aria-disabled="true"><?= $cat ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</aside>
