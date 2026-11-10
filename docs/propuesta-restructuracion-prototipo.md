# 🧭 Propuesta — Reestructuración del Directorio de Prototipado FGE

**Objetivo:** que `prototipo-fge` deje de ser una colección de páginas HTML sueltas y pase a ser el
**doppelgänger pre-WP del tema final**: misma filosofía de carpetas, mismo ritmo de módulos, mismo
contrato de header/footer/páginas. Así la migración deja de ser "traducir HTML a PHP" y pasa a ser
**ensamblar piezas que ya existen en su lugar correcto**.

**Convenciones tuyas (extraídas de lo que me has contado), que la propuesta respeta:**
1. `assets/` es el motor portable que viaja comprimido entre proyectos (markup + estilos, sin contenido).
2. `header.php` / `footer.php` como shells en la raíz → navs desde `assets/templates/navs/`, footer por widgets.
3. Páginas = page templates con `Template Name:` (copias del `page.php` de Underscores), nunca `front-page.php`.
4. Campos: SCF (+ fallback a `get_post_meta()`). JS: `js-functions.php` cableado desde el día uno.
5. Contenido dinámico según `docs/estrategia-theme-classic-wp.md` (CPTs: programas, organizaciones,
   alianzas, testimonios, transparencia, equipo + taxonomías `pais` y `linea_programa` + métricas
   vía Transients + sistema de campañas/alertas).

---

## 1. Diagnóstico del estado actual

```
prototipo-fge/
├── 8 *.html                          ← páginas monolíticas (CSS local, Inter, header/footer repetidos)
├── includes/{head,header,footer}.php ← intento de modularidad, incompleto
├── components/{atoms,molecules,organisms} ← carpetas VACÍAS (solo CSS en assets/css/)
├── assets/css/style.css              ← todo el sistema de tokens + BEM (bien ✅)
└── docs/                             ← informes + tu estrategia de contenido
```

Obstáculos que impiden que la migración sea mecánica:

- **`components/` vacía:** el markup BEM vive disperso dentro de las 8 páginas; no hay source-of-truth por componente.
- **Nada se llama entre sí:** no hay un "skeleton" que simule el flujo WP (header → contenido → footer).
- **Contenido hardcodeado:** los datos que hoy son texto en HTML (títulos de noticias, métricas, testimonios) mañana son CPT/SCF; hoy no hay separación markup ↔ data.
- **8 pares de `<style>` locales** (ver informe de auditoría: tonos de rosa distintos, tipografía Inter, etc.).

---

## 2. Estructura propuesta (el patrón "molde antes que maqueta")

```
prototipo-fge/
├── includes/                    ← shells raíz (los futuros header.php / footer.php del tema)
│   ├── head.php                 ← <head> único: CDN Bootstrap + fuentes + assets/css/style.css
│   ├── header.php               ← incluye el organismo nav (futuro: get_template_part de assets/templates/navs/)
│   └── footer.php               ← markup de shell + organismos del footer (futuro: dynamic_sidebar por widgets)
│
├── components/                  ← PIEZA CLAVE: source-of-truth por componente
│   ├── atoms/                   ← 1 archivo .php por átomo
│   │   ├── btn-fge.php
│   │   ├── badge-fge.php
│   │   └── ...
│   ├── molecules/               ← 1 archivo por molécula (futuro: template-parts/)
│   │   ├── card-noticia.php
│   │   ├── card-testimonio.php
│   │   ├── card-fge.php
│   │   └── ...
│   └── organisms/               ← 1 archivo por organismo (las "secciones" de página)
│       ├── navbar-fge.php
│       ├── footer-fge.php
│       ├── hero-fge.php
│       ├── grilla-noticias.php
│       ├── selector-pais.php
│       └── ...
│
├── pages/                       ← page templates pre-WP (futuros page-home.php, page-transparencia.php...)
│   ├── page-home.php            ← include head/header → organismos → footer
│   ├── page-pais.php            ← MOLDE parametrizado: recibe $pais (según estrategia §6)
│   ├── page-que-hacemos.php
│   ├── page-alianzas.php
│   ├── page-donacion.php        ← ojo: tu estrategia dice page-donaciones.php → usar singular/plural consistente
│   └── page-transparencia.php
│
├── bootstrap.php                ← datos + helper de includes (única puerta de entrada PHP del prototipo)
│
├── data/                        ← simulación SCF pre-WP (separación markup ↔ contenido)
│   ├── paises.php               ← arrays chile/argentina/uruguay con métricas, responsable local, etc.
│   ├── programas.php
│   ├── noticias.php
│   ├── testimonios.php
│   ├── alianzas.php
│   ├── transparencia.php        ← memorias/informes (futuro CPT transparencia)
│   ├── equipo.php               ← directorio + ficha de responsable local
│   └── campanas.php             ← sistema de alertas/campañas (estrategia §5)
│
├── assets/                      ← EL MOTOR PORTABLE (viaja de proyecto en proyecto)
│   ├── css/style.css            ← tokens + BEM (única hoja de estilos, donde hoy vive)
│   ├── js/                      ← futura correspondencia con assets/librerias/js del tema
│   └── templates/
│       └── navs/                ← markup nav reutilizable (nav-desk / nav-mobile)
│                                   (footers NO: en tu convención el footer siempre es por widgets)
│
└── docs/
    ├── informe-auditoria-tokens.md
    ├── informe-boilerplate-js-avanzado-d2.md
    ├── estrategia-theme-classic-wp.md
    └── MAPA-MIGRACION.md        ← manifest 1:1: archivo prototipo → archivo tema + tipo de transformación
```

