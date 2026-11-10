# 🏗️ Informe de Revisión — Boilerplate `js-avanzado-d2` y Patron de Migración FGE → WordPress

**Fecha:** 09/11/2026 · **Objeto de estudio:** `js-avanzado-d2/` (tema "Abanico", Underscores + DUOC UC Desafío 2)
**Propósito:** Abstraer la arquitectura del tema como patrón de referencia para migrar el prototipo `prototipo-fge` a un tema personalizado.

---

## 1. Resumen ejecutivo

`js-avanzado-d2` es un tema hijo de la filosofía **Underscores (`_s`) + capa cliente propia**: conserva intacta la
boilerplate oficial (`inc/`, `template-parts/`, plantillas base) y superpone un directorio `assets/` autoral que
actúa como **capa de aplicación** claramente separada del "chasis" de WordPress. La clave de su organización es
la **delegación en cascada desde `functions.php`**:

```
functions.php  (solo setup core de _s + 1 include)
   └── assets/assets.php                → bootstrap de la capa propia
         └── assets/includes/*.php      → un archivo por dominio funcional
               ├── css-functions.php      → registro/encolado de estilos (CDN + tema)
               ├── js-functions.php       → registro/encolado de scripts (con versionado filemtime)
               ├── menu-functions.php     → nav menus, Walker Bootstrap 5, logo
               ├── widgets-functions.php  → zonas de footer autoadministrable
               └── modulos-functions.php  → carga de módulos de negocio
                     └── assets/modulos/modulo-librerias/core-librerias.php  → REST + SCF
   └── assets/templates/                → templates de UI intercambiables (navs/, footers/)
   └── assets/librerias/                → código fuente real (js/, js/ con 1 css del tema live)
```

**Principio central:** `functions.php` es un **manifiesto, no un contenedor de lógica**; todo lo demás vive en
`assets/` particionado por responsabilidades.

---

## 2. Despiece de las capas

### 2.1 El "chasis" Underscores (sin tocar)

Se conserva estandar de `_s` con mínimas custom: `404.php`, `archive.php`, `single.php`, `page.php`, `search.php`,
`index.php`, `comments.php`, `sidebar.php`, `header.php`, `footer.php`, `inc/customizer.php`,
`inc/template-tags.php`, `inc/template-functions.php`, `template-parts/content*.php`.

- `header.php` y `footer.php` de `_s` **siguen siendo el punto real de construcción** del documento
  (`wp_head()`, `body_class()`, `wp_body_open()`, `wp_footer()`).
- La capa propia genera **piezas de UI** (nav, footer custom) que la plantilla usa vía `get_template_part()`.

### 2.2 `functions.php` → Manifiesto Bootstrap

```php
// Solo setup de _s (theme supports, menus, widgets, content_width) + encolado mínimo:
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
...
// Única línea de integración de la capa propia (al final):
include get_template_directory() . '/assets/assets.php';
```

> `assets.php` abstrae por completo el manejo de la capa cliente del resto del tema.

### 2.3 `assets/assets.php` → Hub de la capa propia

```php
<?php
add_post_type_support('page', 'excerpt');              // extra: páginas obtienen excerpt
include ... '/assets/includes/css-functions.php';
include ... '/assets/includes/js-functions.php';
include ... '/assets/includes/widgets-functions.php';
include ... '/assets/includes/menu-functions.php';
include ... '/assets/includes/modulos-functions.php';
```

### 2.4 `assets/includes/` → Patrón de separación por preocupación

Cada archivo agrupa todos los hooks/filters de UN dominio. No hay colisiones de hooks:
cada módulo llama a sus propios `add_action`/`add_filter` declarados en su archivo.

#### a) `css-functions.php` — Encolado de CSS (CDN como estilo_primary)

```php
function css_functions() {
    // 1. Registro (no encolo aún), version=null para CDN
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/.../bootstrap.min.css', array(), null, 'all');
    wp_register_style('bootstrap-icons', 'https://cdn.jsdelivr.net/.../bootstrap-icons.min.css', array(), null, 'all');
    // 2. Estilo "vivo" del tema (ruta real, no get_stylesheet_uri)
    wp_register_style('estilo-tema', get_template_directory_uri() . '/assets/librerias/css/style.css', array(), null, 'all');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('bootstrap-icons');
    wp_enqueue_style('estilo-tema');
}
add_action('wp_enqueue_scripts', 'css_functions');
```

