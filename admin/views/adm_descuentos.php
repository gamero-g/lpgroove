<?php
    $todosLosDescuentos = Descuento::getTodosLosDescuentos();
?>

<section class="container" id="adm-tabla">
    <a href="index.php?seccion=agregar_descuento&text=<?= urlencode('agregar descuento') ?>" class="d-flex justify-content-center align-items-center text-decoration-none mt-5"><i class="fa-solid fa-plus fs-4 pe-3"></i>Agregar nuevo descuento</a>
    <div class="table-responsive d-flex justify-content-center">
        <table class="mt-5">
            <thead>
                <tr>
                    <th scope="col" class="p-4 text-center">id</th>
                    <th scope="col" class="p-4 text-center">Cantidad %</th>
                    <th scope="col" class="p-4 text-center">Inicio</th>
                    <th scope="col" class="p-4 text-center">Finalización</th>
                    <th scope="col" class="p-4 text-center">Evento</th>
                    <th scope="col" class="p-4 text-center">Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($todosLosDescuentos as $descuento) { ?>
                    <tr>
                        <th class="p-4 text-center align-middle"><?= $descuento->getId() ?></th>
                        <td class="p-4 text-center align-middle"><?= $descuento->getCantidad_descuento() ?></td>
                        <td class="p-4 text-center align-middle"><?= $descuento->getFecha_inicio() ?></td>
                        <td class="p-4 text-center align-middle"><?= $descuento->getFinalizacion() ?></td>
                        <td class="p-4 text-center align-middle"><?= $descuento->getEvento() ?></td>
                        <td class="p-4 text-center align-middle">
                            <div class="d-flex gap-3"> 
                                <a  class="btn btn-secondary mb-2" href="index.php?seccion=editar_descuento&id=<?= $descuento->getId() ?>&text=<?= urlencode('editar descuento') ?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                <a class="btn btn-danger  mb-2 me-3" href="index.php?seccion=eliminar_descuento&id=<?= $descuento->getId() ?>&text=<?= urlencode('eliminar descuento') ?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>  
                <?php } ?>
            </tbody>
        </table>
    </div>


</section>