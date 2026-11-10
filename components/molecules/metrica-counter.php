<?php
/**
 * molecule: metrica-counter — métrica de impacto
 * Modos (por keys del dato):
 *  - home:      destacado=0/1 (rosa)  → tarjeta blanca con borde
 *  - molde país: fondo='cyan|green|purple|gold' → tarjeta sólida de acento
 * Datos: data/metricas.php (home) · data/impacto-local.php (país).
 */
$metrica = $metrica ?? null;
$fondo   = $metrica['fondo'] ?? null;

$clase_base  = $fondo ? "bg-brand-$fondo" : 'border';
$extra_fondo = $fondo ? 'text-white d-flex flex-column justify-content-center h-100 min-vh-15' : '';
$color_titulo = $fondo ? 'text-white-50' : (($metrica['destacado'] ?? false) ? 'text-brand-fuchsia' : 'text-muted');
$color_valor  = $fondo ? '' : (($metrica['destacado'] ?? false) ? 'text-brand-fuchsia' : 'text-brand-navy');
$clase_valor  = $fondo ? 'h3 tracking-tight' : 'display-6';
?>
<!-- molecule/metrica-counter -->
<div class="<?= $clase_base ?> rounded p-4 text-center <?= $extra_fondo ?>">
  <p class="fs-xs <?= $color_titulo ?> fw-medium mb-1"><?= htmlspecialchars($metrica['titulo']) ?></p>
  <p class="<?= $clase_valor ?> fw-bold <?= $color_valor ?> mb-1"><?= (int) $metrica['valor'] ?></p>
  <span class="fs-xxs <?= $fondo ? 'text-white-50' : 'text-muted' ?>"><?= htmlspecialchars($metrica['nota']) ?></span>
</div>
