<?php
/**
 * organism: hero-pais — hero del molde país (page-pais)
 * Contrato: $pais ← fge_pais() (data/paises.php)
 * keys: hero_titulo, hero_texto. Imagen: placeholder ratio-16x9.
 * 🏷️ MOLDE: mismo markup para N países; el contenido cambia por término.
 * Consumo (futuro: SCF del término de taxonomía pais).
 */
$pais = $pais ?? null;
$fge_base = fge_base();
?>
<!-- organism/hero-pais -->
<section class="container py-5">
  <div class="row align-items-center g-4">
    <!-- Texto del Hero -->
    <div class="col-12 col-md-6">
      <h1 class="display-6 fw-black text-dark tracking-tight mb-3">
        <?= htmlspecialchars($pais['hero_titulo']) ?>
      </h1>
      <p class="fs-xs text-secondary leading-relaxed mb-4" style="max-width: 420px;">
        <?= htmlspecialchars($pais['hero_texto']) ?>
      </p>
      <a href="#programas" class="btn btn-brand-pink btn-sm rounded-pill px-4 py-2 fw-semibold fs-xs">
        Explorar programas
      </a>
    </div>
    <!-- Imagen Placeholder Hero -->
    <div class="col-12 col-md-6">
      <div class="bg-brand-gray rounded d-flex align-items-center justify-content-center ratio ratio-16x9">
        <svg width="48" height="48" class="text-secondary opacity-50" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"></path>
        </svg>
      </div>
    </div>
  </div>
</section>
