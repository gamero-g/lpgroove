<?php

    $texto = $_GET['texto'];

?>

<section class="container">
    <h3 class="text-center pt-4">¿Porqué no pudo <?= $texto ?></h3>
    <div>
        <?= Alerta::obtenerAlertas(); ?>
    </div>
</section>