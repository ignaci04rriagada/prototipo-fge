# Fundación Gestionar Esperanzas — Sistema de Diseño y Maquetación Modular

Este repositorio contiene el sistema de estilos base, componentes UI y prototipo modular desarrollado para el sitio web de la **Fundación Gestionar Esperanzas**. Se trata de una arquitectura basada en **Atomic Design** y metodología **BEM**, preparada de forma independiente antes de su integración definitiva en WordPress.

## 🎯 Propósito del Proyecto

El objetivo principal de esta etapa es construir la infraestructura visual y los prototipos de componentes de interfaz utilizando un entorno local optimizado. Esto permite validar el diseño, la responsividad y la escalabilidad de la maqueta sin depender aún de la estructura interna de un CMS.

### ⚠️ Etapa Previa a WordPress
Este desarrollo constituye una **fase estática y desacoplada (Pre-WordPress Theme Development)**. Una vez validados los átomos, moléculas y organismos BEM en este prototipo, todo el código HTML/PHP y CSS será migrado para constituir un **Tema Personalizado de WordPress** respaldado por Custom Post Types (CPT) y Advanced Custom Fields (ACF).

---

## 💻 Entorno de Desarrollo y Modularización con MAMP

Para simular una estructura modular similar a la de un tema de WordPress sin añadir la sobrecarga del CMS en fases tempranas, se utiliza un servidor local basado en **MAMP**:

* **Servidor Local PHP/Apache:** Permite interpretar archivos `.php` de forma nativa en el entorno local (`http://localhost/prototipo-fge`).
* **Modularización con PHP Includes:** En lugar de maquetar páginas monolíticas, se emplean estructuras modulares mediante `include` o `require_once` de PHP para separar componentes reutilizables (ej: `header.php`, `footer.php`, llamadas a componentes de tarjetas, etc.).
* **Iteración Ágil:** Facilita probar y ajustar la jerarquía visual, los tokens y los componentes BEM de forma aislada antes de traducirlos a la jerarquía de plantillas de WordPress (`single.php`, `archive.php`, `page.php`).

---

## 🛠️ Características Principales del Sistema

### 1. Sistema de Design Tokens (`:root`)

La arquitectura centraliza la identidad visual en dos niveles de variables CSS dentro de `assets/css/style.css`:

* **Primitivos (Manual de Marca):**
  * **Color Primario / Marca:** Púrpura `#4c4688` (30% de uso) y sus variantes tonales (`700` a `950`).
  * **Acentos (Isotipo):** Cian `#1baac1` (20%), Verde `#199d6b` (15%), Lima `#5da430` (10%).
  * **Acciones / CTA:** Rosa `#ff2471` (15%) para conversión principal y Amarillo `#ffc04c` (10%) para llamados a donación.
  * **Escala Neutra:** Graduaciones desde `#fafafa` (`100`) hasta `#1a1a1a` (`900`).

* **Semánticos / Funcionales:** Mapeo de tokens primitivos a funciones concretas de UI (`--fge-color-brand-primary`, `--fge-color-action-primary`, `--fge-color-bg-surface`).

### 2. Tipografía y Jerarquía Visual

* **Familia Tipográfica:** *Envolventa* para encabezados (`h1`-`h6`) y *Lato* para cuerpo de texto y elementos generales.
* **Escala Tipográfica:** Definida mediante la proporción **Minor Third (1.2)** sobre una base rem de `16px`.

### 3. Sistema de Grilla Personalizado (Figma Override)

Integración y sobrescritura sobre el sistema flexbox de Bootstrap 5.3:

* **Márgenes Laterales:** `80px` (`5rem`) en pantallas de escritorio (`>= 992px`) para guardar fidelidad con el diseño de Figma.
* **Medianil (Gutters):** `24px` (`1.5rem`) estandarizados entre columnas (`.row`).

---

## 📁 Estructura del CSS (`assets/css/style.css`)

El archivo de estilos sigue una estructura clara en 7 secciones:

1. **Settings & Variables:** Design Tokens en `:root`.
2. **Generics & Resets:** Normalización y ajustes globales.
3. **Base & Elements:** Estilos para etiquetas HTML puras (`body`, `h1`-`h6`, `p`, `a`).
4. **Atoms (Átomos):** Botones (`.btn-fge`), etiquetas y componentes primarios.
5. **Molecules (Moléculas):** Tarjetas (`.card-fge`), testimonios y bloques combinados.
6. **Organisms (Organismos):** Componentes complejos (`.header-fge`, `.hero-fge`, `.footer-fge`).
7. **Utilities & Overrides:** Sobrescrituras a Bootstrap y clases auxiliares.

---

## 🚀 Hoja de Ruta / Próximos Pasos

- [x] Consolidación de Tokens CSS y sobrescritura de Grilla de Figma.
- [x] Maquetación de prototipo base en MAMP (`index.php`).
- [ ] Construcción de Átomos (`.btn-fge`, `.badge-fge`) con metodología BEM.
- [ ] Construcción de Moléculas y Organismos.
- [ ] **Migración a WordPress:** Conversión de componentes a un Tema Personalizado (PHP + CPT + ACF).