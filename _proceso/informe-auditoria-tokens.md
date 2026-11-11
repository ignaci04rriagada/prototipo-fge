# 🔍 Informe de Auditoría — Cumplimiento de Design Tokens FGE

**Fecha:** 09/11/2026 · **Alcance:** 8 páginas HTML del prototipo
**Referencia de verdad:** `assets/css/style.css` + `README.md` (Manual de Marca)

---

## 1. Resumen ejecutivo

| Métrica | Resultado |
|---|---|
| Páginas auditadas | 8 (`landing`, `por-pais`, `alianzas`, `transparencia`, `nooticia`, `noticia-grilla`, `que-hacemos`, `donacion`) |
| Páginas que enlazan `style.css` | **0 / 8** ❌ |
| Páginas con paleta local propia (`--brand-*`) | **8 / 8** ❌ |
| Páginas con tipografía incorrecta (Inter) | **8 / 8** (debe ser Envolventa + Lato) ❌ |
| Uso de átomos BEM (`.btn-fge`, `.card-fge`) | **0** — utilidades inventadas (`fs-xs`, `bg-brand-*`, `tracking-tight`) |
| Uso de includes modulares (`includes/header.php`, `footer.php`) | **0** — header/footer maquetados a mano (+5 variantes distintos) |

**Gravedad del drift cromático:** coexisten **al menos 6 tonos de rosa/pink distintos**
(`#ff2471`, `#e82572`, `#e02475`, `#E8256D`, `#E6007E`, `#ec407a`, `#ED2578`, `#E93D74`). La identidad
de marca se degrada por página y dificulta la futura migración a tema WordPress.

---

## 2. Paleta oficial (devocionario de tokens)

| Rol | Token | Valor hex |
|---|---|---|
| Primario / Marca (30%) | `--fge-color-brand-primary` | `#4c4688` |
| Marca hover / dúo | `--fge-color-brand-hover` | `purple-700` |
| Marca oscuro | `--fge-color-brand-dark` | `purple-950` |
| Acento cian (20%) | `--fge-color-bg-accent-cyan` | `#1baac1` |
| Acento verde (15%) | `--fge-color-bg-accent-green` | `#199d6b` |
| Acento lima (10%) | `--fge-color-lime-base` | `#5da430` |
| CTA principal (15%) | `--fge-color-action-primary` | `#ff2471` |
| CTA hover | `--fge-color-action-primary-hover` | `#ff2471d8` |
| Donación (10%) | `--fge-color-action-donate` | `#ff2471` (mismo token semántico) |
| Amarillo donación | `--fge-color-yellow-base` | `#ffc04c` |
| Texto principal | `--fge-color-text-main` | `neutral-900` (`#1a1a1a`) |
| Texto secundario | `--fge-color-text-muted` | `neutral-600` |
| Fondo página | `--fge-color-bg-main` | `neutral-100` (`#fafafa`) |
| Sombras / radios / espacios | `--fge-shadow-md`, `--fge-radius-*`, `--fge-space-*` | — |

---

## 3. Tabla de equivalencias por página

> Criterio: mapeo al token oficial **más cercano** (decisión acordada: normalizar).

### 3.1 `landing.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-navy` | `#22234B` | `--fge-color-brand-dark` (purple-950) |
| `--brand-dark` | `#1c1a3b` | `--fge-color-brand-dark` |
| `--brand-fuchsia` | `#ED2578` | `--fge-color-action-primary` (`#ff2471`) |
| `--brand-fuchsia-hover` | `#d01d68` | `--fge-color-action-primary-hover` |
| `--brand-teal` | `#00838F` | `--fge-color-bg-accent-cyan` (`#1baac1`) |
| `--brand-teal-hover` | `#006973` | variante `-700` del cian |
| `--brand-gray-bg` | `#E9E9EB` | `--fge-color-bg-main` |
| `--brand-card-bg` | `#E7E7E9` | `--fge-color-bg-main` / neutral-200 |

