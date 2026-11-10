<?php
/**
 * data/pasos-alianza.php — los 4 pasos del proceso corporativo
 * (alianzas.html + Figma 478:3634 "Pasos 01-04").
 * 🔑 Regla de DIRECTORIO: paso = título + descripción; el orden es la key
 * del array (el cliente reordena en el panel y la UI lo respeta).
 * En WP: post type simple `paso` con orden por menu_order.
 * Consumido por: molecules/paso-proceso → page-alianzas.
 */
return [
    ['n' => '01', 'titulo' => 'Conversemos',  'detalle' => 'Cuéntanos qué busca tu empresa.'],
    ['n' => '02', 'titulo' => 'Identificamos', 'detalle' => 'Encontramos una oportunidad dentro de la red.'],
    ['n' => '03', 'titulo' => 'Activamos',    'detalle' => 'Conectamos capacidades, recursos y organización.'],
    ['n' => '04', 'titulo' => 'Medimos',      'detalle' => 'Hacemos visible el resultado de la colaboración.'],
];