**Lecciones:**
- Los tres estilos se encolan en **una sola acción** centralizada, no dispersos por plantilla.
- El CSS del tema **NO es `style.css` de la raíz** (que solo metadatos de tema) sino
  `assets/librerias/css/style.css`. Los assets reales viven en `assets/`.
- CDN con dependencia `null` y `version=null` (no cache busting innecesario).

#### b) `js-functions.php` — Patrón "registro con versionado dinámico + orquestador"

```php
function js_functions() {
    if (!is_admin()) {
        $js_dir = get_template_directory() . '/assets/librerias/js/';
        $js_uri = get_template_directory_uri() . '/assets/librerias/js/';

        // Libs externas (CDN)
        wp_register_script('bootstrap-js', '.../bootstrap.bundle.min.js', array(), '5.3.8', true);
        wp_register_script('gsap', '.../gsap.min.js', array(), '3.12.5', true);
        wp_register_script('gsap-scrolltrigger', '.../ScrollTrigger.min.js', array('gsap'), '3.12.5', true);

        // Scripts propios: cada módulo JS del frontend es 1 script registrado
        wp_register_script('abanico-ajax',    $js_uri.'ajax.js',    array('jquery'), filemtime($js_dir.'ajax.js'), true);
        wp_register_script('abanico-carrusel',$js_uri.'carrusel.js',array('jquery'), filemtime($js_dir.'carrusel.js'), true);
        // ...

        // "main.js" como orquestador: depende de TODOS los demás → encolar solo main basta
        wp_register_script('abanico-main', $js_uri.'main.js', array(
            'jquery','jquery-ui-full','bootstrap-js',
            'abanico-ajax','abanico-carrusel','abanico-detalle',
            'abanico-boton-sos','abanico-marquesina','abanico-hero'
        ), filemtime($js_dir.'main.js'), true);

        // Inyección de config PHP→JS para la REST API
        wp_localize_script('abanico-ajax', 'abanicoConfig', array(
            'apiUrl' => esc_url_raw(rest_url('wp/v2/posts?per_page=100'))
        ));

        wp_enqueue_script('abanico-main');   // encola solo el orquestador
    }
}
add_action('wp_enqueue_scripts', 'js_functions', 999);   // prioridad baja para ir al final
```

**Patrones con valor para FGE:**
1. **`filemtime()` como versión** — cache busted automático en cada edición del archivo sin tocar código:
   `wp_register_script('handle', $uri, $deps, filemtime($ruteo_local), true)`.
2. **Grafo de dependencias declarativo** — cada módulo JS es un script con `deps` y `main.js` es el orquestador.
   Solo se hace `wp_enqueue_script` del último, WP resuelve el árbol.
3. **`wp_localize_script()` para config backend→frontend** — la URL de la REST API se computa en PHP
   (`rest_url()`) y se inyecta al JS sin hardcodear.
4. **`is_admin()` guard** — jamas cargar scripts del frontend en el admin.
5. **Prioridad `999`** — garantizar que XMLified scripts de core/otra ext carguen antes.

#### c) `menu-functions.php` — Menus, walker Bootstrap 5 y logo

- Registra **2 ubicaciones** separadas: `menu-superior` (desktop) y `menu-mobile`.
- Custom **Walker Bootstrap 5** (`bootstrap_5_wp_nav_menu_walker`) que genera `nav-item`, `nav-link`,
  `dropdown-toggle`, `data-bs-toggle`, `aria-expanded` — es decir, **Bridge WP→Bootstrap** en vez de
  CSS hack del markup nativo de `wp_nav_menu()`.
- Filtros `nav_menu_css_class` y `nav_menu_link_attributes` para clases por ubicación.
- Override del filtro **`get_custom_logo`** para envolver el logo custom en el markup Bootstrap
  (`<a class="navbar-brand p-0 d-flex ...">`) — la salida del logo se casa con el diseño maqueta.
