<?php
/**
 * data/metricas.php — métricas de impacto regional del home
 * ⚠️ futuro: NO será campo SCF — proviene del TRANSIENT fge-metricas
 * (endpoint REST /wp-json/fundacion/v1/metricas ← Google Sheets API con
 * caché 12h, según docs/estrategia §4). En prototipo: array estático.
 * Consumido por: metrica-counter ×4 (Impacto regional).
 */
return [
    'actualizado' => '26 de octubre de 2026',
    'items' => [
        ['titulo' => 'Métrica 1', 'valor' => 999, 'nota' => 'small', 'destacado' => false],
        ['titulo' => 'Métrica 2', 'valor' => 999, 'nota' => 'small', 'destacado' => false],
        ['titulo' => 'Métrica 3', 'valor' => 999, 'nota' => 'small', 'destacado' => true],  // destacado rosa
        ['titulo' => 'Párrafo.',  'valor' => 999, 'nota' => 'small', 'destacado' => false],
    ],
];
