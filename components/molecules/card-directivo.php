<?php
/**
 * molecule: card-directivo — tarjeta de persona de la gobernanza
 * Contrato: $directivo ← fge_consulta('equipo', [...])[n]
 * keys: cargo, nombre, foto ('' → placeholder), whatsapp/email/linkedin.
 * 📐 Figma (478:4016+): tarjeta 410w border #e0e0e0 radius 8; foto 368×500
 *   radius 8 center; textos: cargo Lato 16 #616161 · nombre Lato 16 #212121
 *   · fila de 3 iconos 39px gap 16 (whatsapp lime / envelope cyan /
 *   linkedin purple, assets/img/icons/).
 * 🏷️ En WP: CPT `equipo` — foto vía campo imagen SCF, iconos si hay dato.
 */
$directivo = $directivo ?? [];
$d_foto   = $directivo['foto']   ?? '' ;
$d_cargo   = $directivo['cargo']   ?? '';
$d_nombre  = $directivo['nombre']  ?? '';
$d_links   = [
    'whatsapp' => ['img/icons/whatsapp.svg', 'WhatsApp de ' . $d_nombre],
    'email'    => ['img/icons/envelope.svg',  'Email de ' . $d_nombre],
    'linkedin' => ['img/icons/linkedin.svg', 'LinkedIn de ' . $d_nombre],
];
?>
<!-- molecule/card-directivo -->
<article class="card-directivo-fge">
  <div class="card-directivo-fge__foto">
    <?php if (!empty($d_foto)) : ?>
      <img src="<?= fge_base() ?>/<?= htmlspecialchars($d_foto) ?>" alt="Fotografía de <?= htmlspecialchars($d_nombre) ?>" class="card-directivo-fge__img">
    <?php else: ?>
      <div class="card-directivo-fge__placeholder" aria-hidden="true">
        <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-4.42 0-8 2.24-8 5v3h16v-3c0-2.76-3.58-5-8-5z"></path>
        </svg>
      </div>
    <?php endif; ?>
  </div>
  <div class="card-directivo-fge__textos">
    <p class="card-directivo-fge__cargo"><?= htmlspecialchars($d_cargo) ?></p>
    <p class="card-directivo-fge__nombre"><?= htmlspecialchars($d_nombre) ?></p>
    <div class="card-directivo-fge__iconos">
      <?php foreach ($d_links as $key => [$src, $alt]) :
        if (empty($directivo[$key])) continue; ?>
        <a href="<?= htmlspecialchars($directivo[$key]) ?>"><img src="<?= fge_base() ?>/<?= $src ?>" width="39" height="39" alt="<?= htmlspecialchars($alt) ?>"></a>
      <?php endforeach; ?>
    </div>
  </div>
</article>
