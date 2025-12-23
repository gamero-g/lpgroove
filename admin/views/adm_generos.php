<?php 

$generos = Genero::getTodosLosGeneros();

?>


<section class="container" id="adm-tabla">
     <a href="index.php?seccion=agregar_genero&text=<?= urlencode('agregar genero') ?>" class="d-flex justify-content-center align-items-center text-decoration-none mt-5"><i class="fa-solid fa-plus fs-4 pe-3"></i>Agregar nuevo género</a>
    <div class="table-responsive mb-5">
        <table class="mt-4 tabla-generos">
            <thead>
                <tr>
                    <th scope="col" class="p-4 text-center">Género</th>
                    <th scope="col" class="p-4 text-center">Historia</th>
                    <th scope="col" class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($generos as $genero) { ?>
                    <tr>
                        <td class="fw-bold text-center align-middle"><?= $genero->getNombre_genero() ?></td>
                        <td class="text-center align-middle"><?= Genero::recortarDescripcion($genero->getHistoria()) ?></td>
                        <td class="p-4 text-center align-middle">
                            <div class="d-flex justify-content-center gap-3"> 
                                <a class="btn btn-secondary mb-2" href="index.php?seccion=editar_genero&id=<?= $genero->getId() ?>&text=<?= urlencode('editar género') ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger mb-2" href="index.php?seccion=eliminar_genero&id=<?= $genero->getId() ?>&text=<?= urlencode('eliminar género') ?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>  
                <?php } ?>
            </tbody>
        </table>
    </div>


</section>