### 3.2 `por-pais.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-dark-purple` | `#2c254d` | `--fge-color-brand-dark` |
| `--brand-purple-banner` | `#302758` | `--fge-color-brand-dark` |
| `--brand-purple-card` | `#353363` | `--fge-color-brand-hover` (purple-700) |
| `--brand-pink` | `#e82572` | `--fge-color-action-primary` |
| `--brand-pink-hover` | `#cf1b63` | `--fge-color-action-primary-hover` |
| `--brand-cyan` | `#1db5cf` | `--fge-color-bg-accent-cyan` |
| `--brand-green` | `#1cb07c` | `--fge-color-bg-accent-green` |
| `--brand-green-banner` | `#159664` | verde `-700` |
| `--brand-gold` | `#f5aa38` | `--fge-color-yellow-base` (`#ffc04c`) |
| `--brand-gray-bg` | `#e5e7eb` | `--fge-color-bg-main` |

### 3.3 `noticia-grilla.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-dark` | `#1D1E3A` | `--fge-color-brand-dark` |
| `--brand-navy` | `#2A295C` | `--fge-color-brand-dark` |
| `--brand-footer` | `#4F4C8F` | `--fge-color-brand-primary` (`#4c4688`) |
| `--brand-accent` | `#E6007E` | `--fge-color-action-primary` |
| `--brand-accent-hover` | `#C8006E` | `--fge-color-action-primary-hover` |
| `--brand-badge-blue` | `#0072BC` | ⚠️ fuera de paleta (azul no existe) → usar cian/green según categoría |
| `--brand-badge-orange` | `#F58220` | `--fge-color-yellow-base` |
| `--brand-badge-teal` | `#00A887` | `--fge-color-bg-accent-green` |
| `--brand-gray-bg` / `#9CA3AF` / `#374151` | | `--fge-color-text-muted` / `neutral-*` |

### 3.4 `nooticia.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-purple` | `#373278` | `--fge-color-brand-primary` |
| `--brand-purple-dark` | `#292558` | `--fge-color-brand-dark` |
| `--brand-purple-tag` | `#4C4282` | `--fge-color-brand-primary` ✅ (el más fiel de todas las páginas) |
| `--brand-pink` | `#E8256D` | `--fge-color-action-primary` |
| `--brand-pink-hover` | `#c91a5b` | `--fge-color-action-primary-hover` |
| `--brand-teal` | `#00A99D` | `--fge-color-bg-accent-green` |
| `--brand-teal-dark` | `#00877d` | verde `-700` |
| `--brand-green` | `#27AE60` | `--fge-color-bg-accent-green` |

### 3.5 `alianzas.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-topbar` | `#1e1b4b` | `--fge-color-brand-dark` |
| `--brand-navy` | `#1b1b3a` | `--fge-color-brand-dark` |
| `--brand-deep-purple` | `#37326e` | `--fge-color-brand-primary` |
| `--brand-footer` | `#3f3a74` | `--fge-color-brand-primary` |
| `--brand-badge-bg` | `#2b245c` | `--fge-color-brand-dark` |
| `--brand-pink` | `#ec407a` | `--fge-color-action-primary` |
| `--brand-pink-hover` | `#d81b60` | `--fge-color-action-primary-hover` |
| `--brand-bg` / `#f1f5f9` / bordes `#cbd5e1` | | `--fge-color-bg-main` / `--fge-color-border-subtle` |

### 3.6 `transparencia.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-purple` | `#4B3F72` | `--fge-color-brand-primary` ✅ |
| `--brand-dark-purple` | `#3B315A` | `--fge-color-brand-primary` |
| `--brand-pink` | `#E93D74` | `--fge-color-action-primary` |
| `--brand-pink-hover` | `#c92c5e` | `--fge-color-action-primary-hover` |
| `--brand-gold` | `#F4B23F` | `--fge-color-yellow-base` |
| `--brand-cyan` | `#00A8B5` | `--fge-color-bg-accent-cyan` ⚠️ |
| `--brand-gray-bg` | `#F3F4F6` | `--fge-color-bg-main` |
| SVG inline `stroke="#00A8B5"` / `stroke="#F4B23F"` | | mover a CSS con tokens (`stroke: var(--fge-color-bg-accent-cyan)`) |

