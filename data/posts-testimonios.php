<?php
/**
 * data/posts-testimonios.php — colección `testimonios` (futuro CPT)
 * keys = meta_keys SCF de la estrategia §3-E:
 *   cita (~200 chars), nombre_completo → nombre, edad, foto_perfil → foto
 *   (proporción 1:1... fotografía de persona) + taxonomías pais /
 *   linea_programa + flag destacado_internacional.
 * Consumido por: card-testimonio (diseño ÚNICO en home y page-pais).
 *   Home: fge_consulta('testimonios', ['destacado_internacional' => true])
 *   País: fge_consulta('testimonios', ['pais' => $slug])
 */
return [
    [
        'id'          => 201,
        'nombre'      => 'Rosa Márquez',
        'edad'        => 31,
        'cita'        => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam molestie mauris et quam efficitur fringilla."',
        'foto'        => '',              // placeholder hasta tener foto real (fotografía 1:1 persona)
        'pais'        => 'argentina',
        'destacado_internacional' => true,  // ← flag SCF: el cliente elige para el home
    ],
    [
        'id'          => 202,
        'nombre'      => 'Javiera González',
        'edad'        => 26,
        'cita'        => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in risus vestibulum, mattis sapien ac, aliquam justo. Orci varius natoque penatibus."',
        'foto'        => '',
        'pais'        => 'chile',
        'destacado_internacional' => true,  // ← flag SCF: el cliente elige para el home
    ],
    [
        'id'          => 203,
        'nombre'      => 'Sofía Vargas',
        'edad'        => 29,
        'cita'        => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam molestie mauris et quam efficitur fringilla. Praesent in vestibulum."',
        'foto'        => '',
        'pais'        => 'uruguay',
        'destacado_internacional' => true,  // ← flag SCF: el cliente elige para el home
    ],
    [
        'id'          => 204,
        'nombre'      => 'Marcos Pereyra',
        'edad'        => 35,
        'cita'        => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus."',
        'foto'        => '',
        'pais'        => 'colombia',
        'destacado_internacional' => false, // el cliente elige MÁX 3 para el home (fila de 3 columnas col-4)
    ],
];
