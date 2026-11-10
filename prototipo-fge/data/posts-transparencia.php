<?php
/**
 * data/posts-transparencia.php — colección `transparencia` (futuro CPT)
 *
 * 🔑 Regla de DIRECTORIO (admin del panel, futuro WP):
 *   El cliente administra cada documento al subirlo:
 *     - país        → relación con la taxonomía `pais` (define en qué tab aparece)
 *     - tipo        → taxonomía `tipo_documento` (informes_financieros | memorias)
 *     - anio        → campo SCF de texto corto (define el orden dentro del tab)
 *     - archivo     → campo SCF de tipo file/media (PDF a descargar)
 *   Consultas (WP futuro): tax_query país + tipo_documento, ordenadas por anio DESC.
 * Consumido por: molecules/tabs-documentos (page-transparencia).
 */
return [
    ['id' => 601, 'tipo' => 'informes_financieros', 'pais' => 'argentina', 'anio' => 2025, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 602, 'tipo' => 'informes_financieros', 'pais' => 'argentina', 'anio' => 2024, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 603, 'tipo' => 'informes_financieros', 'pais' => 'argentina', 'anio' => 2023, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 611, 'tipo' => 'informes_financieros', 'pais' => 'chile',      'anio' => 2025, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 612, 'tipo' => 'informes_financieros', 'pais' => 'chile',      'anio' => 2024, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 613, 'tipo' => 'informes_financieros', 'pais' => 'chile',      'anio' => 2023, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 621, 'tipo' => 'informes_financieros', 'pais' => 'uruguay',    'anio' => 2025, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 622, 'tipo' => 'informes_financieros', 'pais' => 'uruguay',    'anio' => 2024, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 623, 'tipo' => 'informes_financieros', 'pais' => 'uruguay',    'anio' => 2023, 'titulo' => 'Informe financiero', 'archivo' => '#'],
    ['id' => 631, 'tipo' => 'memorias',             'pais' => 'argentina', 'anio' => 2025, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 632, 'tipo' => 'memorias',             'pais' => 'argentina', 'anio' => 2024, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 633, 'tipo' => 'memorias',             'pais' => 'argentina', 'anio' => 2023, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 641, 'tipo' => 'memorias',             'pais' => 'chile',     'anio' => 2025, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 642, 'tipo' => 'memorias',             'pais' => 'chile',     'anio' => 2024, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 643, 'tipo' => 'memorias',             'pais' => 'chile',     'anio' => 2023, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 651, 'tipo' => 'memorias',             'pais' => 'uruguay',   'anio' => 2025, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 652, 'tipo' => 'memorias',             'pais' => 'uruguay',   'anio' => 2024, 'titulo' => 'Memoria anual', 'archivo' => '#'],
    ['id' => 653, 'tipo' => 'memorias',             'pais' => 'uruguay',   'anio' => 2023, 'titulo' => 'Memoria anual', 'archivo' => '#'],
];
