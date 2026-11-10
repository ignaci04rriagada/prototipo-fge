<?php
/**
 * includes/header.php — SHELL (contra: las páginas nunca maquetan el nav)
 *
 * Compone: <body> + organismo topbar + organismo navbar.
 * En WP: este es header.php → get_template_part de assets/templates/navs/.
 * DEFAULT: $fge_ancla = false → enlaces del menú /ancla; libre.
 */
$fge_ancla = $fge_ancla ?? false;
?>
<body>

<?php
include __DIR__ . '/../components/organisms/topbar-paises.php';
fge_componente('organisms/navbar-fge', ['ancla' => $fge_ancla]);
?>
