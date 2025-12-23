<?php 

$datosForm = $_POST;

?>

<section id="gracias" class="d-flex flex-column  ">
    <div>
    </div>
    <div>
        <h2 class="text-center">Gracias <?= $datosForm['nombre'] ?> por contactarte con LPGroove!</h2>
        <div class="d-flex justify-content-center flex-column align-items-center">
            <p>En <span class="fw-bold">menos de 72hs</span> nos <span class="fw-bold">contactarémos a <?= $datosForm['email']?></span> responiendo todas tus consultas <span class="fw-bold">sobre <?= $datosForm['motivo']?></span>.</p>
            <div><img src="img/vinilo/vinilo_default.webp" alt="Imagen de vinilo"></div>
            <a href="index.php?seccion=home" class="text-decoration-none mt-5">Volver al inicio</a>
        </div>
    </div>
</section>
