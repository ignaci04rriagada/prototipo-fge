# Informe de Auditoría — Detalles visuales (P0 → P3)

**Alcance:** header/topbar/footer (shells globales), dropdown de países, selector de país
(donación), utilidades fantasma del mockup y consistencia de espaciado contra tokens.
**Origen:** reporte del cliente — dropdown bajo el nav, hovers "esfumados",
inconsistencias de espaciado.
**Fecha:** 2026-11-10 · Archivo auditado: `assets/css/style.css` + organismos globales.

## Diagnóstico raíz

El CSS tenía un bloque de **topbar/selector de país huérfano** (`.topbar-fge`,
`.country-select-fge`, `.country-dropdown-fge`, `.topbar-fge__socials` ≈ 120 líneas)
que ningún PHP consumía, mientras que el markup real declaraba clases **sin
definir** en `style.css` (`.fge-topbar-paises`, hovers del toggle, links del footer).
El resultado: estilos diseñados para elementos que no existen, y elementos reales
quedando solo con los defaults de Bootstrap.

## Hallazgos resueltos

| ID | P | Hallazgo | Corrección |
|----|---|----------|------------|
| V-01 | P0 | Dropdown de países tapado por el navbar: `sticky-top` crea stacking en **1020**; `dropdown-menu` queda en su **1000** default | `.fge-topbar-paises { position: relative; z-index: 1035; }` |
| V-02 | P0 | Hover del toggle "Selecciona un país": dependía de `opacity-75 opacity-100-hover`, utilidades que existían solo en los mockups HTML | Átomo BEM `.fge-topbar-paises__toggle` (base 75% → hover/focus 100% + fondo translúcido) |
| V-03 | P0 | Links del footer con `text-white-50` y ningún hover sobre superficie morada | Átomo `.footer-fge__link` (white/60 → white/100 con `--fge-transition-base`) |
| V-04 | P0 | Links del navbar usaban `.nav-link text-dark fw-semibold` (default de Bootstrap) en vez del átomo del sistema | Markup → `.nav-link-fge` (hover + subrayado animado con `--fge-color-action-primary`) |
| V-05 | P1 | CSS inline en `selector-pais.php` (`style="border-color:..."`) — viola el contrato "cero inline" | Clase `selector-pais__card--seleccionada` consumiendo `--fge-color-brand-primary` |
| V-06 | P1 | Items del dropdown de países con `dropdown-item` default de Bootstrap | Hover/focus → `--fge-color-action-primary`, padding con tokens |
| V-07 | P1 | `.fs-xxs`, `.fw-black`, `.tracking-tight`, `.tracking-wider`, `.opacity-*-hover` se consumían masivamente en páginas pero no estaban definidas | Promovidas a §7 Utilities, mapeadas a tokens (deuda: `--fge-font-size-3xs`) |
| V-08 | P1 | Token roto: `color: var(--fge-color-text-)` (typo) en `.country-select-fge` | Bloque huérfano eliminado (caía con V-09) |
| V-09 | P2 | ~120 Líneas de CSS muerto (topbar/selectores que el markup no usa) | Eliminadas; el organismo quedará "limpio" y pequeño |

## Deudas documentadas (pendientes — no bloquean)

| ID | P | Deuda | Acción sugerida |
|----|---|-------|-----------------|
| D-01 | P2 | `.badge-fge` referencia `--fge-color-accent-soft` (inexistente, cae a `#eef7f6`) | Pedir al cliente OK para crearlo en §1 |
| D-02 | P2 | `.nav-tabs-doc-fge` referencia `--fge-font-weight-semibold` (inexistente, cae a `600`) | Promover a §1 |
| D-03 | P2 | `--fge-font-size-xs` referenciado en testimonios/filtros (inexistente; fallbacks 0.65rem / 0.75rem) | Crear token `--fge-font-size-xs: 0.75rem` (o 3xs) |
| D-04 | P2 | Familia neutral incompleta: `neutral-200/300` con fallbacks `#f0f0f0`/`#e0e0e0` | Registrar en MAPA-MIGRACION para la próxima pasada de tokens |
| D-05 | P3 | Espaciado: mezcla utilidades Bootstrap (`py-1`/`pt-5`/`gap-2`) y tokens fge. No es bug: Bootstrap no mapea sus paddings a vars de espaciado. Opciones: (a) aceptarlo como capa de layout, (b) override `--bs-border-radius`/`--bs-body-font-size` hacia tokens | Decisión del cliente |
| D-06 | P3 | CTA navbar mezcla `btn-fge` + `btn-sm px-4 rounded-pill` de Bootstrap | Consolidar en modificador `btn-fge--nav` |

> Nota D-05: el espaciado quedó controlado donde importa (§7 mapea
> `--bs-gutter-x` a 24px y márgenes de contenedor 80px desktop / 16px mobile
> a tokens de la grilla Figma).

## Archivos tocados

- `assets/css/style.css` — bloque §6.0 reescrito contra el markup real, z-index fix, utilidades promovidas, deuda inline del selector resuelta.
- `components/organisms/topbar-paises.php` — toggle → átomo BEM.
- `components/organisms/navbar-fge.php` — links → `.nav-link-fge`.
- `components/organisms/footer-fge.php` — 11 links → `.footer-fge__link`.
- `components/organisms/selector-pais.php` — CSS inline eliminado (`V-05`).
