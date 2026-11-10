<?php
/**
 * data/colaborar.php — bloque "Cómo colaborar" del home
 * NOTA: es contenido de página relacionado con CPTs y con el proceso de
 * donación por país: los textos de las 3 tarjetas son browsable SCF del
 * Page (futuro: grupo de campos SCF sobre page-home). Los CTAs de
 * "donación única/recurrente" apuntarán a page-donacion con query del país.
 * Consumido por: card-colaborar ×3.
 */
return [
    [
        'titulo' => 'Donación',
        'texto'  => 'Modalidades de donación vigentes para [país].',
        'ctas' => [
            ['texto' => 'Donación única',     'href' => '#donar', 'estilo' => 'teal'],
            ['texto' => 'Donación recurrente','href' => '#donar', 'estilo' => 'outline'],
        ],
    ],
    [
        'titulo' => 'Voluntariado',
        'texto'  => 'Oportunidades de voluntariado disponibles en [país].',
        'ctas' => [
            ['texto' => 'Ver oportunidades','href' => '#involucrate', 'estilo' => 'fuchsia'],
            ['texto' => 'Contactar equipo', 'href' => '#involucrate', 'estilo' => 'outline'],
        ],
    ],
    [
        'titulo' => 'Alianzas',
        'texto'  => 'Información para empresas y organizaciones que desean colaborar en [país].',
        'ctas' => [
            ['texto' => 'Conocer alianzas','href' => '#alianzas', 'estilo' => 'teal'],
            ['texto' => 'Contactar equipo','href' => '#alianzas', 'estilo' => 'outline'],
        ],
    ],
];
