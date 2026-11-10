<?php
/**
 * data/posts-iniciativas.php — los 5 programas oficiales de la fundación
 * (Figma 478:2771 + que-hacemos.html; futuro CPT `programas` — mismo CPT
 * de data/posts-programas.php, que hoy siembra la grilla por-país: al
 * migrar ambas consultas apuntan aquí marcando destacado/país).
 *
 * 🔑 Regla de DIRECTORIO: el cliente administra cada programa:
 *   - categoria  → taxonomía `linea_programa` (badge del chip de arriba)
 *   - titulo     → post title
 *   - texto      → campo SCF párrafo
 *   - chips      → campo SCF repeater de texto corto (habilidades/temas)
 *   - imagen     → campo SCF media ('' → placeholder)
 *   - caso       → campo SCF relación → organización destacada del programa
 *                  (nombre + país: "Caso destacado" del Figma)
 *   - campanias  → repeater de campaign lines (solo programa donación)
 * Consumido por: molecules/programa-fila → page-que-hacemos (ancla #programas).
 */
return [
    [
        'id'        => 501,
        'categoria' => 'Mejoramiento de Infraestructura',
        'titulo'    => 'Espacios con Valor',
        'texto'     => 'Colaboramos con las organizaciones de la Red Gestionar en la planificación y gestión de recursos orientados a mejorar sus espacios. Buscamos contribuir a que puedan ofrecer sus servicios en condiciones más adecuadas, dignas y sostenibles.',
        'chips'     => ['Habilitaciones sanitarias', 'Techado & Aislamiento', 'Espacios de cocina comunitaria'],
        'imagen'    => '',
        'caso'      => [],
    ],
    [
        'id'        => 502,
        'categoria' => 'Liderazgo & Desarrollo de Capacidades',
        'titulo'    => 'Referentes al Frente',
        'texto'     => 'Promovemos la gestión y el liderazgo de dirigentes sociales para fortalecer sus habilidades y capacidades de transformación comunitaria.',
        'chips'     => ['Aprendizaje colectivo', 'Socialización de buenas prácticas'],
        'imagen'    => '',
        'caso'      => [],
    ],
    [
        'id'        => 503,
        'categoria' => 'Economía Circular & RSE',
        'titulo'    => 'Una Vuelta +',
        'texto'     => 'Buscamos ampliar la producción, gestionar recursos de los barrios, aumentar los ingresos en los territorios, reducir el impacto ambiental asociado a los recursos reutilizados y apoyar a empresas en sus iniciativas de responsabilidad social empresarial.',
        'chips'     => [],
        'imagen'    => '',
        'caso'      => ['nombre' => 'Volutiva', 'pais' => 'Chile'],
    ],
    [
        'id'        => 504,
        'categoria' => 'Alianzas Empresariales en Territorio',
        'titulo'    => 'Voluntariado corporativo — Una hora para salvar al mundo',
        'texto'     => 'Articulamos el talento de colaboradores de empresas directamente con organizaciones de nuestra red, promoviendo la inclusión social, el trabajo conjunto en el territorio y el sentido de pertenencia.',
        'chips'     => ['Inclusión social activa'],
        'imagen'    => '',
        'caso'      => [],
    ],
    [
        'id'        => 505,
        'categoria' => 'Gestión y Logística Social',
        'titulo'    => 'Donación de recursos a organizaciones comunitarias',
        'texto'     => 'Buscamos proveer recursos que respondan a las necesidades de las organizaciones de nuestra red, promoviendo la inclusión social, el trabajo conjunto en el territorio y el sentido de pertenencia.',
        'chips'     => ['Juguetes para Fiestas y Día de las Infancias', 'Asistencia permanente en provisión de alimentos'],
        'imagen'    => '',
        'caso'      => [],
        'campanias' => ['Ropa de abrigo durante el invierno'],
    ],
];
