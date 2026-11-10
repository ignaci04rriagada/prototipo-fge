---
name: Prototipado Pre-WP
description: >
  Flujo de trabajo del autor para maquetar prototipos HTML/PHP pre-WordPress de sitios
  institucionales (Atomic Design + BEM + Design Tokens), diseñado para que la migración
  futura a tema WordPress sea ensamblar, no traducir. Usar cuando se cree, audite o
  reestructure un prototipo en carpetas de maquetación estática.
---

# Skill: Prototipado Pre-WordPress (doppelgänger del tema)

Este flujo maqueta prototipos que son el **"doppelgänger pre-WP" de un tema WordPress**:
misma estructura mental, mismos nombres de archivos y mismas fronteras de responsabilidad.
El objetivo es que migrar a WordPress sea **ensamblar piezas ya situadas**, no traducir HTML.

## Convenciones del autor (CONTRATO, no negociable)

1. **`assets/` es el motor portable**: esta carpeta viaja comprimida entre proyectos sin edición
   (markup + estilos genéricos). Solo se personaliza el bloque de tokens del cliente.
   Nunca hardcodear contenido del cliente fuera de los tokens dentro del motor.
2. **Un solo `<head>`**: los recursos (CDN Bootstrap 5.3, fuentes, `assets/css/style.css`) se
   declaran UNA VEZ en el shell de `<head>`. Las páginas nunca traen `<link>`/`<style>` propios.
   Cero CSS inline por página.
3. **Header/footer como shells en la raíz**: nunca se maqueta el nav ni el footer dentro de una
   página. El header compone desde `assets/templates/navs/`; el footer se maqueta pensando en que
   mañana será administrable por widgets (columnas = zonas dinámicas).
4. **Componente antes de página**: toda pieza visual nueva nace como archivo independiente en
   `components/`. Prohibido markup "puntual" inline en páginas.
5. **Data antes de markup**: todo componente con contenido dinámico consume arrays de `data/`.
   Nunca texto hardcodeado en HTML para contenido que será dinámico en WP.
6. **Páginas compuestas, no maquetadas**: cada página es una composición de includes
   (head → organismos → footer). Si una vista necesita markup único, se extrae a organismo/molécula.

## Estructura de directorio objetivo

```
prototipo/
├── includes/                    ← shells raíz (futuros header.php / footer.php del tema)
│   ├── head.php                 ← <head> único: CDN + fuentes + style.css del cliente
│   ├── header.php               ← compone nav desde assets/templates/navs/
│   └── footer.php               ← shell + organismos de footer (columnas → futuras zonas de widgets)
├── components/                  ← source-of-truth por componente
│   ├── atoms/                   ← 1 archivo .php por átomo (btn-<prefijo>.php, badge-<prefijo>.php...)
│   ├── molecules/               ← 1 archivo por molécula (futuro: template-parts/)
│   └── organisms/               ← 1 archivo por organismo/sección (navbar, hero, grillas, selector...)
├── pages/                       ← page templates pre-WP, YA con nomenclatura page-*.php
├── bootstrap.php                ← helper de includes + carga de datos (única puerta PHP)
├── data/                        ← simulación SCF: 1 archivo por entidad, keys = futuros meta_keys
├── assets/                      ← EL MOTOR PORTABLE
│   ├── css/style.css            ← tokens del cliente (:root) + BEM (única hoja de estilos)
│   ├── js/                      ← 1 archivo por feature; nombres pre-acordados con el futuro theme
│   └── templates/navs/          ← markup nav reutilizable (nav-desk / nav-mobile)
└── docs/
    ├── informe-auditoria-*.md   ← auditorías (tokens, tipografía, utilidades)
    ├── estrategia-*.md          ← modelo de contenido (CPTs, taxonomías, campos)
    └── MAPA-MIGRACION.md        ← manifest archivo → archivo prototipo → tema
```

## Sistema de diseño (tokens + BEM)

- **Tokens antes que nada**: paleta del cliente definida en `:root` de `assets/css/style.css`
  como variables CSS. Ningún hex fuera de tokens en componentes ni páginas.
  Estructura del CSS en 7 secciones: Settings → Generics → Base → Atoms → Molecules →
  Organisms → Utilities & Overrides (sobre Bootstrap 5.3).
- **Naming BEM**: clases de salida = `.<bloque>__<elemento>.<bloque>__<elemento>--<modificador>`.
  Archivo del componente = mismo nombre del bloque en kebab-case (`card-fge.php` ↔ `.card-fge`).
- **Tipografía**: fuentes por tokens CSS (`--fge-font-family-headings` / `--fge-font-family-base`);
  escala tipográfica con proporción definida; prohibido utilidades ad-hoc (`fs-xs`, `tracking-*`).

## Regla data ↔ markup (la clave de la migración barata)

```php
// components/molecules/card-noticia.php — sus keys SON los meta_keys SCF futuros
<?php $c = $noticia; ?>
<article class="card-fge">
  <span class="badge-fge badge-fge--pais"><?= esc_html($c['pais']) ?></span>
  <h2 class="card-fge__titulo"><?= esc_html($c['titulo']) ?></h2>
  <p class="card-fge__resumen"><?= esc_html($c['subtitulo']) ?></p>
<?php // Pre-WP: $c viene de data/noticias.php. En WP: SCF::get(). El markup NO cambia. ?>
```

- Las keys de `data/entidad.php` deben llamarse **idénticas** a los meta_keys previstos
  en la estrategia de contenido del proyecto.
- Helpers de acceso (`fge_datos('noticias')`) con firma que se traduzca 1:1 a
  `SCF::get()` / `get_template_part()`.

## Pipeline fijo (para cualquier proyecto)

1. **Tokens primero** → `assets/css/style.css` con la paleta del cliente.
2. **Motor portable auditado** → `assets/` sin nada del cliente fuera de tokens.
3. **Componentes** en `components/{atoms,molecules,organisms}` → revisados aislados.
4. **Data files** en `data/` → con contrato SCF previsto.
5. **Páginas** en `pages/page-*.php` → composición de includes solamente.
6. **Auditoría de cumplimiento** → verificar: un solo `<head>`, 0 CSS inline, 0 colores fuera de
   tokens, tipografía correcta, header/footer vía shells, componentes sin texto hardcodeado.
7. **MAPA-MIGRACION.md** → manifest vivo: archivo prototipo → archivo tema + transformación
   (copiar / reemplazar include por hook WP / data→SCF).

## Auditoría típica (errores que este flujo previene)

- Páginas con `<style>` local propio y variables tipo `--brand-*` que no son los tokens.
- Tipografía incorrecta (p. ej. Inter/Arial en vez de las fuentes del manual de marca).
- Clases inventadas (utilities tipo Tailwind) en vez de átomos BEM (`btn-fge`).
- Header/footer maquetados a mano en cada página (duplicados, con variantes distintas).
- SVG con `fill`/`stroke` hex hardcoded en vez de `currentColor` o tokens.

Al auditar un prototipo, primero generar informe con tabla token por token
(color local → token oficial más cercano), luego corregir en orden P0→P3:
(1) enlazar style.css único y eliminar `<style>` locales, (2) tipografía, (3) shells/includes,
(4) reemplazo de utilidades por átomos BEM, (5) colores fuera de paleta, (6) SVG/detalles, (7) consolidar componentes.

## Documento de referencia del proyecto FGE

- `docs/propuesta-restructuracion-prototipo.md` (patrón completo aplicado)
- `docs/informe-auditoria-tokens.md` (ejemplo de auditoría resuelta)
- `docs/estrategia-theme-classic-wp.md` (modelo de contenido asociado)
