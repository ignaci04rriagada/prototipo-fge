# **Estrategia y Arquitectura Técnica del Tema WordPress Classic Theme**

**Proyecto:** Fundación Gestionar Esperanzas  
**Documento:** Guía de Arquitectura de Información, CPTs, Taxonomías, Integración de APIs y Sistema de Emergencias

## **1\. Resumen Ejecutivo y Arquitectura General**

El desarrollo del tema WordPress (Classic Theme) para la Fundación Gestionar Esperanzas se basa en una arquitectura modular, relacional y orientada a objetos. Su propósito es garantizar la máxima reutilización de datos entre secciones (Landing, Páginas de País, Donaciones, Transparencia) evitando la duplicidad de contenidos y proporcionando al administrador un panel en wp-admin altamente intuitivo y estructurado.

## **2\. Taxonomías Nativas y Personalizadas**

Las taxonomías funcionan como los ejes transversales que filtran y relacionan la información a lo largo de todo el sitio web:

| Taxonomía | Tipo | Términos / Valores | Uso Principal   |
| :---- | :---- | :---- | :---- |
| **pais** | No jerárquica (Tags) | Chile, Argentina, Uruguay | Filtrado global y poblamiento dinámico de plantillas territoriales. |
| **linea\_programa** | Jerárquica (Categorías) | Formación, Asesoramiento Legal, Infraestructura, Proyectos Productivos (Una Vuelta \+) | Vincular iniciativas comunitarias con áreas corporativas y filtrado en noticias. |

## **3\. Custom Post Types (CPT) y Modelo Relacional**

Se dividen las entidades de datos en CPTs independientes para mantener la claridad semántica y facilitar la administración:

### **A. Noticias (Post nativo de WordPress)**

> * **Propósito:** Novedades, hito e historias de la fundación.  
> * **Taxonomías:** pais, linea\_programa, category.  
> * **Campos Personalizados (SCF / ACF):** Subtítulo/Extracto breve (máx. 62 caracteres para badges), tiempo estimado de lectura y créditos de la fotografía.

### **B. Programas (CPT: programas)**

> * **Propósito:** Ejes principales e iniciativas propias de la fundación.  
> * **Taxonomías:** pais, linea\_programa.  
> * **Campos Personalizados (SCF / ACF):** Checklist de características/metodología (ej. "Una hora para salvar el mundo"), párrafo de alcance local.

### **C. Organizaciones (CPT: organizaciones)**

> * **Propósito:** Entidades comunitarias beneficiadas o territoriales (ej. "Los Guerreros", "Fundación Melyna Montes").  
> * **Taxonomías:** pais.  
> * **Campos Personalizados (SCF / ACF):** Tipo de servicio (ej. "Comedor solidario"), historia de impacto, vinculación por objeto de relación al CPT programas.

### **D. Alianzas (CPT: alianzas)**

> * **Propósito:** Socios corporativos e institucionales B2B.  
> * **Campos Personalizados (SCF / ACF):** Logo institucional (WebP/PNG transparente), enlace web oficial, tipo de colaboración (Aporte, Voluntariado, Economía Circular).

### **E. Testimonios (CPT: testimonios)**

> * **Propósito:** Citas e historias auténticas de impacto reutilizables en múltiples secciones.  
> * **Taxonomías:** pais, linea\_programa.  
> * **Campos Personalizados (SCF / ACF):** Cita/Frase (aprox. 200 caracteres), nombre completo, edad, rol/cargo y foto de perfil (proporción 1:1).

### **F. Transparencia (CPT: transparencia)**

> * **Propósito:** Centralización de memorias anuales e informes financieros.  
> * **Campos Personalizados (SCF / ACF):** Tipo de documento (Memoria Anual / Informe Financiero), año de publicación, archivo PDF descargable, portada destacada.

### **G. Equipo y Responsables (CPT: equipo)**

> * **Propósito:** Directorio institucional global y Ficha de Responsable Local para donaciones.  
> * **Taxonomías:** pais (opcional para responsables locales).  
> * **Campos Personalizados (SCF / ACF):** Cargo, teléfono/WhatsApp, e-mail institucional, mensaje de acogida, redes sociales.

