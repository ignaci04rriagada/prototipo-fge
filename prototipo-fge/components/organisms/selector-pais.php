<?php
/**
 * organism: selector-pais — "Elige dónde quieres ayudar" (page-donacion)
 * 📐 donacion.html: cards de país con estado (Seleccionado / Disponible).
 * ⚙️ Prototipo: las flechas del mockup eran decorativas — la selección REAL
 * es la URL ?pais= (misma regla del resto del prototipo, fge_pais_slug()).
 * El país activo NO consume data/paises.php directo: usa fge_paises()
 * (activos únicamente; la expansión futura no acepta donaciones).
 * Consumo (futuro WP): archive selector sobre taxonomía pais.
 */
$paises_don = fge_paises();
$pais_sel   = fge_pais_slug();
?>
<!-- organism/selector-pais -->
<section class="container py-4">
  <h2 class="h2 fw-semibold text-brand-primary mb-1">Elige dónde quieres ayudar</h2>
  <p class="fs-xs text-muted mb-4">Selecciona el país para ver el formulario correspondiente y el responsable local.</p>

  <div class="row row-cols-1 row-cols-md-3 g-3">
    <?php foreach ($paises_don as $slug => $pais_card) : $sel = ($slug === $pais_sel); ?>
      <div class="col">
        <a href="?pais=<?= htmlspecialchars($slug) ?>" class="text-decoration-none">
          <div class="card selector-pais__card h-100 <?= $sel ? 'selector-pais__card--seleccionada border-2' : 'border-light-subtle' ?> rounded-3 p-3 bg-white shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="fs-xs fw-bold <?= $sel ? 'text-brand-primary' : 'text-dark' ?>">
                <?= htmlspecialchars($pais_card['nombre']) ?>
              </span>
              <span class="badge <?= $sel ? 'badge-fge--pais' : 'bg-light text-secondary border' ?> fs-xxs fw-medium">
                <?= $sel ? 'Seleccionado' : 'Disponible' ?>
              </span>
            </div>
            <p class="fs-xxs text-secondary lh-sm m-0"><?= htmlspecialchars($pais_card['hero_texto']) ?></p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>
