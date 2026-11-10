<?php
/**
 * organism: form-alianza — formulario "Hablemos de tu empresa" (alianzas)
 * 📐 alianzas.html / Figma 478:3634 (container 680px, card white radius):
 * 3 filas (nombre+apellido, empresa+cargo, correo+país), radio pills de
 * interés, textarea, CTA fucsia full-width.
 * Contrato de data:
 *   - select "País" ← fge_paises() (solo activos: la misma fuente del
 *     sitio; cuando se active Colombia/Perú entran solos al form)
 *   - radio "interés" = tipos de colaboración (taxonomía del CPT alianzas)
 * En WP: formulario nativo (CF7/Fluent) o REST propio del módulo alianzas;
 * action="#" del prototipo.
 */
$fge_base = fge_base();
$tipos_interes = [
    ['slug' => 'voluntariado', 'nombre' => 'Voluntariado corporativo'],
    ['slug' => 'iniciativa',   'nombre' => 'Apoyar una iniciativa'],
    ['slug' => 'circular',     'nombre' => 'Economía circular'],
];
$tipos_interes[] = ['slug' => 'otro', 'nombre' => 'Otro aporte'];
$interes_default = 'voluntariado';
?>
<!-- organism/form-alianza -->
<section class="container pb-5 mb-4">
  <div class="form-alianza-fge card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mx-auto" style="max-width: 680px;">
    <div class="text-center mb-4">
      <h2 class="h2 fw-semibold text-brand-primary mb-1">Hablemos de tu empresa.</h2>
      <p class="fs-xs text-muted m-0">
        Cuéntanos qué estás buscando y abramos una conversación sobre una posible alianza.
      </p>
    </div>

    <form action="#" method="post" class="d-flex flex-column gap-3">
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label for="fa-nombre" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">Nombre *</label>
          <input type="text" id="fa-nombre" name="first_name" class="form-control form-control-sm fs-xs" placeholder="Tu nombre" required>
        </div>
        <div class="col-12 col-md-6">
          <label for="fa-apellido" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">Apellido *</label>
          <input type="text" id="fa-apellido" name="last_name" class="form-control form-control-sm fs-xs" placeholder="Tu apellido" required>
        </div>
        <div class="col-12 col-md-6">
          <label for="fa-empresa" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">Empresa *</label>
          <input type="text" id="fa-empresa" name="company_name" class="form-control form-control-sm fs-xs" placeholder="Nombre de la empresa" required>
        </div>
        <div class="col-12 col-md-6">
          <label for="fa-cargo" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">Cargo</label>
          <input type="text" id="fa-cargo" name="position" class="form-control form-control-sm fs-xs" placeholder="Tu cargo">
        </div>
        <div class="col-12 col-md-6">
          <label for="fa-correo" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">Correo corporativo *</label>
          <input type="email" id="fa-correo" name="corporate_email" class="form-control form-control-sm fs-xs" placeholder="nombre@empresa.cl" required>
        </div>
        <div class="col-12 col-md-6">
          <label for="fa-pais" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">País *</label>
          <select id="fa-pais" name="country" class="form-select form-select-sm fs-xs text-secondary" required>
            <option value="" disabled selected>Selecciona un país</option>
            <?php foreach (fge_paises() as $slug => $pais_form) : ?>
              <option value="<?= htmlspecialchars($slug) ?>"><?= htmlspecialchars($pais_form['nombre']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <!-- ¿Qué te interesa explorar? — pills radio (1 solo a la vez) -->
      <div class="pt-2">
        <span class="d-block fs-xxs fw-semibold text-brand-primary mb-2">¿Qué te interesa explorar?</span>
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($tipos_interes as $j => $tipo) : ?>
            <input type="radio" class="btn-check" name="interest" id="fa-interes-<?= $tipo['slug'] ?>" value="<?= $tipo['slug'] ?>"<?= $tipo['slug'] === $interes_default ? ' checked' : '' ?>>
            <label class="btn btn-sm btn-outline-secondary rounded-pill fs-xxs py-1 px-3 form-alianza-fge__pill" for="fa-interes-<?= $tipo['slug'] ?>">
              <?= htmlspecialchars($tipo['nombre']) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="pt-1">
        <label for="fa-mensaje" class="form-label fs-xxs fw-semibold text-brand-primary mb-1">Cuéntanos brevemente</label>
        <textarea id="fa-mensaje" name="alliance_message" rows="3" class="form-control form-control-sm fs-xs" placeholder="¿Qué te gustaría desarrollar junto a FGE?"></textarea>
      </div>

      <div class="pt-2">
        <button type="submit" class="btn-fge btn-fge--primary btn-sm w-100 d-flex align-items-center justify-content-center gap-2 py-2 rounded">
          <span>Quiero crear una alianza</span>
          <i class="bi bi-arrow-up-right-circle" aria-hidden="true"></i>
        </button>
      </div>
    </form>
  </div>
</section>
