<?php
/**
 * page: page-donacion — Donaciones (Template Name: Donaciones en WP)
 * Fuente de diseño: donacion.html (estructura del compañero): hero simple →
 * selector de país ("Elige dónde quieres ayudar") → form de donación con
 * sidebar (responsable local + info útil) → testimonios del país.
 * ⚙️ La selección de país reusa el sistema del prototipo (?pais= alterna
 * aquí como en page-pais; flechas del mockup eran decorativas).
 * Consultas → WP: form REST del módulo donación + tax pais + CPT equipo +
 * CPT testimonios.
 */
require __DIR__ . '/../bootstrap.php';

$hero = ['titulo' => 'Donaciones',
         'texto'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ipsum est, molestie non varius ut, finibus sit amet dolor. Aliquam id finibus mauris.',
         'imagen' => ''];

$pais_slug = fge_pais_slug();
$pais_dona = fge_pais($pais_slug);

// responsable local: relación del término país → colección equipo (slug).
$persona = null;
foreach (fge_consulta('equipo') as $persona_k) {
    if (($persona_k['slug'] ?? '') === $pais_dona['responsable']) { $persona = $persona_k; break; }
}

$testimonios_p = fge_consulta('testimonios', ['pais' => $pais_slug]);

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main>
  <?php include __DIR__ . '/../components/organisms/hero-simple.php'; ?>

  <?php include __DIR__ . '/../components/organisms/selector-pais.php'; ?>

  <?php fge_componente('organisms/form-donacion', ['pais' => $pais_dona, 'persona' => $persona]); ?>

  <section class="container py-4 pb-5">
    <h2 class="h2 fw-semibold text-brand-primary mb-1">Testimonios</h2>
    <p class="fs-xs text-muted mb-4">Historias auténticas de impacto.</p>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($testimonios_p as $testi_data) : ?>
        <div class="col">
          <?php fge_componente('molecules/card-testimonio', ['testimonio' => $testi_data]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
