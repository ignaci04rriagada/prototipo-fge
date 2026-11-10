<?php
/**
 * data/menu.php — navegación global (futuro: wp_nav_menu 'menu-superior')
 * keys = lo que necesita el organismo navbar; en WP los links vienen
 * del gestor de menús, no de acá (solo sirve de preview del molde).
 */
return [
    'items' => [
        ['texto' => 'Qué hacemos',  'href' => '#que-hacemos'],
        ['texto' => 'Transparencia','href' => '#transparencia'],
        ['texto' => 'Involúcrate',  'href' => '#involucrate'],
    ],
    'donar' => ['texto' => 'Donar', 'href' => '#donar'],
];