### La idea central: data separada del markup

Cada componente PHP no maqueta textos: **consume arrays de `data/`**. Eso es exactamente lo que ocurrirá
con SCF: reemplazar `$datos = require data/noticias.php` por `SCF::get('subtitulo', $post_id)`, sin
tocar el markup. Ejemplo:

```php
<?php
// Pre-WP:  $noticia = fge_datos('noticias')[$i];
// En WP:   la misma variable saldrá de SCF::get() → el markup no se refactoriza
$c = $noticia;
?>
<article class="card-fge">
  <span class="badge-fge badge-fge--pais"><?= esc_html($c['pais']) ?></span>
  <h2 class="card-fge__titulo"><?= esc_html($c['titulo']) ?></h2>
  <p class="card-fge__resumen"><?= esc_html($c['subtitulo']) ?></p>
</article>
```

Regla: **las keys de `data/` deben llamarse idénticas a los meta_keys SCF previstos** en tu
estrategia (`pais`, `linea_programa`, `subtitulo`, `tiempo_lectura`, `credito_foto`…). Así el data file
se convertirá casi literal en la definición de campos del plugin después.

---

## 3. Procesos fijos (pipeline válido para cualquier proyecto futuro)

| # | Proceso | Regla (fija) |
|---|---|---|
| 1 | **Tokens primero** | Antes de maquetar: `assets/css/style.css` con tokens `:root` de la paleta del cliente. Ningún hex fuera de tokens en componentes ni páginas. |
| 2 | **Motor portable** | La carpeta `assets/` (css base, js, templates navs) se empaqueta y desempaqueta sin edición: 100 % agnóstica. Lo único por cliente: los tokens (prefijo, paleta) que viven en su bloque `:root` del cliente. |
| 3 | **Componente antes de página** | Toda pieza visual nueva se construye en `components/{atoms,molecules,organisms}` como archivo independiente; solo después se incluye desde una página. Prohibido markup "puntual" inline en páginas. |
| 4 | **Data antes de markup** | Al crear un componente con contenido dinámico: primero su shape en `data/entidad.php` (contrato SCF final), luego el markup que lo consume. |
| 5 | **Página = composición de includes** | Un page template no maqueta: `includes/head.php` + organismos + `includes/footer.php`. Si una vista necesita markup único, se migra a organismo/molécula. |
| 6 | **Un solo `<head>`** | Los recursos (CDN Bootstrap, Envolventa/Lato, style.css) se declaran UNA VEZ en `includes/head.php`. Las páginas no traen `<link>`. |
| 7 | **Manifest vivo** | Al cierre, `docs/MAPA-MIGRACION.md` documenta: cada archivo prototipo → archivo tema + transformación (copiar tal cual / hook WP / data→SCF). |
| 8 | **Simulación anticipada de WP** | Todo include helper (`fge_component()`, `fge_datos()`) se escribe con firma que mañana se traducirá 1:1 a `get_template_part()` / `SCF::get()`. |

**Flexibilidad:** lo único que cambia por proyecto es (a) tokens, (b) entidades de `data/`,
(c) page templates. El motor, el pipeline, la convención de naming y el flujo de datos son inmutables.

---

## 4. Reglas de naming (compatibles hacia adelante con el tema)

- Archivos de componentes: `kebab-case.php` (`card-noticia.php`, `btn-fge.php`).
- Clases de salida: exactamente las del CSS BEM (`card-fge__titulo`, `btn-fge--primary`) — el markup del prototipo ya es el markup final del tema.
- `data/` con keys idénticas a los meta_keys SCF de la estrategia.
- Páginas ya desde ahora `page-*.php`: al migrar solo se les agrega la cabecera `/* Template Name: ... */`.
- Un solo origen de estilos: `assets/css/style.css` (los per-token y BEM). Cero `<style>` inline por página.

---

## 5. Roadmap de adopción sobre el prototipo actual

1. **P0 — Normalizar el CSS:** eliminar los 8 `<style>` locales, declarar recursos una sola vez en `includes/head.php`, colores regulados por tokens (pasos P0 del informe de auditoría §7).
2. **P0 — Activar shells:** `includes/header.php` y `footer.php` dejan de estar abandonados y pasan a componer nav/footer desde organismos.
3. **P1 — Vaciar `components/`:** recorrer las 8 páginas e identificar los bloques repetidos (badges, cards, hero, grilla de noticias, testimonios, selector de país) → 1 archivo PHP por bloque.
4. **P1 — Data files:** extraer el contenido dinámico visible en el prototipo hacia `data/{paises,noticias,testimonios,programas,alianzas,transparencia,equipo,campanas}.php`, usando las keys SCF de la estrategia.
5. **P2 — Páginas a PHP:** convertir las 8 páginas a `pages/page-*.php`, compuestas únicamente por includes.
6. **P2 — Motor portable auditado:** revisar que `assets/` no contenga nada proyectado FGE fuera de los tokens; dejar `assets/js/` lista con el contrato de nombres que usará `js-functions.php`.
7. **P3 — MAPA-MIGRACION.md:** manifest archivo por archivo prototipo → tema.
8. **P4 — Scaffolding del tema:** con el prototipo así, armar el tema mínimo (Underscores + tu motor `assets/` + page templates + módulos SCF/REST según estrategia) es ensamblar, no traducir.

---

*Documento de propuesta. No se movió ni renombró nada todavía: cualquier cambio de estructura se acuerda antes en el chat.*
