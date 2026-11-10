<?php
/**
 * molecule: card-colaborar — tarjeta del bloque "Cómo colaborar"
 * Contrato: $bloque ← data/colaborar.php[n]
 * keys: titulo, texto, ctas[] {texto, href, estilo: teat|fuchsia|outline}
 */
$bloque = $bloque ?? null;
?>
<!-- molecule/card-colaborar -->
<article class="col-md-4 border rounded-3 p-4 d-flex flex-column justify-content-between h-100">
  <div>
    <h3 class="h6 fw-bold text-brand-primary mb-2"><?= htmlspecialchars($bloque['titulo']) ?></h3>
    <p class="fs-xs text-muted mb-4"><?= htmlspecialchars($bloque['texto']) ?></p>
  </div>
  <div class="d-grid gap-2">
    <?php foreach ($bloque['ctas'] as $cta_item) : ?>
      <?php
        $clase = [
          'teal'     => 'btn-fge btn-fge--secondary btn-sm fw-semibold',
          'fuchsia'  => 'btn-fge btn-fge--primary btn-sm fw-semibold',
          'outline'  => 'btn btn-outline-secondary btn-sm fw-semibold',
        ][$cta_item['estilo']] ?? 'btn btn-outline-secondary btn-sm fw-semibold';
      ?>
      <button type="button" class="<?= $clase ?>"><?= htmlspecialchars($cta_item['texto']) ?></button>
    <?php endforeach; ?>
  </div>
</article>
