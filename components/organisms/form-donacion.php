<?php
/**
 * organism: form-donacion — formulario de donación + contacto local
 * (donacion.html: form col izq 8/12 + sidebar 4/12 con responsable e info).
 * Contrato:
 *   $pais    ← fge_pais(fge_pais_slug()) — el nombre cambia el "Tu donación en X"
 *   $persona ← responsable local (CPT equipo, lookup por slug de data/paises.php)
 * En WP: form nativo/REST del módulo donación; el responsable queda como
 * relación término→post del CPT equipo.
 */
$pais     = $pais ?? [];
$persona  = $persona ?? null;
$fge_base = fge_base();
?>
<!-- organism/form-donacion -->
<section class="container pb-4">
  <div class="row g-4 align-items-start">
    <div class="col-12 col-lg-8">
      <h2 class="h2 fw-semibold text-brand-primary mb-1">
        Tu donación en <?= htmlspecialchars($pais['nombre'] ?? 'el país') ?>
      </h2>
      <p class="fs-xs text-muted mb-4">Completa el formulario y nuestro equipo local te guiará en el siguiente paso.</p>

      <form action="#" method="post" class="d-flex flex-column gap-3" style="max-width: 560px;">
        <div>
          <label for="fd-nombre" class="form-label fs-xs text-brand-primary fw-medium mb-1">Nombre</label>
          <input type="text" id="fd-nombre" name="donor_name" class="form-control form-control-sm fs-xs" placeholder="Ingresa tu nombre" required>
        </div>
        <div>
          <label for="fd-correo" class="form-label fs-xs text-brand-primary fw-medium mb-1">Correo</label>
          <input type="email" id="fd-correo" name="donor_email" class="form-control form-control-sm fs-xs" placeholder="Ingresa tu correo" required>
        </div>
        <div>
          <label for="fd-telefono" class="form-label fs-xs text-brand-primary fw-medium mb-1">Teléfono</label>
          <input type="tel" id="fd-telefono" name="donor_phone" class="form-control form-control-sm fs-xs" placeholder="Ingresa tu teléfono">
        </div>
        <div>
          <label for="fd-mensaje" class="form-label fs-xs text-brand-primary fw-medium mb-1">Mensaje o propuesta</label>
          <textarea id="fd-mensaje" name="donor_message" rows="3" class="form-control form-control-sm fs-xs" placeholder="Cuéntanos qué buscas"></textarea>
        </div>
        <div class="pt-1">
          <button type="submit" class="btn-fge btn-fge--primary btn-sm px-4 py-2 rounded">Enviar consulta</button>
        </div>
      </form>
    </div>

    <aside class="col-12 col-lg-4 d-flex flex-column gap-3">
      <!-- Responsable local (data: responsable del país → CPT equipo) -->
      <div class="card border-light-subtle rounded-3 p-3 bg-white">
        <h3 class="fs-xs fw-bold text-brand-primary mb-3">Responsable local</h3>

        <div class="bg-neutral-200 rounded ratio ratio-16x9 mb-3 d-flex align-items-center justify-content-center position-relative" style="max-height: 140px;">
          <?php if (!empty($persona['foto'])) : ?>
            <img src="<?= $fge_base ?>/<?= htmlspecialchars($persona['foto']) ?>" class="img-fluid position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="">
          <?php else: ?>
            <i class="bi bi-person-circle text-secondary opacity-50" style="font-size: 32px;" aria-hidden="true"></i>
          <?php endif; ?>
        </div>

        <h4 class="fs-xs fw-bold text-dark m-0"><?= htmlspecialchars($persona['nombre'] ?? 'Responsable '.$pais['nombre']) ?></h4>
        <p class="fs-xxs text-muted mb-1"><?= htmlspecialchars($persona['cargo'] ?? 'Equipo local') ?></p>
        <p class="fs-xxs mb-2">
          <a href="mailto:<?= htmlspecialchars(($persona['email'] ?? $pais['sede']['email']) ?? '') ?>" class="text-brand-primary text-decoration-underline">
            <?= htmlspecialchars(($persona['email'] ?? $pais['sede']['email']) ?? '') ?>
          </a>
        </p>
        <p class="fs-xxs text-muted lh-sm m-0">Estoy aquí para ayudarte con tu donación y responder cualquier duda.</p>
      </div>

      <!-- Información útil -->
      <div class="card border-light-subtle rounded-3 p-3 bg-white">
        <h3 class="fs-xs fw-bold text-brand-primary mb-1">Información útil</h3>
        <p class="fs-xxs text-muted mb-3">Preguntas frecuentes y transparencia.</p>
        <div class="d-grid gap-2">
          <a href="#" class="btn btn-outline-secondary btn-sm fs-xxs fw-medium py-1">Preguntas frecuentes</a>
          <a href="<?= fge_base() ?>/pages/page-transparencia.php" class="btn btn-outline-secondary btn-sm fs-xxs fw-medium py-1">Transparencia</a>
        </div>
      </div>
    </aside>
  </div>
</section>
