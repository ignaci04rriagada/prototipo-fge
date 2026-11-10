<?php
/**
 * data/posts-organizaciones.php — colección `organizaciones` (futuro CPT)
 * keys = meta_keys SCF estrategia §3-C: tipo_servicio, historia_impacto,
 * vinculado_a (→programa) + taxonomía pais.
 * 'en_riesgo' = true ⇒ la tarjeta porta borde de urgencia (futuro: la
 * alerta activa define esto vía la campaña vinculada — no flag manual).
 * Consumido por: card-organizacion en page-pais.
 */
return [
    [
        'id' => 401, 'nombre' => 'Los Guerreros', 'tipo_servicio' => 'Comedor solidario',
        'pais' => 'argentina', 'en_riesgo' => true, 'url' => '#',
    ],
    [
        'id' => 402, 'nombre' => "Fundación Melyna\nMontes", 'tipo_servicio' => 'Comedor solidario',
        'pais' => 'argentina', 'en_riesgo' => false, 'url' => '#',
    ],
    [
        'id' => 403, 'nombre' => 'Volutiva', 'tipo_servicio' => 'Comedor solidario',
        'pais' => 'argentina', 'en_riesgo' => false, 'url' => '#',
    ],
    [
        'id' => 404, 'nombre' => 'Semillas del Sur', 'tipo_servicio' => 'Comedor solidario',
        'pais' => 'uruguay', 'en_riesgo' => false, 'url' => '#',
    ],
    [
        'id' => 405, 'nombre' => 'Cocina Comunitaria', 'tipo_servicio' => 'Comedor solidario',
        'pais' => 'colombia', 'en_riesgo' => false, 'url' => '#',
    ],
];
