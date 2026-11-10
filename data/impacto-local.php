<?php
/**
 * data/impacto-local.php — métricas de impacto POR PAÍS
 * keys por país = taxonomía pais. Ítems con propiedad 'fondo':
 * cyan | green | purple | gold (futuro: TRANSIENT metrics_pais de
 * Google Sheets — ver estrategia §4, caché 12h).
 * Consumido por: metrica-counter ×4 en page-pais.php (molde único).
 */
return [
    'argentina' => [
        'actualizado' => '24 de octubre de 2026',
        'items' => [
            ['titulo' => 'Programas',     'valor' => 999, 'nota' => 'small', 'fondo' => 'cyan'],
            ['titulo' => 'Organizaciones','valor' => 999, 'nota' => 'small', 'fondo' => 'green'],
            ['titulo' => 'Voluntarios',   'valor' => 999, 'nota' => 'small', 'fondo' => 'purple'],
            ['titulo' => '[párrafo]',     'valor' => 999, 'nota' => 'small', 'fondo' => 'gold'],
        ],
    ],
    'uruguay' => [
        'actualizado' => '24 de octubre de 2026',
        'items' => [
            ['titulo' => 'Programas',     'valor' => 999, 'nota' => 'small', 'fondo' => 'cyan'],
            ['titulo' => 'Organizaciones','valor' => 999, 'nota' => 'small', 'fondo' => 'green'],
            ['titulo' => 'Voluntarios',   'valor' => 999, 'nota' => 'small', 'fondo' => 'purple'],
            ['titulo' => '[párrafo]',     'valor' => 999, 'nota' => 'small', 'fondo' => 'gold'],
        ],
    ],
    'colombia' => [
        'actualizado' => '24 de octubre de 2026',
        'items' => [
            ['titulo' => 'Programas',     'valor' => 999, 'nota' => 'small', 'fondo' => 'cyan'],
            ['titulo' => 'Organizaciones','valor' => 999, 'nota' => 'small', 'fondo' => 'green'],
            ['titulo' => 'Voluntarios',   'valor' => 999, 'nota' => 'small', 'fondo' => 'purple'],
            ['titulo' => '[párrafo]',     'valor' => 999, 'nota' => 'small', 'fondo' => 'gold'],
        ],
    ],
];
