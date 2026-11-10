<?php
/**
 * data/posts-programas.php — colección `programas` (futuro CPT programas)
 * keys = meta_keys SCF estrategia §3-B: metodologia (checklist),
 * alcance_local (párrafo) + taxonomías pais / linea_programa.
 * Consumido por: page-pais (futuro también page-que-hacemos).
 * [granularidad: el mockup por-pais no muestra grilla programas;
 *  se deja sembrada para el molde — placeholder mínimo]
 */
return [
    ['id' => 301, 'titulo' => 'Formación científica para estudiantes', 'pais' => 'argentina', 'linea_programa' => 'formacion',    'url' => '#'],
    ['id' => 302, 'titulo' => 'Asesoramiento legal comunitario',       'pais' => 'argentina', 'linea_programa' => 'asesoramiento', 'url' => '#'],
    ['id' => 303, 'titulo' => 'Infraestructura social',                'pais' => 'uruguay',   'linea_programa' => 'infraestructura','url' => '#'],
];
