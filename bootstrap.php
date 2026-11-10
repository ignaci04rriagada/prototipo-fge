<?php
/**
 * bootstrap.php — Punto de arranque del prototipo pre-WP (simulador de carga)
 *
 * ROL EN WORDPRESS: este archivo es SOLO pre-WP. En el tema real su función la
 * cumple el binomio functions.php (manifiesto de setup/_s) + assets/assets.php
 * (hub de includes). La regla de traducción es:
 *
 *   fge_datos('entidad')      →  SCF::get() / WP_Query / get_terms() según entidad
 *   fge_componente($ruta, $vars) →  get_template_part() con args
 *
 * Reglas:
 * - Único punto de helpers. Nada de includes sueltos en páginas.
 * - fge_datos() devuelve arrays cuyos KEYS = meta_keys SCF futuros.
 * - fge_consulta() simula WP_Query: devuelve arrays de "posts" del mismo shape
 *   que entregará la REST/CPT real (ver skill prototipado-pre-wp).
 */

// ─── Simulación de "base de datos" (contenido del sitio en versión dev) ───

function fge_datos(string $entidad) {
    // data/entidad.php → array de campos de página/entrada única (shape = SCF)
    return require __DIR__ . "/data/{$entidad}.php";
}

function fge_consulta(string $cpt, array $args = []) {
    // data/posts-<cpt>.php → array de "posts" (shape = payload nativo de WP:
    // id, titulo, extracto, url_imagen, fecha, terminos de taxonomías...)
    // $args simula WP_Query: ['destacado' => true], ['pais' => 'chile'], etc.
    $posts = require __DIR__ . "/data/posts-{$cpt}.php";
    return array_filter($posts, function ($p) use ($args) {
        foreach ($args as $k => $v) {
            if (($p[$k] ?? null) !== $v) return false;
        }
        return true;
    });
}

// ─── Render de componentes ───

function fge_componente(string $ruta, array $vars = []): void {
    // components/<ruta>.php — el componente solo presenta; no conoce el origen
    extract($vars, EXTR_SKIP);
    include __DIR__ . "/components/{$ruta}.php";
}

function fge_pais(string $slug): array {
    // data/paises.php: array país → campos SCF del término de taxonomía `pais`
    $paises = fge_datos('paises');
    return $paises[$slug] ?? reset($paises); // fallback: primer país disponible
}

function fge_pais_slug(): string {
    // Prototipo: ?pais=chile | En WP: get_queried_object() sobre archive-pais
    $slug = $_GET['pais'] ?? '';
    if (!array_key_exists($slug, fge_paises())) {
        $slug = array_key_first(fge_paises());
    }
    return $slug;
}

function fge_paises(): array {
    // Términos de la taxonomía pais que el cliente tiene ACTIVOS.
    // data/paises.php registra activos y futura expansión (ver cabecera del
    // data): los inactivos no se muestran ni aceptan tráfico directo —
    // en WP esto sería hide_empty / campo meta del término.
    return array_filter(fge_datos('paises'), fn ($p) => !empty($p['activo']));
}

function fge_base(): string {
    // Base URL absoluta del prototipo. Centralizada para no repetir cálculo
    // (y tolerar hosting en raíz, donde dirname() devuelve '/' y al concatenar
    // se generaba '//pages'). En WP no existe: WP encola por handle.
    return rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
}

function fge_url_pais(string $slug): string {
    // Enlace al molde país por slug.
    // En WP: get_term_link($slug, 'pais') → nada que reescribir (solo el helper).
    if (!array_key_exists($slug, fge_paises())) return '#';
    return fge_base() . '/pages/page-pais.php?pais=' . urlencode($slug);
}
