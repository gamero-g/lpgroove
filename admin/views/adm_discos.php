<?php

    $discos = Disco::obtenerCatalogoCompletoCompleto();

?>

<section class="container" id="adm-tabla">
    <a href="index.php?seccion=agregar_disco&text=<?= urlencode('agregar disco') ?>" class="d-flex justify-content-center align-items-center text-decoration-none mt-5"><i class="fa-solid fa-plus fs-4 pe-3"></i>Agregar nuevo disco</a>
    <div class="table-responsive mb-5">
        <table class="mt-5">
            <thead>
                <tr>
                    <!-- <th scope="col"  class="p-4">id</th> -->
                    <th  scope="col"  class="p-4 text-center">Portada</th>
                    <th  scope="col"  class="p-4 text-center">Banda</th>
                    <th  scope="col"  class="p-4 text-center">Descuento</th>
                    <th  scope="col"  class="p-4 text-center">Titulo</th>
                    <th  scope="col"  class="p-4 text-center">Canciones</th>
                    <th  scope="col"  class="p-4 text-center">Duración</th>
                    <th  scope="col"  class="p-4 text-center">Año</th>
                    <th  scope="col"  class="p-4 text-center">Vinilo</th>
                    <th  scope="col"  class="p-4 text-center">Condición</th>
                    <th  scope="col"  class="p-4 text-center">Estado</th>
                    <th  scope="col"  class="p-4 text-center">Rating</th>
                    <th  scope="col"  class="p-4 text-center">Precio</th>
                    <th  scope="col"  class="p-4 text-center">Stock</th>
                    <th  scope="col"  class="p-4 text-center">Unidades</th>
                    <th  scope="col"  class="p-4 text-center">Destacado</th>
                    <th  scope="col"  class="p-4 text-center">Descripcion</th>
                    <th  scope="col"  class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($discos as $disco) { ?>
                    <tr>
                        <td class="p-4 text-center align-middle"><img src="../img/portadas/<?=$disco->getImagenPortada() ?>" alt="Imagen de la portada del disco <?= $disco->getTitulo() ?>" class="img-tabla-adm-discos"></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getBanda()->getNombre() ?></td>
                        <td class="p-4 text-center align-middle"><?php if($disco->getOferta()) { echo $disco->getOferta()->getEvento();}  ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getTitulo() ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getCantidadCanciones() ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getDuracion() ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getAnioDeLanzamiento() ?></td>
                       
                        <td class="p-4 text-center align-middle"><img src="../img/vinilo/vinilo_default.webp" alt="Imagen del vinilo del disco <?= $disco->getTitulo() ?>" class="img-tabla-adm-discos"></td>
                        <td class="p-4 text-center align-middle"><?= ucfirst($disco->getCondicion()) ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getEstado() ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getRating() ?></td>
                        <td class="p-4 text-center align-middle text-success">$<?= $disco->getPrecio() ?></td>
                        <td class="p-4 text-center align-middle"><?= ($disco->getStock() === 1) ? '<i class="fa-solid fa-circle-check text-success"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>' ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->getUnidades() ?></td>
                        <td class="p-4 text-center align-middle"><?= ($disco->getDestacado() === 1) ? '<i class="fa-solid fa-star text-warning"></i>' : '<i class="fa-solid fa-star text-secondary"></i>' ?></td>
                        <td class="p-4 text-center align-middle"><?= $disco->recortarDescripcion() ?></td>
                        
                        <td>
                            <div class="d-flex gap-3">
                                <a class="btn btn-secondary mb-2" href="index.php?seccion=editar_disco&id=<?= $disco->getId() ?>&text=<?= urlencode('editar disco') ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger mb-2 me-3" href="index.php?seccion=eliminar_disco&id=<?= $disco->getId() ?>&text=<?= urlencode('eliminar disco') ?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>  
                <?php } ?>
            </tbody>
        </table>
    </div>


</section>