<?php
/**
 * data/dimensiones.php — las 4 dimensiones de fortalecimiento
 * (taxonomía `dimension` en WP: términos globales que clasifican programas).
 *
 * 🔑 Regla de DIRECTORIO: el cliente agrega/edita dimensiones (nombre +
 * descripción); el ícono se asigna por slug (assets/img/icon-<slug>.svg)
 * con fallback al rombo placeholder.
 * Fuente: Figma 478:2771 sección "dimensiones" (4 cards 302×358, gap 48,
 * título uppercase con color propio por dimensión).
 * Consumido por: molecules/card-dimension → page-que-hacemos.
 */
return [
    'formacion' => [
        'slug'        => 'formacion',
        'nombre'      => 'Formación',
        'icono'       => 'bi-mortarboard',   // Bootstrap Icons (sistema de íconos)
        'descripcion' => 'Fortalecimiento de líderes comunitarios, conformación de equipos directivos, aprendizaje.',
    ],
    'apoyo-legal' => [
        'slug'        => 'apoyo-legal',
        'nombre'      => 'Apoyo legal',
        'icono'       => 'bi-briefcase',
        'descripcion' => 'Apoyo legal, orientación en trámites, obtención de personalidad jurídica.',
    ],
    'mejora-lugares' => [
        'slug'        => 'mejora-lugares',
        'nombre'      => 'Mejora de lugares',
        'icono'       => 'bi-house-gear',
        'descripcion' => 'Acompañamiento en la planificación y gestión de recursos destinados a mejorar los espacios donde las organizaciones desarrollan sus actividades.',
    ],
    'proyectos-productivos' => [
        'slug'        => 'proyectos-productivos',
        'nombre'      => 'Proyectos productivos',
        'icono'       => 'bi-recycle',   // economía circular: el ícono ES la tesis
        'descripcion' => 'Desarrollo de proyectos que aprovechan recursos, impulsan la producción y buscan generar ingresos en los territorios, incluyendo iniciativas basadas en economía circular.',
    ],
];
