<?php
/**
 * molecule: tabs-documentos — colección de documentos con tabs por país
 * (diseño de transparencia.html del compañero, tokenizado; specs tipográficas
 * del Figma: títulos de documento Outfit SemiBold → .text-brand-purple-800).
 *
 * Contrato: $config keys:
 *   'id'         → sufijo único para ids de tabs ("informes", "memorias")
 *   'titulo'     → heading de la sección (h de nivel dado por la página)
 *   'tipo'       => valor de la taxonomía tipo_documento a consultar
 *   'documentos' => fge_consulta('transparencia', ['tipo' => $tipo])
 *   'etiqueta'   → nombre del documento ("Informe financiero", "Memoria anual")
 *   'nivel'      → tag del heading ('h2' default)
 * El orden del tab list viene de data/paises.php (misma fuente que el topbar).
 * 🏷️ En WP: template-part + WP_Query tax_query país+tipo, orden por año DESC.
 */
$config = $config ?? [];
$tabs_id = $config['id'] ?? 'docs';
$paises  = fge_paises();

// agrupar documentos por país (los países sin documentos muestran placeholder)
$por_pais = [];
foreach (($config['documentos'] ?? []) as $doc) {
    $por_pais[$doc['pais']][] = $doc;
}

$inicio = true;
?>
<!-- molecule/tabs-documentos -->
<section class="container py-3">
  <<?= $config['nivel'] ?? 'h2' ?> class="h2 fw-semibold text-brand-primary mb-3">
    <?= htmlspecialchars($config['titulo'] ?? '') ?>
  </<?= $config['nivel'] ?? 'h2' ?>>

  <ul class="nav nav-tabs nav-justified nav-tabs-doc-fge border-bottom-0" id="tabs-<?= $tabs_id ?>" role="tablist">
    <?php foreach ($paises as $slug => $pais) : ?>
      <li class="nav-item" role="presentation">
        <button type="button" id="tab-<?= $tabs_id ?>-<?= $slug ?>"
          class="nav-link<?= $inicio ? ' active' : '' ?>"
          data-bs-toggle="tab" data-bs-target="#panel-<?= $tabs_id ?>-<?= $slug ?>"
          role="tab" aria-controls="panel-<?= $tabs_id ?>-<?= $slug ?>"
          aria-selected="<?= $inicio ? 'true' : 'false' ?>">
          <?= htmlspecialchars($pais['nombre']) ?>
        </button>
      </li>
    <?php $inicio = false; endforeach; ?>
  </ul>

  <div class="tab-content tab-content-doc-fge p-4" id="tabs-content-<?= $tabs_id ?>">
    <?php $inicio = true; foreach ($paises as $slug => $pais) : ?>
      <div class="tab-pane fade<?= $inicio ? ' show active' : '' ?>" id="panel-<?= $tabs_id ?>-<?= $slug ?>"
        role="tabpanel" aria-labelledby="tab-<?= $tabs_id ?>-<?= $slug ?>" tabindex="0">
        <?php $docs_pais = $por_pais[$slug] ?? []; ?>
        <?php if ($docs_pais) : ?>
          <ul class="list-unstyled d-flex flex-column gap-3 m-0">
            <?php foreach ($docs_pais as $doc) : ?>
              <li>
                <a href="<?= htmlspecialchars($doc['archivo']) ?>"
                   class="fw-semibold text-decoration-none text-brand-purple-800">
                  <?= htmlspecialchars($doc['etiqueta'] ?? $doc['titulo']) ?> <?= (int) $doc['anio'] ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="fs-xs text-secondary m-0">
            Aún no hay documentos publicados para <?= htmlspecialchars($pais['nombre']) ?>.
          </p>
        <?php endif; ?>
      </div>
    <?php $inicio = false; endforeach; ?>
  </div>
</section>
