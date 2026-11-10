<?php
/**
 * data/paises.php — términos de la taxonomía `pais` (futuro WP)
 * Keys = meta_keys SCF del término / payload taxonomía.
 *
 * 🔑 Regla de DIRECTORIO: `activo` controla visibilidad en el sitio
 *   (tabs, topbar, grilla país). Chile/Argentina/Uruguay = presencia
 *   actual del copy; Colombia/Perú/México = futura expansión (quedan
 *   registrados, deshabilitados — al activarlos el sitio los muestra
 *   sin tocar ningún componente).
 * 'pais' => meta_key del término; slug país.
 * Consumido por: topbar-paises, navbar selector, card-pais, page-pais,
 * tabs-documentos (solo activos).
 */
return [
    'argentina' => [
        'slug'        => 'argentina',
        'nombre'      => 'Argentina',
        'activo'      => true,
        'hero_titulo' => 'Nuestro trabajo en Argentina',
        'hero_texto'  => 'Programas y organizaciones acompañadas en territorio argentino.',
        'responsable' => 'maria-contreras',   // futuro: relación → CPT equipo
        'sede'        => ['ciudad' => 'Buenos Aires', 'email' => 'argentina@gestionaresperanzas.com', 'tel' => '+54 11 0000 0000'],
    ],
    'chile'     => [
        'slug'        => 'chile',
        'nombre'      => 'Chile',
        'activo'      => true,
        'hero_titulo' => 'Nuestro trabajo en Chile',
        'hero_texto'  => 'Programas y organizaciones acompañadas en territorio chileno.',
        'responsable' => 'sp-fge',
        'sede'        => ['ciudad' => 'Santiago', 'email' => 'chile@gestionaresperanzas.com', 'tel' => '+56 2 0000 0000'],
    ],
    'uruguay'   => [
        'slug'        => 'uruguay',
        'nombre'      => 'Uruguay',
        'activo'      => true,
        'hero_titulo' => 'Nuestro trabajo en Uruguay',
        'hero_texto'  => 'Programas y organizaciones acompañadas en territorio uruguayo.',
        'responsable' => 'sp-fge',
        'sede'        => ['ciudad' => 'Montevideo', 'email' => 'uruguay@gestionaresperanzas.com', 'tel' => '+598 2 0000 0000'],
    ],
    'colombia'  => [
        'slug'        => 'colombia',
        'nombre'      => 'Colombia',
        'activo'      => false,   // futura expansión
        'hero_titulo' => 'Nuestro trabajo en Colombia',
        'hero_texto'  => 'Programas y organizaciones acompañadas en territorio colombiano.',
        'responsable' => 'sp-fge',
        'sede'        => ['ciudad' => 'Bogotá', 'email' => 'colombia@gestionaresperanzas.com', 'tel' => '+57 1 0000 0000'],
    ],
    'peru'      => [
        'slug'        => 'peru',
        'nombre'      => 'Perú',
        'activo'      => false,   // futura expansión
        'hero_titulo' => 'Nuestro trabajo en Perú',
        'hero_texto'  => 'Programas y organizaciones acompañadas en territorio peruano.',
        'responsable' => 'sp-fge',
        'sede'        => ['ciudad' => 'Lima', 'email' => 'peru@gestionaresperanzas.com', 'tel' => '+51 1 0000 0000'],
    ],
    'mexico'    => [
        'slug'        => 'mexico',
        'nombre'      => 'México',
        'activo'      => false,   // futura expansión
        'hero_titulo' => 'Nuestro trabajo en México',
        'hero_texto'  => 'Programas y organizaciones acompañadas en territorio mexicano.',
        'responsable' => 'sp-fge',
        'sede'        => ['ciudad' => 'Ciudad de México', 'email' => 'mexico@gestionaresperanzas.com', 'tel' => '+52 55 0000 0000'],
    ],
];
