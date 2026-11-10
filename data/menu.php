<?php
/**
 * data/menu.php — navegación principal (futuro: WP menú asignable)
 * 🔑 Regla del prototipo: el navbar resuelve hrefs ancla→página
 * automáticamente con file_exists (enlaces nunca rotos). Con las 8
 * páginas maquetadas, los destinos reales existen: se declaran
 * directos y el resolver los toma tal cual.
 */
return [
    'items' => [
        ['texto' => 'Inicio',        'href' => 'pages/page-home.php'],
        ['texto' => 'Qué hacemos',   'href' => 'pages/page-que-hacemos.php'],
        ['texto' => 'Transparencia', 'href' => 'pages/page-transparencia.php'],
        ['texto' => 'Involúcrate',   'href' => 'pages/page-alianzas.php'],
        ['texto' => 'Noticias',      'href' => 'pages/page-noticias.php'],
    ],
    'donar' => ['texto' => 'Donar', 'href' => 'pages/page-donacion.php'],
];