- Encolado de CSS del nav (`assets/templates/navs/nav.css`) en este mismo módulo.

#### d) `widgets-functions.php` — Footer autoadministrable con widgets

- `add_filter('use_widgets_block_editor', '__return_false');` → fuerza **widgets clásicos**
  (control de markup entre manos, en desmedro del editor de bloques).
- Registra 4 sidebars `footer_*` (Navegación, Géneros, Proyecto, Social) que quedan
  administrables desde Apariencia → Widgets.
- El markup `before_widget`/`after_widget`/`before_title` se define **aquí**, no en la plantilla:
  el diseño del footer vive en algunos lados, el contenido en el admin.

#### e) `modulos-functions.php` → módulos de negocio

```php
include ... '/assets/modulos/modulo-librerias/core-librerias.php';
```

Es una **fábrica módulo-oriented**: cada feature de negocio ("librerías") es un folder bajo `assets/modulos/`.
El core (`core-librerias.php`) expone Custom Fields (SCF) + metas nativos vía `register_rest_field()`
sobre múltiples post types (`post`, `page`, `libreria`), construyendo un payload estructurado
(`datos_abanico`) listo para consumo JS. Con fallback: si no existe SCF, recurre a `get_post_meta()`.

### 2.5 `assets/templates/` → UI intercambiable (navs/, footers/)

- `navs/nav-desk.php`, `navs/nav-mobile.php` + `navs/nav.css`: navs modulares, cargadas por
  `get_template_part()` desde plantillas superiores según dispositivo/sector (desktop vs móvil HTML separado).
- `footers/template-footer.php`: footer construido con las 4 zonas de widgets
  (`dynamic_sidebar('footer_navegacion')`, etc.), con copyright y texto hardcodeado sólo en la base.
- `header.php` y `footer.php` de `_s` siguen siendo los "puntos de bloqueo" pero
  **la modificación visual real vive en `assets/templates/`**: se puede cambiar el footer
  sin tocar el boilerplate original.

### 2.6 Plantillas de página

- `page-home.php` (\=`Template Name:` custom page template) → loop mínimo →
  `get_template_part('template-parts/content', 'page-home')` → la estructura real del home vive
  en un **template-part** reutilizable, no dentro de la plantilla de página.

---

## 3. Ingredientes a **replicar** en el migración FGE

| # | Recomendación | Justificación |
|---|---|---|
| 1 | **Mantener `functions.php` como manifiesto**: sólo setup core (`add_theme_support`, register menus, custom-logo, custom-header) + 1 `require` a `assets/assets.php`. | Mirror ~100% del patrón probado. Plataforma clara setup/extension. |
| 2 | **Crear `assets/` espejo**: `assets/assets.php`, `assets/includes/{css,js,menu,widgets,modulos}-functions.php`, `assets/templates/{navs,footers}/`, `assets/librerias/{css,js}/`, `assets/modulos/`. | Path de las entidades ya validado. Escala por eje (estilo / script / menú widget / módulo). |
| 3 | **CSS del tema en `assets/librerias/css/style.css`**, no `style.css` de la raíz (que queda como ficha de cabecera del tema). | El `style.css` raiz es sólo metadato WP; el CSS del prototipo FGE (con tokens) es el contenido real. |
| 4 | **Encolar Bootstrap 5.3 + bootstrap-icons como form externo** (ya se hace en HTML; en WP debe moverse a `css-functions.php`). | Lifecicle administrado por WP, dependencias y single source de verdad. |
| 5 | **Usar `filemtime()` como versión** para el `style.css` fuente y para todos los JS propios. Hazlo también en CSS. | Cache-busting manual cero en desarrollo. |
| 6 | **Un script por feature en `assets/librerias/js/`** (carrusel, hero, marcasina…) + `main.js` orquestador con grafo deps. | FGE tiene carrouchels, grillas de noticias, ancho de páginas: natural mapping. |
| 7 | **`wp_localize_script()`** para flags/config que vengan desde theme mods / ACF a JS. | Necesario para la espera en FGE si se arma catálogo de países/noticias/o programas remotos. |
| 8 | **Reusar el walker Bootstrap 5 y los 2 menús (`menu-superior`, `menu-mobile`).** | FGE tiene topbar/header/nav ya maquetado — en WP se pinta vía `wp_nav_menu()` con este walker, no más HTML duplicado por página. |
| 9 | **Footer con zonas de widgets** (`fge-footer_navegacion`, `fge-footer_programas`, `fge-footer_transparencia`, `fge-footer_social`). | El footer FGE (4 columnas) es exactamente ese modelo. |
| 10 | **`assets/templates/footers/template-footer.php`** consume las zonas de widgets. | Reemplazo directo del footer.php de `_s` sin romperlo. |
| 11 | **Módulo de negocios con `register_rest_field()` + SCF fallback** bajo `assets/modulos/` (ej: `modulo-paises`, `modulo-noticias`, `modulo-programas`). | Es el patrón oficial FGE para **CPT (documentado en README)** + ACF, desacoplado del loop PHP para consumo front-end. |
| 12 | **Cola de includes en cascade `modulos-functions.php` → `assets/modulos/*.php`.** | Nuevos módulos se agendan aqui, sin tocar `functions.php`. |

