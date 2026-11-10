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

**Método:** primera auditoría hecha con **Figma MCP** en vez de captura pegada — números exactos de grid/gap/colores sin adivinación. En adelante: link de Figma → MCP como fuente primaria; captura PNG solo como fallback.
