<?php
/**
 * molecule: resumen-alertas — contador global de alertas/campañas activas
 * Contrato: $resumen ← data/campanas.php (futuro: consulta CPT
 * campanas_alertas con estado=1, agrupado por país).
 * 🏷️ HOME-ONLY (en otros contextos se migra al molde país/campaña activa).
 */
$resumen = $resumen ?? [];
$activos = array_filter($resumen, fn ($r) => $r['cantidad_activas'] > 0);
?>
<!-- molecule/resumen-alertas -->
<section class="border rounded-3 p-4 bg-white">
  <h2 class="h6 fw-bold text-brand-primary mb-3">Alertas y campañas</h2>

  <?php if (!empty($activos)) : ?>
  <div class="d-flex justify-content-center gap-2 pt-1">
    <?php foreach ($activos as $r) : ?>
    <div class="bg-purple-950 text-white text-center rounded py-2 px-3" style="width: 70px;">
      <div class="fs-xxs text-uppercase fw-bold"><?= htmlspecialchars($r['pais_ref']) ?></div>
      <div class="fs-4 fw-bold lh-1 my-1"><?= (int) $r['cantidad_activas'] ?></div>
      <div class="fs-xxs text-white-50">Alerta</div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
  <p class="fs-xs text-muted text-center mb-0">Sin alertas activas por ahora.</p>
  <?php endif; ?>
</section>