---

## 4. Avisos / deudas del boilerplate observado (para sintonizar en el tema FGE)

### 4.0 Convención de trabajo del autor (contrato para el tema FGE)

> **Contexto:** la carpeta `assets/` es **reutilizable entre proyectos** (se comprime y descomprime
> tal cual de un tema a otro). La versión `js-avanzado-d2` aquí auditada quedó con la capa `assets/`
> **huérfana**: el tema no montaba header ni footer reales, por lo que `templates/navs/*` y las zonas
> de widgets quedaban abandonadas. En sitios convencionales (como FGE), la integración funciona así:

| Pieza | Ubicación | Conexión |
|---|---|---|
| `header.php` / `footer.php` | **Raíz del tema** | son los shells obligatorios de WP, no se eliminan |
| Navegación (header) | `header.php` apunta a `assets/templates/navs/` (via `get_template_part`) | markup nav desacoplado y reutilizable |
| Footer | `footer.php` apunta a las **zonas de widgets** (definidas en `widgets-functions.php`) y renderiza `dynamic_sidebar()` | contenido del footer **administrable desde el Panel de WordPress**, no hardcodeado |

**Regla de oro:** el contenido textual/dinámico (menús, columnas de footer, enlaces) **nunca se maqueta
a mano en PHP**: se alimenta desde el panel (menús + widgets), y `assets/` solo aporta el markup y estilos.

**Páginas: siempre page templates, nunca `front-page.php`:** no se usa `front-page.php`. Cada vista es una
**copia modificada del `page.php` de Underscores** que vive en la raíz del tema con su bloque de cabecera
`Template Name:` — ej.: `page-home.php` (landing), `page-transparencia.php`, `page-donacion.php`, etc.
El landing se asigna como página estática desde Ajustes → Lectura; el resto, eligiendo el template
desde el editor de la página en el Panel.

| Observación | Riesgo | Ajuste sugerido para FGE |
|---|---|---|
| `header.php` de `_s` (repetido en el head y clases `site-header`/`main-navigation` de `_s`) **NO apunta a `assets/templates/navs/nav-desk.php`** (no se ve ningun `get_template_part('assets/templates/navs/...')` en el header). | En FGE **integrarlos explícitamente** en `header.php` vía `get_template_part()`. | Definir cuál nav es la oficial para cada vista. |
| `modulos-functions.php` es sólo un include de profundidad. | Puede "ponderarse" si hay muchos módulos; usar `glob()`-based loop o lista declarativa. | listado declarativo explícito (evita `glob()` en producción). |
| Estilos con versión `null` en `estilo-tema` (sin cache-busting). | El JS usa `filemtime()` pero **el CSS queda sin versionado** en algunos records. En FGE aplicar `filemtime()` también al CSS del tema. | completado en punto 5. |
| Cadena jQuery (`jquery`, `jquery-ui-full`) para módulos que podrian ser vanilla. | Duplicacion de Peso. | FGE ya usa Bootstrap 5 (sin jQuery); decidir si mantener jQuery realmente necesario. |
| `\*Register\: nav \+ wp\_nav\_menu fallback `__return\_false"" sobre `menu-superior` | Si el menú no está asignado, no renderiza nada (nav vacío). | Definir fallback o garantizar la asignación en el ecommerce. |
| Script en `footer.php` `_s` estático (powered by) pero footer real en `assets/templates/footers/`. | Doble fuente de verdad en producción. | En FGE: que `footer.php` de `_s` sea un shell que llame el template real. |
| Textos no i18n (widgets, footers, generos echo sin `esc_html_e`). | No pasa el estándar `phpcs` + no traducible. | Usar textdomain `fge` consistentemente. |

