<!doctype html>
<html lang="es" id="fge">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php /* Título por página: el page template define $fge_head antes de incluir este shell */
  $fge_titulo = $fge_titulo ?? 'Fundación Gestionar Esperanzas'; ?>

  <title><?= htmlspecialchars($fge_titulo, ENT_QUOTES, 'UTF-8') ?></title>

  <?php
  /** ─────────────────────────────────────────────────────────────
   *  ÚNICO <head> del prototipo (contrato de la skill: recursos acá,
   *  nunca en páginas).
   *
   *  PUnoite en WP: wp_head() encola todo esto desde
   *  assets/includes/css-functions.php — aquí es la contraparte pre-WP.
   *  ─────────────────────────────────────────────────────────────── */
  ?>

  <?php
  /** Base URL absoluta del prototipo (desde /prototipo-fge/pages/x.php → /prototipo-fge/) */
  $fge_base = fge_base();
  ?>

  <!-- Bootstrap Icons: fuente de íconos del sistema (1.11.3) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Sistema de diseño FGE: tokens + BEM + fuentes locales (@font-face Envolventa/Lato).
       Bootstrap 5.3 se importa y encapsula DENTRO de style.css vía
       @import url(...) layer(bootstrap) — las capas fge.* garantizan que
       el sistema SIEMPRE gane sin !important (arquitectura @layer). -->
  <link rel="stylesheet" href="<?= $fge_base ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">

  <!-- Puente legado→tokens (DEUDA P2: desaparece al completar BEM) -->

</head>
