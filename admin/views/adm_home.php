<?php 
    $masVendidos = Ventas::obtenerMasVendidos();
?>

<section class="container d-flex flex-column  justify-content-center">
    <div class="bg-black mb-5 mt-4 p-2 p-md-5 rounded">
        <h3 class="fs-2 mt-4 border-bottom"><i class="fa-solid fa-screwdriver-wrench pe-3"></i>Administrador</h3>

        <div id="navAdmHome" class="mt-1 mb-5">
            <ul class="d-flex flex-column flex-lg-row gap-3 list-unstyled flex-wrap align-items-center justify-content-around">
                <li>
                    <a href="index.php?seccion=adm_discos&text=discos" class="d-flex"><i class="fa-solid fa-compact-disc"></i></a>
                    <span class="d-block text-center fs-4 fw-bold">Discos</span>
                </li>   
                <li>
                    <a href="index.php?seccion=adm_bandas&text=bandas" class="d-flex"><i class="fa-solid fa-guitar"></i></a>
                    <span class=" d-block text-center fs-4 fw-bold">Bandas</span>
                </li>
                    <li>
                    <a href="index.php?seccion=adm_descuentos&text=descuentos" class="d-flex"><i class="fa-solid fa-tag"></i></a>
                    <span class=" d-block text-center fs-4 fw-bold">Descuentos</span>
                </li>
                <li>
                    <a href="index.php?seccion=adm_generos&text=generos" class="d-flex"><i class="fa-solid fa-music"></i></a>
                    <span class=" d-block text-center fs-4 fw-bold">Géneros</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="bg-black p-md-5 p-2 rounded" id="estadisticas">
        <h3 class="border-bottom"><i class="fa-solid fa-chart-simple pe-3"></i>Estadísticas</h3>
       <div class="d-flex flex-column flex-lg-row gap-4">
            <div class="text-light">
                <div>
                    <h4 class="text-light">Más vendidos</h4>
                    <div>
                        <ul class="list-unstyled">
                            <?php if (empty($masVendidos)) : ?>
                                <li class="text-light">No hay ventas en los últimos 30 días.</li>
                            <?php else : ?>
                                <?php foreach ($masVendidos as $venta) { ?>
                                    <li class="d-flex gap-2 border-bottom align-items-center">
                                        <div>
                                            <img src="../img/portadas/<?= $venta['imagen_portada'] ?>"
                                                alt="Portada del album <?= $venta['titulo'] ?>"
                                                class="img-fluid img-stats">
                                        </div>
                                        <div>
                                            <h5><?= $venta['titulo'] ?></h5>
                                            <div>
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span class="fw-bold"><?= $venta['fecha'] ?></span>
                                            </div>
                                            <div>
                                                <i class="fa-solid fa-angles-right"></i>
                                                <span>Cantidad: <span class="fw-bold"><?= $venta['cantidad'] ?></span></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="text-light">Ganancias</h4>
                <ul class="list-unstyled">
                    <?php if (empty($masVendidos)) : ?>
                        <li class="text-light">No hay ventas en los últimos 30 días.</li>
                    <?php else : ?>
                        <?php foreach ($masVendidos as $venta) { ?>
                            <li class="d-flex gap-2 border-bottom align-items-center">
                                <div>
                                    <img src="../img/portadas/<?= $venta['imagen_portada'] ?>"
                                        alt="Portada del album <?= $venta['titulo'] ?>"
                                        class="img-fluid img-stats">
                                </div>

                                <div class="fs-4 text-success">
                                    <h5 class="text-light border-bottom fs-6"><?= $venta['titulo'] ?></h5>
                                    <div>
                                        <i class="fa-solid fa-money-bill-trend-up"></i>
                                        <span class="fw-bold">
                                            $<?= $venta['importe'] * $venta['cantidad'] ?>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    <?php endif; ?>
                </ul>
            </div>
       </div>
    </div>
</section>