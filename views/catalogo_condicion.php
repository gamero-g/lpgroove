<?php 


$estado = $_GET['condicion'];


$discos = Disco::filtrarPorCondicion($estado);

$fechas = Disco::crearFechasParaFiltro();



?>
<section class="container">
    <div class="d-flex flex-column flex-lg-row" id="catalogoCompletoConFiltros">
        <div>
            <span class="bg-white p-1 rounded-2 text-black"><?= $estado ?> <a href="index.php?seccion=catalogo" class="text-black">X</a></span>
            <h2 class="text-center border-bottom">Filtros</h2>
            <div class="border-bottom">
                <h3 class="fs-5">Condición</h3>
                <ul class="list-unstyled">
                    <li><a href="index.php?seccion=catalogo_condicion&condicion=nuevo">Nuevo</a></li>
                    <li><a href="index.php?seccion=catalogo_condicion&condicion=usado">Usado</a></li>
                </ul>
            </div>
            <div class="pt-2">
                <h3 class="fs-5">Fecha</h3>
                <div class="dropdown">
                    <button class="btn dropdown-toggle boton-fecha" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Años
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach ($fechas as $fecha) { ?>
                            <li><a href="index.php?seccion=catalogo_fecha&anio_de_lanzamiento=<?= $fecha['anio'] ?>" class="dropdown-item"><?= $fecha['fechaFormateada'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <?php if($discos) { ?>
                <h2 class="bg-black py-5 text-center text-personalizado">Discos <span class="text-light"><?= $estado ?>s</span></h2>

                <div class="d-flex flex-wrap gap-2 flex-column flex-md-row justify-content-center pt-2 pb-3 catalogo-completo" id="productos">
                    <?php foreach ($discos as $disco) { 
                    ?> 
                            <section class="p-4">
                                <div class="d-flex justify-content-between">
                                    <h3> <?=$disco->getTitulo()?></h3>
                                    <span><?=  $disco->getAnioDeLanzamiento() ?></span>
                                </div>
                                <a href="index.php?seccion=detalle_producto&id=<?= $disco->getId() ?>" class="bg-transparent d-block text-decoration-none">
                                    <div class="d-flex aparecer-vinilo justify-content-center">
                                        <img src="img/portadas/<?=$disco->getImagenPortada() ?>" alt="<?= $disco->getTitulo() ?>, <?= $disco->getAnioDeLanzamiento() ?>" class="portada">
                                        <img src="img/vinilo/<?=$disco->getImagenVinilo() ?>" alt="Imagen de vinilo genérico" class="disco">
                                    </div>
                                </a>
                                <div class="detalles d-flex gap-2">
                                    <p><?= $disco->getCantidadCanciones() ?> canciones</p>
                                    <p>-</p>
                                    <p><?= $disco->getDuracion() ?></p>
                                </div>
                                <p><?= $disco->recortarDescripcion() ?></p>
                                <div class="text-center"><?= $disco->generarOferta() ?></div>
                                <a href="index.php?seccion=detalle_producto&id=<?= $disco->getId() ?>" class="text-decoration-none">Comprar ahora</a>
                            </section> 
                    
                    <?php  } ?>
                </div>
            <?php } else { ?>
                <h2 class="text-center py-5">Lo sentimos! Solo trabajamos discos nuevos y usados.</h2>
            <?php } ?>
        </div>
    </div>
</section>
