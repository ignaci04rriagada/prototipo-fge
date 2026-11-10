---
name: Migración Tema WP
description: >
  Convierte un prototipo pre-WP (HTML/PHP + BEM + tokens) en un tema WordPress clásico sobre
  boilerplate Underscores, usando la arquitectura personal del autor: carpeta assets/ portable,
  header/footer como shells, page templates con Template Name, SCF y módulos de negocio con
  REST API. Usar cuando se migre un prototipo a tema WordPress o se arme/estructure el esqueleto de un tema.
---

# Skill: Migración de Prototipo → Tema WordPress Clásico

Metodología del autor para convertir prototipos maquetados (ver skill `prototipado-pre-wp`)
en temas WordPress **classic theme** sobre **Underscores (`_s`)**. La migración debe ser
ensamblado, no traducción.

## Convenciones del autor (CONTRATO, no negociable)

1. **Chasis Underscores intacto**: se parte de una copia de `_s` sin tocar su núcleo
   (`inc/`, `template-parts/`, plantillas base). La capa propia vive aparte (ver punto 2).
2. **`assets/` portable**: la carpeta `assets/` se trae completa del prototipo (comprimir/
   descomprimir entre proyectos). Contiene:
   ```
   assets/
   ├── assets.php              ← hub: incluye todos los assets/includes/*
   ├── includes/
   │   ├── css-functions.php   → wp_register_style + wp_enqueue_style (CDN + tema)
   │   ├── js-functions.php    → registro JS con deps + versionado filemtime + wp_localize_script
   │   ├── menu-functions.php  → nav menus + Walker Bootstrap 5 + custom logo
   │   ├── widgets-functions.php → zonas de widgets del footer (autoadministrable)
   │   └── modulos-functions.php → carga de assets/modulos/* (negocio)
   ├── templates/
   │   ├── navs/{nav-desk,nav-mobile}.php + nav.css
   │   └── footers/ (solo si el proyecto no usa footer por widgets)
   ├── librerias/css/style.css ← el CSS real del tema (con tokens BEM del prototipo)
   │   └── js/                 ← 1 script por feature
   └── modulos/<modulo>/core-*.php ← REST field + CPT/SCF por feature de negocio
   ```
3. **`functions.php` = manifiesto, no contenedor de lógica**: solo setup de `_s`
   (theme supports, menus, widgets, content width, custom-logo) + UN include:
   `include get_template_directory() . '/assets/assets.php';`
4. **`header.php` / `footer.php` en la raíz, como shells**: nunca se maqueta contenido ahí.
   - `header.php` → `get_template_part()` de `assets/templates/navs/`.
   - `footer.php` → apunta a las **zonas de widgets** (definidas en `widgets-functions.php`)
     y renderiza `dynamic_sidebar()`. El contenido del footer SIEMPRE es administrable
     desde el Panel (Apariencia → Widgets). Forzar widgets clásicos:
     `add_filter('use_widgets_block_editor', '__return_false');`
5. **Páginas = page templates con `Template Name:`**: NEVER `front-page.php`.
   Cada vista es copia modificada del `page.php` de `_s` en la raíz del tema:
   `page-home.php`, `page-transparencia.php`, etc., con cabecera
   `/* Template Name: ... */`. El landing se asigna como página estática en
   Ajustes → Lectura. Loops mínimos: `get_header()` → loop → `get_template_part()`.
6. **SCF (Secure Custom Fields)** para campos custom, con fallback seguro a `get_post_meta()`.
   Los meta_keys ya vienen definidos por el data/ del prototipo.

## Patrón de encolado (css-functions.php / js-functions.php)

```php
// assets/includes/css-functions.php
function css_functions() {
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), null, 'all');
    wp_register_style('bootstrap-icons', '...bootstrap-icons.min.css', array(), null, 'all');
    // El CSS del tema vive en assets/librerias/css/style.css, NO en el style.css raíz
    // (que es solo ficha de metadatos del tema). Versionar con filemtime para cache-busting:
    wp_register_style('estilo-tema', get_template_directory_uri() . '/assets/librerias/css/style.css',
        array(), filemtime(get_template_directory() . '/assets/librerias/css/style.css'), 'all');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('bootstrap-icons');
    wp_enqueue_style('estilo-tema');
}
add_action('wp_enqueue_scripts', 'css_functions');
```

```php
// assets/includes/js-functions.php — patrón "orquestador"
function js_functions() {
    if (!is_admin()) {
        $js_dir = get_template_directory() . '/assets/librerias/js/';
        $js_uri = get_template_directory_uri() . '/assets/librerias/js/';

        wp_register_script('bootstrap-js', '...bootstrap.bundle.min.js', array(), '5.3.8', true);

        // 1 script por feature, versionado con filemtime (cache-busting automático)
        wp_register_script('<prefijo>-hero', $js_uri.'hero.js', array('jquery'), filemtime($js_dir.'hero.js'), true);
        // ...

        // main.js = orquestador: depende de todos → solo se encola él y WP resuelve el árbol
        wp_register_script('<prefijo>-main', $js_uri.'main.js', array(
            'jquery','bootstrap-js','<prefijo>-hero', /*...*/
        ), filemtime($js_dir.'main.js'), true);

        // Config PHP → JS sin hardcodear (REST URL, theme mods, etc.)
        wp_localize_script('<prefijo>-ajax', '<prefijo>Config', array(
            'apiUrl' => esc_url_raw(rest_url('wp/v2/posts?per_page=100'))
        ));

        wp_enqueue_script('<prefijo>-main');
    }
}
add_action('wp_enqueue_scripts', 'js_functions', 999); // prioridad baja = al final
```

