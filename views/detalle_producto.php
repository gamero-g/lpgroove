<?php 

$id = $_GET['id'] ?? 0;

if(!intval($id)) {
    $id = 0;
}


$disco = Disco::filtrarPorId($id);

?>
<section class="bg-completo">
    <div class="container">
        <div id="detalle">
            <?php if(!empty($id)) { ?> 
                <div class="d-flex flex-column flex-lg-row gap-5">
                    <div class="imagenes-detalle">
                        <div class="d-flex flex-md-row-reverse gap-2 flex-column">
                            <img src="img/portadas/<?= $disco->getImagenPortada()?>" alt="<?= $disco->getTitulo() ?>, <?= $disco->getAnioDeLanzamiento() ?>">
                            <img src="img/vinilo/<?= $disco->getImagenVinilo() ?>" alt="Disco vinilo genérico" class="img-chica">
                        </div>
                    </div>
                    <div class="texto-detalle">
                        <span><?= ucfirst($disco->getCondicion()) ?> - <?= $disco->getEstado()?></span> 
                        <h2 class="fs-1"><?= $disco->getTitulo()?></h2>
                        <div class="d-flex flex-column">
                            <div><?=$disco->generarOferta() ?></div>
                            <span><?= "En 6 cuotas de $" . $disco->generarCuotas(30, 6) ?> </span>
                            <a href="#">Ver medios de pago</a>
                        </div>
                        
                        <div class="pt-5">
                            <p class="fw-bold mb-1">Stock Disponible</p>
                            <p><?= $disco->chequearUnidades() ?></p>
                        </div>
                        
                        <div class="calls">
                            <form action="admin/actions/agregar_item_acc.php" method="GET">
                                <div class="d-flex gap-3 flex-column ">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="cantidadProducto" placeholder="Cantidad" value="1" max="<?=  $disco->getUnidades()?>" min="1" name="cantidadProducto">
                                        <label for="cantidadProducto">Cantidad</label>
                                    </div>
                                    <div class="">
                                        <input type="submit" value="Agregar al Carrito">
                                        <input type="hidden" value="<?= $disco->getId() ?>" name="id" id="id">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
               
                <div class="pt-5">
                    <h3>Características</h3>

                    <div class="d-flex flex-column flex-md-row gap-3" id="tablaDetalles">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Canciones</th>
                                    <td><?= $disco->getCantidadCanciones()?></td>
                                </tr>
                                <tr>
                                    <th>Duracion</th>
                                    <td><?= $disco->getDuracion()?></td>
                                </tr>
                                <tr>
                                    <th>Lanzamiento</th>
                                    <td><?= $disco->getAnioDeLanzamiento() ?></td>
                                </tr>
                                <tr>
                                    <th>Año de formación de la banda</th>
                                    <td><?= $disco->getBanda()->getAnio_de_formacion() ?></td>
                                </tr>
                                <tr>
                                    <th>Banda / arista</th>
                                    <td><?= $disco->getBanda()->formatearTituloBanda() ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Rating</th>
                                    <td><?= $disco->getRating() ?></td>
                                </tr>
                                <tr>
                                    <th>Condicion</th>
                                    <td><?= $disco->getCondicion() ?></td>
                                </tr>
                                <tr>
                                    <th>Integrantes</th>
                                    <td><?= ($disco->getBanda()->getIntegrantes() == '') ? $disco->getBanda()->getNombre() : $disco->getBanda()->getIntegrantes()  ?></td>
                                </tr>
                                
                                <tr>
                                    <th>País de banda / artista</th>
                                    <td><?= $disco->getBanda()->getPais()  ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pt-5">
                    <h3>Descripción</h3>
                    <p class="p-descripcion"><?= $disco->getDescripcion() ?></p>
                </div>

                
            <?php } else { ?>

                <h2 class="text-center">El producto que buscás no está disponible en este momento</h2>

            <?php } ?>
        </div>


    </div>
</section>