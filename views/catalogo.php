<?php 
    $fechas = Disco::crearFechasParaFiltro();

?>


<section class="container">
    <div class="bg-black text-light ps-5">
        <h2 class="catalogo fs-1 mb-0">Conocé nuestro catálogo</h2>
    </div> 

    <div class="d-flex flex-column flex-lg-row" id="catalogoCompletoConFiltros">
       
        <div>
            <h3 class="text-center border-bottom">Filtros</h3>
            <div class="border-bottom">
                <h4 class="fs-5">Condición</h4>
                
                <ul class="list-unstyled">
                    <li><a href="index.php?seccion=catalogo_condicion&condicion=nuevo">Nuevo</a></li>
                    <li><a href="index.php?seccion=catalogo_condicion&condicion=usado">Usado</a></li>
                </ul>
            </div>
            <div class="pt-2">
                <h4 class="fs-5">Fecha</h4>
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
        <div class="d-flex flex-wrap gap-2 flex-column flex-md-row justify-content-center pt-2 pb-3 catalogo-completo" id="productos">
            
            <?php foreach ($catalogoCompleto as $banda => $discos) { 
            ?> 
                    <section class="p-4">
                        <div class="d-flex justify-content-between">
                            <h3> <?=$discos->getTitulo()?></h3>
                            <span><?=  $discos->getAnioDeLanzamiento() ?></span>
                        </div>
                        <a href="index.php?seccion=detalle_producto&id=<?= $discos->getId() ?>" class="d-block text-decoration-none bg-transparent">
                            <div class="d-flex aparecer-vinilo justify-content-center">
                                <img src="img/portadas/<?=$discos->getImagenPortada() ?>" alt="<?= $discos->getTitulo() ?>, <?= $discos->getAnioDeLanzamiento() ?>" class="portada">
                                <img src="img/vinilo/<?= $discos->getImagenVinilo()?>" alt="Imagen de vinilo genérico" class="disco">
                            </div>
                        </a>
                        <div class="detalles d-flex gap-2">
                            <p><?= $discos->getCantidadCanciones() ?> canciones</p>
                            <p>-</p>
                            <p><?= $discos->getDuracion() ?></p>
                        </div>
                        <p><?= $discos->recortarDescripcion() ?></p>
                        <div class="text-center"><?= $discos->generarOferta() ?></div>
                        <a href="index.php?seccion=detalle_producto&id=<?= $discos->getId() ?>" class="text-decoration-none">Comprar ahora</a>
                    </section> 
                <?php  
            } ?>
        </div>
    </div>
</section>