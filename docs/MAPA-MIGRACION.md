# 🗺️ MAPA DE MIGRACIÓN — Prototipo FGE → Tema WordPress

> Manifest vivo (contrato de la skill `prototipado-pre-wp`, proceso #7):
> cada archivo migrado al patrón se registra aquí con su destino en el tema
> y la transformación requerida. Actualizar con CADA página/pieza nueva.

| Origen (prototipo) | Destino en tema WP | Transformación |
|---|---|---|
| `bootstrap.php` | `functions.php` + `assets/assets.php` | reemplazar helpers por hooks WP (`get_template_part`, `SCF::get`, `WP_Query`) |
| `includes/head.php` | `header.php` (parte) | `<head>` → `wp_head()`; encolados → `css-functions.php` |
| `includes/header.php` | `header.php` | shells → markup templático |
| `includes/footer.php` | `footer.php` | shell + cierre |
| `components/**` | `template-parts/**` | **casi copia directa** (markup intacto) |
| `data/*.php` (campos) | grupos de campos SCF | keys = meta_keys, crear en plugin |
| `data/posts-*.php` (colecciones) | CPTs + `WP_Query` | keys de query = criterios ya escritos |
| `assets/css/style.css` | `assets/librerias/css/style.css` | copia (encolada con `filemtime`) |
| `assets/css/bridge.css` | ❌ NO migra | deuda P2: debe morir antes de migrar |
| `landing.html` (respaldo) | `page-home.php` (Template Name: Inicio) | — |

---

## ✅ Auditoría del piloto — `pages/page-home.php` (Fase 2, 09/11/2026)

| Check | Resultado |
|---|---|
| Render correcto (200 OK, 16 secciones, cierre limpio) | ✅ |
| Un solo `<head>` con recursos (Bootstrap + style.css + bridge.css) | ✅ |
| 0 referencias a tipografía Inter / Google Fonts (fuentes locales Envolventa/Lato) | ✅ |
| 0 hex fuera de `bridge.css` en páginas y componentes | ✅ (grep vacío) |
| 0 `<style>` inline de página; `<style>` markup único restante = geometría (width píxeles, aria) | ✅ aceptado |
| Header/footer vía shells (topbar/navbar/footer como organismos) | ✅ |
| Componentes sin texto hardcodeado (consumen `data/`) | ✅ |
| Documentación de contrato en cabecera de cada componente | ✅ |
| Puente de colores: navy→purple-900, fuchsia→pink-base, teal→cyan-base | ✅ (marcado como deuda P2 en bridge.css) |

### Deudas registradas (puente, P2)
1. `bridge.css` completo se elimina cuando las secciones pasen a BEM real (`.card-fge__*`).
2. Token faltante en sistema: `cyan-700` (hover teal) y `neutral-200/300` (superficies grises). Crear en `style.css` per estrategia de conversión de deuda.
3. `fge_base` calculado por la página y pasado a componentes — propiedad de la eliminada Prototipo incluye cuando se migrar es suspiciously: en MVP; en WP será innecesario (los assets se encolan por WP).

### Estado de páginas (progreso del patrón)

| Página | Estado |
|---|---|
| `page-home.php` | ✅ Piloto migrado y auditado |
| `page-pais.php` | ✅ Molde paramétrico migrado (?pais=slug, 3 países + fallback) · auditado Fase 2 |
| resto (6) | ⏳ pendientes de replicar patrón |

### ✅ Auditoría del molde — `pages/page-pais.php` (09/11/2026)

| Check | Resultado |
|---|---|
| Render: 3 países 200 OK + `?pais=invalido` → fallback al primero sin error | ✅ |
| 0 menciones de país concreto en la plantilla (regla del molde) | ✅ |
| 0 hex fuera de bridge / 0 estilo inline nuevo | ✅ |
| Reuso de moléculas del piloto SIN rewrites: banner-cta (×3, param `fondo`), logo-alianza, card-colaborar, card-testimonio (param `estilo`), metrica-counter (param `fondo`) | ✅ 5/5 |
| Moléculas nuevas: card-organizacion, card-noticia, contacto-local + organism hero-pais, con contrato data/SCF documentado | ✅ |
| Data nueva: impacto-local (→transient futuro), posts-programas, posts-organizaciones (keys SCF estrategia) | ✅ |
| Bootstrap JS agregado al shell de footer (collapse del navbar) | ✅ |

**Notas de unificación:** `por-pais.html` usaba footer con `bg-brand-dark` — el molde adopta el footer global del shell (`bg-brand-navy`); diferencia aceptada por igualar en tokens purple. El botón pill `btn-brand-pink` del mockup se renderiza con el mismo rosa vía bridge (`--fge-color-pink-base`).

---

*Próxima entrada del manifest cuando se audite cada página nueva.*

---

## ✅ Auditoría Figma MCP — Testimonios (10/11/2026)

Fuente: Figma `Wireframes | Fundación Gestionar Esperanzas`, file `6de6Qn0KN9yS9XIOuhSCJ1`, nodo `478:4726` (`SecciónTestimonios`), leído vía `get_design_context`.

| Spec Figma (exacta) | Estado en prototipo |
|---|---|
| Fila 3 tarjetas `flex-1` + gap 24px (3×448.67 + 2×24 = container 1394) | ✅ `row g-4` + `col-md-4` (Bootstrap, pedido del cliente) |
| Sección: padding 80px horizontal / 64px vertical, bg white | ~ (aproximado con clases del piloto) |
| Título: Outfit SemiBold 39.81/48 `#4c4688`; subtítulo Lato 16 `#616161` | ~ tokens purple-900 ✔; el gris `#616161` aún sin token |
| Tarjeta border `#e0e0e0` radius 8, altura 401px fija | ~ nuestro: aspect 1:1 (decisión cliente sobre alto fijo) |
| Placeholder fondo `#e0e0e0`, ícono 67px | ✅ #ececee (deuda neutral-200 documentada) |
| Badge "Programa 1" (top16/left16, blanco, borde, texto #4c4688) | ⏳ no existe aún: nuestros testimonios no llevan campo `programa` (se eliminó con el rediseño) — re-evaluar cuando se agregue data de programa |
| Hover card del landing: BLANCA, nombre `#383165` 24px, cita en recuadro borde `#4c4688` radius 12 | 🔑 **DECISIÓN CONSOLIDADA:** el landing y la sección país difieren (inconsistencia Figma); el cliente unifica en **overlay morado con texto blanco** en ambos contextos. Documentado en `style.css` §6.2 |

**Tokens nuevos detectados (agregar a `:root` en próxima pasada de deuda):**
- `#383165` (morado más profundo que purple-900 → proponer `purple-1000`)
- `#616161` / `#212121` / `#e0e0e0` (grises de texto/borde/placeholder de los wireframes)

**Método:** primera auditoría hecha con **Figma MCP** en vez de captura pegada —
números exactos de grid/gap/colores sin adivinación. **ACTUALIZADO 10/11/2026:** el
MCP se usa como herramienta de *descubrimiento puntual*, no por página (costo
 Starter no presupuestado); a futuro la fuente de diseño por página es
mockup + capturas PNG (ver skill "Modo sin MCP de Figma").

## ✅ Auditoría — `pages/page-transparencia.php` (10/11/2026)

Diseño combinado: **estructura de `transparencia.html`** (tabs por país —
preferido del cliente) + **specs Figma `478:3987`** (hero, banner CTA).

| Pieza | Estado |
|---|---|
| Molécula `tabs-documentos` (§6.4 CSS, tokens, sufijos únicos) | ✅ nueva |
| Modelo directorio: país + tipo + año + archivo por documento | ✅ `data/posts-transparencia.php` (futuro CPT + SCF) |
| País/activo: Chile/Argentina/Uruguay activos; Colombia/Perú/México futura expansión | ✅ flag en `data/paises.php` + helper `fge_paises()` |
| Fallback país inactivo (`?pais=colombia` → Argentina) | ✅ verificado |
| Hero via `hero-simple` (bug `$fge_hero` vs `$hero` corregido) | ✅ |
| Directivos con foto placeholder (`foto => ''`) | ✅ SVG retrato, sin imagen real |
| Deuda terse | docs hrefs `#` hasta existir page-donación / PDFs reales |

## ✅ Auditoría — `pages/page-que-hacemos.php` (10/11/2026)

Diseño combinado: **Figma `478:2771`** (definitivo) + **estructura
`que-hacemos.html`**, normalizada a tokens.

| Pieza | Estado |
|---|---|
| `hero-simple` extendido con CTA opcional (contrato único de hero interior) | ✅ |
| `mapa-ubicacion` organism (placeholder 21:9 + `bi-geo-alt`) | ✅ nueva; captura real pendiente |
| Normalización de color: success/info/danger del mockup → morado marca | ✅ documento en §6.5 |
| Model (nuevos): `card-dimension` + `data/dimensiones.php`, `programa-fila` + `data/posts-iniciativas.php` (5 programas, chips, caso Volutiva-Chile, campañas), `card-caso-org` + `data/posts-casos.php` (flag destacado) | ✅ |
| Bug Bootstrap `.ratio > *` (100%×100% a hijos): badge país estirado, icono sin centrar | ✅ fixed patrón wrapper-relative en card-caso-org + heurística aplicada (card-noticia, card-organizacion) |
| Íconos: Bootstrap Icons 1.11.3 CDN global (head.php) | ✅ regla registrada en skill |
| Deuda tersa | tokens neutral-200/300 aún literales; iconos dimension definitivos del Figma por confirmar vía capturas |

## ✅ Auditoría final — páginas restantes + cierre de deuda (10/11/2026)

| Página | Fuente | Piezas nuevas |
|---|---|---|
| `page-alianzas` | alianzas.html + specs 478:3634 mapeadas | `paso-proceso`, `pilar-alianza` + data `pasos-alianza`/`pilares-alianza`; `form-alianza` organism (país ← `fge_paises()`); hero-simple + keys `etiqueta`/`subtitulo` (opcional: cero impacto en otras páginas) |
| `page-donacion` | donacion.html | `selector-pais` (selección por `?pais=`, flechas del mockup eran decorativas), `form-donacion` (responsable local ← relación país→equipo), testimonios del país |
| `page-noticias` + `page-noticia` | noticia-grilla.html / nooticia.html | `filtros-noticia` (país+programa funcionales por query; fecha/categoría = facets futuros), badge de programa en `card-noticia`, data normalizada (linea_programa + secciones/cita para el single) |

**Cierre del puente (plan B aprobado):** `bridge.css` eliminado. Mudanzas con
nombre del sistema a `style.css` (§4): `.bg-purple-950`, `.bg-neutral-200`
(deuda token); sed de todos los usos (text-brand-navy→primary; bg-brand-navy→purple-950;
bg-brand-gray→neutral-200; btn-brand-fuchsia/pink→btn-fge--primary; contacto-local
con íconos bootstrap-icons). Un solo cascade — estilo `wp_enqueue` único en WP.

**Estado final del prototipo:** 8 páginas (home, país, qué-hacemos, transparencia,
alianzas, donación, noticias, noticia) — curl 200 en todas con variaciones
?pais/?id. Deudas: tokens neutral-200/300 (literales documentadas), PDFs/e-mágenes
reales pendientes de data, hrefs `#` hasta páginas internas conectadas.
