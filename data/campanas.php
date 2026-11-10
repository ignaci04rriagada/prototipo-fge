<?php
/**
 * data/campanas.php — colección `campanas_alertas` (futuro CPT)
 * keys = meta_keys SCF de la estrategia §5:
 *   tipo (alerta_urgencia|campana_especial), estado, titular, meta_cifra,
 *   organizacion_vinculada (→CPT organizaciones), pais_alcance, cta_url.
 * Regla de negocio: SOLO 1 alerta con estado=true por país al mismo tiempo
 * (documentado también en docs/estrategia §5). Consumido por:
 * resumen-alertas (home), banner-alerta (futuro broadcast via body_class).
 */
return [
    'CL' => [
        'pais' => 'chile', 'pais_ref' => 'Chile',
        'cantidad_activas' => 1,             // contador para resumen-alertas
    ],
    'AR' => ['pais' => 'argentina', 'pais_ref' => 'Argentina', 'cantidad_activas' => 0],
    'UY' => ['pais' => 'uruguay',   'pais_ref' => 'Uruguay',   'cantidad_activas' => 0],
];
