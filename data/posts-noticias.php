<?php
/**
 * data/posts-noticias.php — colección "noticias" (futuro: post nativo WP)
 * keys = payload natural de post + meta_keys SCF de la estrategia:
 *   (subtitulo≤62, tiempo_lectura, credito_foto) + taxonomía pais /
 *   linea_programa / category.
 * 🔑 Regla de DIRECTORIO (page-noticia): cada noticia administra
 *   'secciones' (repeater de bloques título+texto) y 'cita' (blockquote
 *   opcional con atribución) — así el directorio arma el artículo sin
 *   tocar el template. 'url' apunta a page-noticia.php?id=<id>.
 * Consumido por: card-destacada (carrusel home), page-noticias (grilla),
 * page-noticia (single) + molecules/card-noticia.
 */
return [
    [
        'id'          => 101,
        'titulo'      => 'Esto es un titular importante de una noticias destacada',
        'subtitulo'   => 'Extracto breve del titular destacado para badge (62 máx).',
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
        'linea_programa' => 'Liderazgo & Desarrollo de Capacidades',
        'fecha'       => '2026-10-18',
        'imagen'      => '',
        'credito_foto'=> 'Equipo FGE',
        'tiempo_lectura' => 3,
        'destacado'   => false,
        'url'         => 'pages/page-noticia.php?id=102',
        'secciones'   => [
            ['titulo' => 'El valor de encontrarnos', 'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
            ['titulo' => 'Una invitación a hacer juntos', 'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
        ],
        'cita'        => ['texto' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", 'autor' => 'Frase de ejemplo - Sin atribución testimonial'],
    ],
    [
        'id'          => 103,
        'titulo'      => 'Infraestructura productiva para emprendedores locales',
        'subtitulo'   => 'Grupo local recibió herramientas para proyectos productivos.',
        'pais'        => 'uruguay',
        'linea_programa' => 'Economía Circular & RSE',
        'fecha'       => '2026-10-05',
        'imagen'      => '',
        'credito_foto'=> 'Equipo FGE',
        'tiempo_lectura' => 4,
        'destacado'   => false,
        'url'         => 'pages/page-noticia.php?id=103',
        'secciones'   => [
            ['titulo' => 'Herramientas que multiplican', 'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
            ['titulo' => 'Lo que sigue', 'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
        ],
        'cita'        => [],
    ],
    [
        'id'          => 104,
        'titulo'      => 'Asesoramiento legal ampliado en Buenos Aires',
        'subtitulo'   => 'Nuevos recursos de asesoría para organizaciones sociales.',
        'pais'        => 'argentina',
        'linea_programa' => 'Liderazgo & Desarrollo de Capacidades',
        'fecha'       => '2026-09-28',
        'imagen'      => '',
        'credito_foto'=> 'Equipo FGE',
        'tiempo_lectura' => 3,
        'destacado'   => false,
        'url'         => 'pages/page-noticia.php?id=104',
        'secciones'   => [
            ['titulo' => 'Personería jurídica en marcha', 'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
        ],
        'cita'        => [],
    ],
];