---

## 5. Síntesis del "patrón Abanico" aplicado a la migración FGE

```
prototipo-fge/                         →   fge-theme/
├── 8 páginas HTML estáticas            →   plantillas WP (page.php, single.php,
│                                          archive.php + page templates con "Template Name:")
├── includes/{head,header,footer}.php   →   header.php / footer.php de WP en la raíz (shells)
│                                          header.php → get_template_part de assets/templates/navs/
│                                          footer.php → dynamic_sidebar() sobre zonas de widgets
│                                          (contenido del footer administrable desde el Panel)
├── components/{atoms,molecules,organismos} → assets/librerias/css/style.css (BEM único)
│                                          + markup vía template-parts/
├── assets/css/style.css (tokens FGE)   →   assets/librerias/css/style.css
│                                          (encolada en css-functions.php con filemtime())
├── Bootstrap 5.3 CDN hardcoded         →   wp_register_style/script('bootstrap', CDN)
│                                          en assets/includes/css-functions.php
│                                          y js-functions.php
├── JS (toggles, tabs) inline           →   assets/librerias/js/*.js
│                                          + main.js orquestador, encolado con filemtime()
├── sin backend                          →   assets/modulos/{paises,noticias,programas}/
│                                          core-*.php con register_rest_field() + CPT + ACF
│                                          (SCF), datos al front vía wp_localize_script()
└── CTA "Donar" estático                 →   widget/menú personalizado o ACF option page
```

**El esqueleto a armar en el tema FGE (índice de archivos):**

```
fge-theme/
├── style.css                        (metadatos: Theme Name: FGE)
├── functions.php                    (setup _s + require assets/assets.php)
├── header.php / footer.php          (shells: wp_head, wp_body_open, wp_footer + get_template_part)
├── page-home.php, page-transparencia.php, ... (copia modificada del page.php de _s,
│                                          con "Template Name:" en la cabecera — NO front-page.php)
├── page.php, single.php, archive.php, 404.php, search.php
├── inc/ (boilerplate _s intacto: template-tags, template-functions, customizer)
├── template-parts/ (content-*.php)
└── assets/
    ├── assets.php                   (hub de includes)
    ├── includes/
    │   ├── css-functions.php        (bootstrap CDN + tokens fge + estilo-tema con filemtime)
    │   ├── js-functions.php         (main.js + grafo deps, localize_script)
    │   ├── menu-functions.php       (menu-superior/menu-mobile + walker BS5 + logo)
    │   ├── widgets-functions.php    (4 zonas footer fge-*)
    │   └── modulos-functions.php    (carga assets/modulos/*)
    ├── templates/
    │   ├── navs/{nav-desk,nav-mobile}.php + nav.css   (mark-up identical BEM FGE)
    │   └── footers/template-footer.php
    ├── librerias/
    │   ├── css/style.css            (Los Tokens FGE + Atomos/Moleculas/Organismos BEM)
    │   └── js/{main,hero,carrusel,...}.js
    └── modulos/
        ├── modulo-paises/core-paises.php      (CPT pais + ACF + REST)
        ├── modulo-noticias/core-noticias.php  (CPT noticia + ACF + REST)
        └── modulo-programas/core-programas.php
```

> **Recomendación editorial:** el tema FGE debe portar también la decision de si se
> conserva el chasís `_s` completo o se hace un tema *lean*. La forma de abanico --
> separar setup core / assets / templates / modulos -- **funciona igual con ambos escenarios.**