### 3.7 `que-hacemos.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-purple` | `#37326B` | `--fge-color-brand-primary` |
| `--brand-dark` | `#1A1830` | `--fge-color-brand-dark` |
| `--brand-pink` | `#E6007E` | `--fge-color-action-primary` |
| `--brand-pink-hover` | `#c8006e` | `--fge-color-action-primary-hover` |
| `--brand-gray-bg` / `--brand-light-gray` | | `--fge-color-bg-main` |
| `#eff6ff/#1d4ed8/#dbeafe`, `#ecfdf5/#047857/#d1fae5`, `#fdf2f8/#fce7f3` | | ⚠️ badges Tailwind azul/verde/rosa fuera de paleta → cian, verde y rosa FGE |

### 3.8 `donacion.html`

| Local | Hex | → Token oficial |
|---|---|---|
| `--brand-purple` | `#3b3a6e` | `--fge-color-brand-primary` |
| `--brand-pink` | `#e02475` | `--fge-color-action-donate` |
| `--brand-pink-hover` | `#c01b61` | `--fge-color-action-primary-hover` |
| `--brand-gray-bg` | `#f8f9fa` | `--fge-color-bg-main` |

---

## 4. Tipografía

- **Actual:** todas las páginas cargan `Inter` (Google Fonts) y definen `font-family` en `<body>`
  con colores de texto propios (`#1F2937`, `#333333`, `#374151`, `#334155`, `#1e293b`).
- **Debiera ser:**
  ```css
  h1..h6 { font-family: var(--fge-font-family-headings); } /* Envolventa */
  body    { font-family: var(--fge-font-family-base);      /* Lato */
            color: var(--fge-color-text-main); }
  ```
- Los tamaños ad-hoc (`fs-xs`: 0.75rem, `fs-xxs`: 0.65rem) violan la escala Minor Third (1.2)
  definida en los tokens (`--fge-font-size-*`). Mínimo legible sugerido: `--fge-font-size-sm` (0.833rem).

---

## 5. Utilidades inventadas vs. BEM

| Clase actual | Reemplazo sugerido |
|---|---|
| `.btn-brand-pink` / `.btn-fuchsia` (×8 variantes) | `--btn-fge` (átomo existente en `components/atoms`) |
| `.bg-brand-*`, `.text-brand-*` (estilos embebidos con `!important`) | clases BEM del organism/molecule correspondiente |
| `.fs-xs`, `.fs-xxs`, `.tracking-*`, `.leading-relaxed` | tokens `--fge-font-size-sm` / `line-height-*`; eliminar utilities Tailwind-style |
| Cards armadas con Bootstrap puro | `.card-fge` (molecule) |
| Header/footer repetidos en cada página | `includes/header.php` + `includes/footer.php` con `require_once` |

---

## 6. Estructura modular

Se detectan **al menos 5 versiones distintas** del topbar + navbar + footer entre las páginas,
todas con logos y SVG inline duplicados. En MAMP lo correcto es:

```php
<?php require_once __DIR__ . '/includes/head.php'; ?>
<body>
<?php require_once __DIR__ . '/includes/header.php'; ?>
<!-- contenido -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
```

Esto elimina ~200–300 líneas duplicadas por página y es el patrón que se traducirá
directamente a `get_header()` / `get_footer()` en el tema WordPress.

---

## 7. Prioridades de corrección (orden sugerido)

1. **P0 — Enlazar `assets/css/style.css` en las 8 páginas y eliminar los `<style>` locales** (mayor impacto, menor costo).
2. **P0 — Unificar tipografía:** remover Inter, aplicar Envolventa/Lato y colores de texto por tokens.
3. **P1 — Extraer header/footer a `includes/header.php` y `includes/footer.php`**, elegir la mejor versión de navbar como base.
4. **P1 — Reemplazar `.btn-brand-*` por el átomo `.btn-fge`** y normalizar CTAs de donación al rosa oficial.
5. **P2 — Resolver colores fuera de paleta** (azules de badges en `que-hacemos`/`noticia-grilla`, teal de `landing`): definir si cian FGE o crear token extremo documentado en el Manual de Marca.
6. **P2 — Mover SVG con colores hardcodeados** (`transparencia.html`) a CSS con tokens.
7. **P3 — Consolidar componentes repetidos (cards, grillas de noticias) en molecules/organisms** según la hoja de ruta del README.

---

*Informe autogenerado a partir de un análisis estático de los archivos. No se modificó ningún archivo de código.*