## **4\. Integración de Métricas: Google Sheets API \+ WordPress REST API**

Para la actualización automatizada de métricas e indicadores de impacto sin saturar la carga del sitio ni agotar cuotas de la API de Google, se implementa una arquitectura basada en caché inteligente:

> * **Fuente de Datos:** Planilla de Google Sheets gestionada internamente por la fundación (tablas metricas\_pais y voluntariado\_horas).  
> * **Middleware (WordPress REST API):** Endpoint personalizado (/wp-json/fundacion/v1/metricas) que consume la API de Google Sheets v4.  
> * **Caché Transient:** Implementación de set\_transient() en WordPress con refresco programado cada 12 horas.  
> * **Consumo Híbrido:** Renderizado inicial en PHP (Server-Side) para garantización de SEO \+ actualización dinámica client-side vía JavaScript para transiciones fluidas en carruseles y selectores de país.

## **5\. Sistema de Alertas de Emergencia y Campañas Especiales**

Transforma la web en una plataforma de respuesta rápida ante contingencias territoriales (ej. riesgo de cierre de un comedor o colectas anuales):

### **CPT / Opciones: campanas\_alertas**

> * **Campos Clave:** Tipo (alerta\_urgencia / campana\_especial), organización/programa vinculado, país de alcance, estado (activo true/false), titular de emergencia, meta/cifra y enlace directo a donación.

### **Modificación Dinámica de la Interfaz (UI Overrides)**

> * **Modo Alerta (Urgencia):** Inyecta clases temáticas (.mode-alerta\_urgencia) en el \<body\>. Activa un banner rojo superior fijo, destaca el botón SOS (\#panel-sos) con efectos visuales parpadeantes y resalta la tarjeta de la organización en riesgo con borde de urgencia.  
> * **Modo Campaña Especial:** Aplica colores temáticos alternativos, fija la campaña como primera opción preseleccionada en el formulario de Donaciones e incluye temporizadores de cuenta regresiva.

## **6\. Mapeo de Páginas Estáticas y Plantillas PHP**

| Página en WP | Plantilla PHP | Estrategia de Contenido   |
| :---- | :---- | :---- |
| **Inicio** | page-home.php | Renderiza Hero y Voluntariado Corporativo. Consume dinámicamente CPT Programas, CPT Noticias, CPT Testimonios y Métricas Transient. |
| **Página País** | page-pais.php | Molde funcional parametrizado por la taxonomía pais. Muestra métricas, noticias, organizaciones y contacto local del país seleccionado. |
| **Qué Hacemos** | page-que-hacemos.php | Hero institucional \+ Módulo "Cada organización tiene su propia realidad" \+ Grilla de los 4 pilares de trabajo. |
| **Alianzas Corporativas** | page-alianzas.php | Hero B2B \+ Proceso en 4 pasos ("De la intención a la acción") \+ Formulario B2B \+ Carrusel de CPT Alianzas. |
| **Donaciones** | page-donaciones.php | Selector de País \+ Formulario dinámico por país con Ficha de Responsable (CPT Equipo) \+ Acordeón FAQ. |
| **Transparencia** | page-transparencia.php | Banner principal \+ Grilla de CPT Transparencia (PDFs) \+ Directorio institucional (CPT Equipo). |

### **Funcionamiento Dinámico de page-pais.php**

La plantilla page-pais.php opera como un molde dinámico único parametrizado por el término del país activo (extraído del selector global o la URL /pais/\[slug\]). Al cargar la página, el sistema ejecuta consultas automatizadas (WP\_Query) con el filtro de taxonomía pais, renderizando de forma exclusiva y en tiempo real el Hero contextual, las métricas de impacto locales, las organizaciones territoriales, los testimonios, las noticias y la ficha de contacto de esa sede sin requerir maquetación manual para cada país.

Este enfoque modular garantiza que la arquitectura de la plantilla sea \$100\\%\$ reutilizable para Chile, Argentina, Uruguay o futuras expansiones territoriales de la fundación. Toda la actualización de contenidos se centraliza en sus respectivos Custom Post Types y campos SCF asociados, manteniendo una experiencia de gestión unificada y eficiente en WordPress.

