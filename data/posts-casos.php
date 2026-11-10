<?php
/**
 * data/posts-casos.php — casos de organizaciones (colección `organizaciones`,
 * futuro CPT: los que llevan flag destacado=true aparecen en page-que-hacemos).
 *
 * 🔑 Regla de DIRECTORIO: el cliente administra cada caso:
 *   - nombre     → post title (marca 'pais' del badge examina data/paises.php)
 *   - pais       → taxonomía `pais` (badge país de la tarjeta)
 *   - historia   → campo SCF textarea (la descripción)
 *   - imagen     → campo SCF media ('' → placeholder)
 *   - destacado  → flag SCF booleano (solo destacados entran a la home de
 *                  programas; regla igual a destacados internacionales)
 * Consumido por: molecules/card-caso-org → page-que-hacemos.
 */
return [
    [
        'id' => 701, 'nombre' => 'Por El Amor de Dios', 'pais' => 'chile', 'destacado' => true, 'imagen' => '',
        'historia' => 'Comedor que entrega alimentos a personas sin trabajo, adultos mayores sin red familiar, personas en situación de calle y otras personas que necesitan alimentación en la comuna de La Granja.',
    ],
    [
        'id' => 702, 'nombre' => 'Volutiva', 'pais' => 'chile', 'destacado' => true, 'imagen' => '',
        'historia' => 'Iniciativa de emprendedoras que diseñan y confeccionan productos funcionales y corporativos utilizando material publicitario y reciclaje.',
    ],
    [
        'id' => 703, 'nombre' => 'Comedor y Merendero Resistiendo', 'pais' => 'argentina', 'destacado' => true, 'imagen' => '',
        'historia' => 'Brinda asistencia alimentaria a más de 250 personas mediante almuerzos y meriendas tres veces por semana. También ofrece talleres de fútbol como espacio de contención y recreación para niños y niñas del barrio. Nació en 2018 como una iniciativa familiar.',
    ],
    [
        'id' => 704, 'nombre' => 'Merendero Unidos Somos Más', 'pais' => 'uruguay', 'destacado' => true, 'imagen' => '',
        'historia' => 'Brinda merienda y cena tres veces por semana a niños, niñas y adolescentes en situación de vulnerabilidad. Además, ofrece apoyo escolar, actividades recreativas y educativas, y rehabilitación psicomotriz para favorecer su desarrollo integral.',
    ],
];
