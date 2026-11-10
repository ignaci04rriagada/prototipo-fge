# Prototipo FGE — Fundación Gestionar Esperanzas

Prototipo en PHP puro (sin CMS) del sitio institucional. Valida el diseño, los design tokens y la arquitectura de componentes antes de migrar todo a un tema clásico de WordPress. No es una maqueta estática: las páginas se sirven con MAMP en `http://localhost/prototipo-fge`.

## Estructura

```
prototipo-fge/
├── assets/
│   ├── css/style.css      Design tokens (:root) + estilos de componentes propios
│   ├── css/bridge.css     Puente temporal: utilidades de los mockups → tokens
│   ├── img/               Imágenes e íconos descargados del Figma
│   └── fonts/             Tipografías del manual de marca (Outfit, Lato)
├── bootstrap.php          Helpers del sistema (fge_*). Único punto de carga
├── index.php              Redirige a la página principal
├── includes/              Shells globales: head, header, footer
├── components/
│   ├── organisms/         Bloques completos (navbar, footer, heroes)
│   ├── molecules/         Componentes (tarjetas, banners, métricas)
│   └── atoms/             Piezas mínimas
├── data/                  Simulación de base de datos (futuro CPT / campos SCF)
├── pages/                 Una plantilla por página del sitio
├── docs/                  Estrategia de migración, auditorías y mapa de progreso
└── *.html                 Mockups HTML originales (solo referencia, ya en desuso)
```

## Cómo se construye una página

Cada archivo de `pages/` sigue el mismo orden:

1. **Datos antes de markup.** Las consultas (`fge_consulta()`) viven al inicio del archivo, como hoy se hace con un `WP_Query` en WordPress.
2. **Shells.** `includes/head.php` y `includes/header.php` abren; `includes/footer.php` cierra. Ninguna página maqueta nav ni footer propio.
3. **Componentes.** El contenido se ensambla con `fge_componente('molecules/nombre', $vars)`, que incluye `components/molecules/nombre.php`.

Un componente declara en su cabecera su contrato: qué variables recibe, de qué colección de `data/` viene y qué será en el tema WordPress (template part, campo SCF o taxonomía).

## Reglas del sistema

- **Design tokens únicos.** Todo color, espaciado y tipografía viene de las variables de `:root` en `style.css`. Ningún hex suelto en los componentes; si un valor no tiene token, se documenta con comentario de deuda.
- **Un diseño por componente.** Si el mismo bloque aparece en varias páginas con diseño distinto, se unifica. Lo que cambia entre contextos es la consulta de datos, no el markup.
- **Diferencia entre diseño y selección de contenido.** Ejemplo real: los testimonios de la página principal (los que el cliente destaca) y los de la página de país (filtrados por territorio) comparten la misma molécula; la sola consulta cambia.
- **Un solo CSS.** `style.css` contiene tokens + componentes + utilidades de marca del sistema (`bg-purple-950`, `bg-neutral-200`, `text-brand-*`). Los mockups no usan CSS propio: si una utilidad falta, se promueve a las secciones 4-6 del archivo con tokens, no se crea un archivo paralelo. `bridge.css` fue eliminado al cierre de las páginas (11/2026).

## Helpers principales (bootstrap.php)

| Helper | Uso |
|---|---|
| `fge_datos('entidad')` | Lee `data/entidad.php` (config global, menús, países) |
| `fge_consulta('coleccion', $filtros)` | Lee `data/posts-coleccion.php` con filtros estilo `WP_Query` |
| `fge_componente($ruta, $vars)` | Renderiza un componente con sus variables |
| `fge_base()` | URL absoluta del prototipo (evita rutas relativas rotas) |
| `fge_url_pais($slug)` | Enlace a la página de país |
| `fge_paises()` | Solo los países con `activo => true` (topbar, tabs, selects, selector de donación) |
| `fge_pais($slug)` / `fge_pais_slug()` | Datos y slug del país según URL (`?pais=`) con fallback al primero activo |

## Entorno y verificación

- Servir con MAMP (`http://localhost/prototipo-fge`) o con `php -S localhost:8799`.
- Sintaxis: `php -l <archivo>`. Render: `curl` a la página y revisar el código resultante.
- El CSS se sirve con versión automática (`style.css?v=<mtime>`); los cambios en estilos invalidan la caché del navegador sin recargas forzadas.

## Documentación en docs/

- `estrategia-theme-classic-wp.md` — destino WordPress: CPTs, taxonomías, campos y plantillas.
- `MAPA-MIGRACION.md` — manifiesto vivo: auditoría por página y componente, decisiones registradas con fecha.
- `informe-auditoria-tokens.md` — auditoría de colores y utilidades fuera de paleta.
- `propuesta-restructuracion-prototipo.md` — origen de la estructura actual.

## Estado

8 páginas completas: home, país (`?pais=`), qué-hacemos, transparencia, alianzas, donación (`?pais=`), noticias (grilla con filtros país/programa) y noticia single (`?id=`). Fuentes de diseño: mockups HTML en la raíz (estructura) + specs del sistema; el MCP de Figma se usó solo para calibrar los tokens tipográficos iniciales y ya no es dependencia (ver skill "Modo sin MCP").

La migración a WordPress no comienza hasta validar el prototipo completo. Cuando ocurra, cada pieza ya tiene su traducción definida: moléculas a template parts, `data/` a CPTs con ACF/SCF, y `fge_consulta()` a `WP_Query`.
