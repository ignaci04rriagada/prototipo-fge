<?php
/**
 * molecule: contacto-local — fichas de contacto del molde país
 * Contrato: $pais ← fge_pais(); keys sede: ciudad, email, tel.
 * 🏷️ MOLDE (3 fichas: oficina, correo, teléfono — dato del término país).
 */
$pais = $pais ?? null;
?>
<section class="container py-4">
  <h2 class="h5 fw-bold text-dark mb-1">Contacto local</h2>
  <p class="fs-xxs text-muted mb-4">Información de contacto para <?= htmlspecialchars($pais['nombre']) ?>.</p>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <!-- Oficina Local -->
    <div class="col">
      <div class="card h-100 border-light-subtle rounded-1 p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge badge-fge--pais rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 20px; height: 20px;"><i class="bi bi-geo-alt" aria-hidden="true"></i></span>
          <h3 class="fs-xs fw-bold text-dark m-0">Oficina local</h3>
        </div>
        <p class="fs-xxs text-muted m-0">[dirección]</p>
        <p class="fs-xxs text-muted m-0"><?= htmlspecialchars($pais['sede']['ciudad']) ?></p>
      </div>
    </div>
    <!-- Correo -->
    <div class="col">
      <div class="card h-100 border-light-subtle rounded-1 p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge badge-fge--pais rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 20px; height: 20px;"><i class="bi bi-envelope" aria-hidden="true"></i></span>
          <h3 class="fs-xs fw-bold text-dark m-0">Correo</h3>
        </div>
        <p class="fs-xxs text-muted m-0"><?= htmlspecialchars($pais['sede']['email']) ?></p>
        <p class="fs-xxs text-muted m-0">[área de contacto]</p>
      </div>
    </div>
    <!-- Teléfono -->
    <div class="col">
      <div class="card h-100 border-light-subtle rounded-1 p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge badge-fge--pais rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 20px; height: 20px;"><i class="bi bi-telephone" aria-hidden="true"></i></span>
          <h3 class="fs-xs fw-bold text-dark m-0">Teléfono</h3>
        </div>
        <p class="fs-xxs text-muted m-0"><?= htmlspecialchars($pais['sede']['tel']) ?></p>
        <p class="fs-xxs text-muted m-0">[horario de atención]</p>
      </div>
    </div>
  </div>
</section>
