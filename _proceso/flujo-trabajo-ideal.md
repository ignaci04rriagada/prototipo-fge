# 🔄 Flujo de Trabajo Ideal — Mínima Fricción con las Skills

**Fecha:** 09/11/2026 · **Acompaña a:** `.opencode/skills/prototipado-pre-wp/SKILL.md` y
`.opencode/skills/migracion-tema-wp/SKILL.md` (fuente única; sin copias en el repo)

**Principio:** la fricción con un asistente de IA casi nunca está en las instrucciones, sino en el
**orden en que se toman las decisiones**. Si cada decisión vive escrita en `/docs` del repo, el
modelo lee y actúa; si vive en tu cabeza, el modelo pregunta (o improvisa). Este documento fija
ese orden.

---

## Fase 0 — Decisiones que NUNCA se postergan (30 min, una vez por proyecto)

El 90% de la fricción nace de indefiniciones tempranas. Antes de maquetar una sola página:

| # | Decisión | Se materializa en | Por qué |
|---|---|---|---|
| 1 | **Prefijo del proyecto** (ej. `fge`) | tokens (`.card-fge`), handles de enqueue, metas, textdomain | Cambiarlo después implica find-and-replace masivo |
| 2 | **Estrategia de contenido** (CPTs, taxonomías) | `_proceso/estrategia-*.md` | Define los **meta_keys ANTES** de crear `data/` — si cambian luego, refactor de data + componentes |
| 3 | **Paleta oficial en tokens** | `:root` único en `assets/css/style.css` | Nadie maqueta sin tokens: es exactamente el error detectado en la auditoría inicial |
| 4 | **Singular/plural consistente** | nombres de page templates (`page-donacion` vs `page-donaciones`) | Decisiones tontas de hoy = correcciones masivas de mañana |
| 5 | **Fuentes y tipografías oficiales** | tokens de tipografía + `<head>` del shell | La segunda deuda más común (caída en Inter/Arial vs manual de marca) |

**Regla:** cada decisión de esta fase debe estar escrita en un Markdown del repo antes de
empezar con la Fase 1.

---

## Fase 1 — Prototipado (skill `prototipado-pre-wp`)

Orden por página:

```
tokens/estilos → data/ de esa página → componentes que falten → armar page-*.php → siguiente página
```

- Trabajá **página por página**, no en bloque: data del contenido → componentes que falten →
  armado de `pages/page-*.php` → página siguiente.
- El contrato y el pipeline de `.opencode/skills/prototipado-pre-wp/SKILL.md` son la referencia
  de toda sesión; la carpeta `_proceso/` es su apoyo externo (estrategia, manifest, informes).

---

## Fase 2 — Puerta de auditoría (el anti-fricción más grande)

Antes de dar por cerrada una página, ejecutar la auditoría de la skill (tabla token por token +
checklist: `<head>` único, 0 CSS inline, 0 hex fuera de tokens, tipografía correcta,
header/footer por shells, 0 texto hardcodeado en componentes).

> **Matemática de la fricción:** auditar al final del prototipo = corregir N páginas;
> auditar por página = corregir como máximo 1. **Hábito clave: cada página entra limpia.**

---

## Fase 3 — Congelamiento

1. **`_proceso/MAPA-MIGRACION.md` desde el primer día, no al cierre**: cada página nueva agrega sus
   líneas al manifest en el momento. Al llegar a migrar ya está hecho.
2. **Health-check del motor**: verificar que `assets/` no contenga nada del cliente fuera de
   tokens (prefijo + paleta viven SOLO en su bloque CSS del cliente).

---

## Fase 4 — Migración (skill `migracion-tema-wp`)

Si Fases 0–3 se cumplieron, la migración es **mecánica**:

```
descomprimir motor → include → get_template_part()
                  → fge_datos() → SCF::get()
                  → shells de include → hooks WP
```

**Señal de alerta:** si durante la migración hay algo que un modelo "tiene que interpretar" en
lugar de copiar, es que algo quedó indefinido en las fases anteriores. **No improvises en la
migración**: volvé a la fase correspondiente, decídelo ahí, y volvé.

---

## 💡 Hábitos concretos anti-fricción

- **Decisiones en `/docs`, no en conversaciones**: la skill cita rutas (`estrategia-*`,
  `MAPA-MIGRACION.md`); si existen, el modelo lee en vez de preguntar.
- **Git disciplinado**: un commit por página auditada
  (`feat(page-transparencia): organismos + data scf`). Git log + manifest = red de seguridad en la migración.
- **Skills sincronizadas**: si el flujo cambia, editar la skill activa
  (`.opencode/skills/<id>/SKILL.md`) y regenerar la copia portable en el repo.
- **prompt de arranque plantilla** (copy-paste al inicio de cada sesión):

  ```text
  Usa la skill @prototipado-pre-wp sobre este proyecto.
  1. Lee _proceso/estrategia-*.md y _proceso/MAPA-MIGRACION.md
  2. Revisa el estado actual (páginas, components/, data/)
  3. Antes de hacer nada, avísame qué decisiones de Fase 0 faltan documentadas
  4. Proponé el paso siguiente según el pipeline de la skill
  ```

  (y el equivalente con `@migracion-tema-wp` cuando toque)

---

## 🔑 En una línea

> **"El prototipo se escribe como si ya fuera el tema."**
> Data con keys SCF, nomenclatura `page-*`, `<head>` único, manifest vivo.
> Si se hace eso desde el día uno, las skills son solo la memoria formal de lo ya bien hecho.

---

## 📍 Estado de este proyecto (FGE) al 09/11/2026

| Fase | Estado |
|---|---|
| 0 — Decisiones | ✅ Estrategia en docs, prefijo `fge` definido, tokens en `assets/css/style.css` · ⚠️ 6 páginas aún sin normalizar y decisión singular/plural pendiente (`donacion` vs `donaciones`) |
| 1 — Prototipado | ~60%: páginas maquetadas pero monolíticas (sin includes ni data) |
| 2 — Auditoría | Informe listo; corrección P0 pendiente |
| 3 — Congelamiento | No iniciado: `components/` vacía, `data/` inexistente, `MAPA-MIGRACION.md` por crear |
| 4 — Migración | Cuando F1–F3 cierren |

**Próximo paso natural:** ejecutar el P0 (normalizar CSS de las 8 páginas + activar shells de
`includes/`) y, en paralelo, iniciar el patrón `data/` + `components/` sobre una página piloto.
