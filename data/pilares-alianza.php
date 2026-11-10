<?php
/**
 * data/pilares-alianza.php — las 4 formas de configurar una alianza
 * (alianzas.html sección "Cuatro formas de fortalecer la red" /
 * Figma 478:3634; en WP: taxonomía `pilar_alianza` que clasifica alianzas).
 * 🔑 Regla de DIRECTORIO: el cliente edita eyebrow (el "01/CAPACIDADES"),
 * nombre y descripción. La numeración es visual de la lista, se deriva del
 * orden — no está en la data.
 * Consumido por: molecules/pilar-alianza → page-alianzas.
 */
return [
    'formacion' => [
        'slug'        => 'formacion',
        'nombre'      => 'Formación',
        'eyebrow'     => 'Capacidades',
        'descripcion' => 'Fortalecimiento de líderes, equipos y habilidades para el desarrollo y la transformación social.',
    ],
    'apoyo-legal' => [
        'slug'        => 'apoyo-legal',
        'nombre'      => 'Asesoramiento legal',
        'eyebrow'     => 'Autonomía',
        'descripcion' => 'Apoyo legal y trámites, obtención de personería jurídica y articulación con organismos públicos y privados.',
    ],
    'infraestructura' => [
        'slug'        => 'infraestructura',
        'nombre'      => 'Infraestructura',
        'eyebrow'     => 'Espacios',
        'descripcion' => 'Mejoramiento de espacios para desarrollar actividades en condiciones más adecuadas, dignas y sostenibles.',
    ],
    'una-vuelta' => [
        'slug'        => 'una-vuelta',
        'nombre'      => 'Una Vuelta +',
        'eyebrow'     => 'Producción',
        'descripcion' => 'Proyectos productivos, gestión de recursos, aumento de ingresos en los territorios y economía circular.',
    ],
];