Reglas de encolado: `version = filemtime()` para assets locales; `null` para CDNs;
`$in_footer = true` siempre; guard `is_admin()`; fuera de admin nunca cargar JS de front.

## Menús y walker Bootstrap 5 (menu-functions.php)

- Registrar ubicaciones separadas desktop/mobile: `menu-superior`, `menu-mobile`.
- Reusar/adaptar el **Walker Bootstrap 5** (`bootstrap_5_wp_nav_menu_walker`): genera
  `nav-item`, `nav-link`, `dropdown-toggle`, `data-bs-toggle`, `aria-expanded` — puente
  WP→Bootstrap en vez de hackear el markup nativo.
- Filtros: `nav_menu_css_class` (agregar clases por ubicación) y
  `nav_menu_link_attributes` (clases de `nav-link`).
- Override `get_custom_logo` para envolver el logo en el markup Bootstrap del diseño
  (`<a class="navbar-brand p-0 d-flex align-items-center">` + `custom-logo-img`).

## Módulos de negocio (assets/modulos/)

Por cada feature de negocio (CPT + campos), una carpeta con `core-<feature>.php`:

```php
// assets/modulos/<feature>/core-<feature>.php — patrón REST field + campo seguro
add_action('rest_api_init', function () {
    register_rest_field(array('post', 'page', '<cpt>'), 'datos_<prefijo>', array(
        'get_callback' => function ($post_arr) {
            $post_id = $post_arr['id'];
            // Lectura de campos segura: SCF si existe, fallback a get_post_meta
            $obtener = function ($campo) use ($post_id) {
                if (class_exists('SCF')) {
                    $valor = SCF::get($campo, $post_id);
                    if (!empty($valor)) return $valor;
                }
                return get_post_meta($post_id, $campo, true);
            };
            return array(/* payload estructurado listo para JS */);
        },
    ));
});
```

- Los meta_keys deben coincidir EXACTAMENTE con los keys de `data/` del prototipo.
- Opción A para front: `register_rest_field()` + consumo JS (catálogo reactivo, caché en memoria).
  Opción B: bucles clásicos `WP_Query` + tax_query por plantilla PHP (SEO first).
  Elegir por página; no mezclar sin criterio. Métricas externas (p. ej. Google Sheets):
  endpoint propio + `set_transient()` con refresco programado (12 h) + render híbrido
  (PHP para SEO + JS para refrescos dinámicos).

## Plantillas y jerarquía

| Necesidad | Plantilla |
|---|---|
| Landing (página estática) | `page-home.php` con `Template Name:` |
| Vista paramétrica (p. ej. por país/término) | un única page template molde + `WP_Query` por taxonomía — NO copias por término |
| Single de contenido | `single.php` (+ template-parts) |
| Archivo por taxonomía | `archive-<taxonomia>.php` o `taxonomy-<taxonomia>.php` |
| 404 / búsqueda | `404.php` / `search.php` (boilerplate _s) |

- Contenido estructural en `template-parts/content-*.php` (convención _s), relleno desde
  SCF. El markup BEM del prototipo se traslada SIN cambios a estos template-parts.
- Textdomain propio (`load_theme_textdomain('<prefijo>')`), todo texto i18n-able,
  `esc_html_e()`/`esc_attr()` en widgets y echo que renderiza en el footer.

## Orden de ensamblado (pipeline de migración)

1. Crear carpeta del tema (nombre = prefijo kebab-case, ej. `fge-tema`) con la copia de `_s`
   + ficha `style.css` raíz (Theme Name, Author, versión).
2. Sustituir `functions.php` de `_s` por el manifiesto + include a `assets/assets.php`.
3. Copiar el motor `assets/` del prototipo (tokens del cliente integrados) y adosar las funciones
   de encolado propias (`includes/*-functions.php` adaptadas al prefijo del proyecto).
4. `header.php` / `footer.php` como shells: nav desde `assets/templates/navs/`, footer por
   widgets con sus zonas registradas.
5. Page templates con `Template Name:` desde el prototipo (cambiar `include` → `get_header()` /
   `get_template_part()` / `get_footer()`).
6. Componentes del prototipo → `template-parts/` (markup intacto), datos → SCF (creación de
   campos según `data/`) y CPTs + taxonomías según la estrategia de contenido.
7. Módulos de negocio + REST si corresponde; `js-functions.php` cableado desde el día uno.
8. Verificación final: 0 CSS inline residual, 0 hex fuera de tokens, menús asignados,
   zonas de footer activas, textos i18n, encolados versionados con filemtime.

## Checklist de DOs/DON'Ts heredados de la auditoría del motor original

- ✅ CSS del tema en `assets/librerias/css/style.css`, encolado centralizado por WP.
- ✅ Un solo payload `<head>`: `wp_head()` hace el trabajo; nada de `<link>` hardcodeados.
- ❌ No usar `get_stylesheet_uri()` para el CSS real del tema (el style.css raíz es metadatos).
- ❌ No mezclar CDN hardcodeados en `header.php` en vez de `wp_enqueue_*`.
- ❌ No renderizar contenido de footer sin `dynamic_sidebar()` sobre zonas registradas.
- ❌ No crear plantillas por-término (una sola plantilla molde paramétrica).

## Documentos de referencia del proyecto FGE

- `docs/informe-boilerplate-js-avanzado-d2.md` (arquitectura de origen, patrón Abanico)
- `docs/estrategia-theme-classic-wp.md` (modelo de contenido: CPTs, taxonomías, APIs)
- `docs/propuesta-restructuracion-prototipo.md` (mapeo prototipo → tema)
- `docs/MAPA-MIGRACION.md` (manifest archivo por archivo, cuando exista)
