<?php
/**
 * data/posts-noticias.php — colección "noticias" (futuro: post nativo WP)
 * keys = payload natural de post + meta_keys SCF de la estrategia:
 *   (subtitulo≤62, tiempo_lectura, credito_foto) + taxonomía pais /
 *   linea_programa / category.
 * Consumido por: card-destacada (carrusel del home), grilla-noticias.
 */
return [
    [
        'id'          => 101,
        'titulo'      => 'Esto es un titular importante de una noticias destacada',
        'subtitulo'   => 'Extracto breve del titular destacado para badge (62 máx).',
        'contenido'   => '',
        'pais'        => null,           // destacada global del home
        'linea_programa' => null,
        'fecha'       => '2026-10-26',
        'imagen'      => '',             // placeholder: componente muestra ícono
        'credito_foto'=> '',
        'tiempo_lectura'=> 3,
        'destacado'   => true,           // ← flag SCF (selección manual del editor)
        'url'         => '#',
    ],
    [
        'id'          => 102,
        'titulo'      => 'Nueva jornada de formación científica en Santiago',
        'subtitulo'   => 'Voluntariado científico acercó la ciencia a estudiantes.',
        'pais'        => 'chile',
        'fecha'       => '2026-10-18',
        'imagen'      => '',
        'destacado'   => false,
        'url'         => '#',
    ],
    [
        'id'          => 103,
        'titulo'      => 'Infraestructura productiva para emprendedores locales',
        'subtitulo'   => 'Grupo local recibió herramientas para proyectos productivos.',
        'pais'        => 'uruguay',
        'fecha'       => '2026-10-05',
        'imagen'      => '',
        'destacado'   => false,
        'url'         => '#',
    ],
    [
        'id'          => 104,
        'titulo'      => 'Asesoramiento legal ampliado en Buenos Aires',
        'subtitulo'   => 'Nuevos recursos de asesoría para organizaciones sociales.',
        'pais'        => 'argentina',
        'fecha'       => '2026-09-28',
        'imagen'      => '',
        'destacado'   => false,
        'url'         => '#',
    ],
];
