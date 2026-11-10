<?php
/**
 * molecule: card-testimonio — retrato + overlay de testimonio (DISEÑO ÚNICO)
 *
 * 🔑 Regla de negocio (contrato):
 *   Filas de 3 tarjetas: foto de persona; al hacer hover (o focus) aparece
 *   el overlay con el testimonio (cita). MISMO diseño en home y page-pais:
 *   - Home: 'destacado_internacional' = true (elige el cliente, flag SCF)
 *   - País: 'pais' = slug (futuro WP_Query / tax_query)
 *
 * Contrato: $testimonio ← fge_consulta('testimonios', [...])[n]
 * keys: nombre, edad, cita, foto ('' → placeholder), pais.
 * CSS del componente: assets/css/style.css → .card-testimonio-fge (BEM FGE).
 */
$testimonio = $testimonio ?? null;
?>
<!-- molecule/card-testimonio (retrato + overlay hover) -->
<article class="card-testimonio-fge is-placeholder" role="figure" tabindex="0" aria-label="Testimonio de <?= htmlspecialchars($testimonio['nombre']) ?>">
  <?php if (!empty($testimonio['foto'])) : ?>
    <img class="card-testimonio-fge__foto" src="<?= fge_base() ?>/<?= htmlspecialchars($testimonio['foto']) ?>" alt="Fotograf&iacute;a de <?= htmlspecialchars($testimonio['nombre']) ?>">
  <?php else: ?>
    <div class="card-testimonio-fge__placeholder" aria-hidden="true">
      <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-4.42 0-8 2.24-8 5v3h16v-3c0-2.76-3.58-5-8-5z"></path>
      </svg>
    </div>
  <?php endif; ?>

  <div class="card-testimonio-fge__overlay">
    <h3 class="card-testimonio-fge__nombre">
      <?= htmlspecialchars($testimonio['nombre']) ?>, <?= (int) $testimonio['edad'] ?> a&ntilde;os.
    </h3>
    <p class="card-testimonio-fge__cita"><?= htmlspecialchars($testimonio['cita']) ?></p>
  </div>
</article>
