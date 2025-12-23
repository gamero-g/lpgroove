<?php
    $bandas = Banda::getTodasLasBandas();
?>

<section class="container" id="adm-tabla">
    <a href="index.php?seccion=agregar_banda&text=<?= urlencode('agregar banda') ?>" class="d-flex justify-content-center align-items-center text-decoration-none mt-5"><i class="fa-solid fa-plus fs-4 pe-3"></i>Agregar nueva banda</a>
    <div class="table-responsive mb-5">
        <table class="mt-5">
            <thead>
                <tr>
                    <th scope="col" class="p-4 text-center">Logo</th>
                    <th scope="col" class="p-4 text-center">Nombre</th>
                    <th scope="col" class="p-4 text-center">Integrantes</th>
                    <th scope="col" class="p-4 text-center">País</th>
                    <th scope="col" class="p-4 text-center">Año de formación</th>
                    <th scope="col" class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bandas as $banda) { ?>
                    <tr>
                        <td class="p-4 text-center align-middle"><img src="../img/logos/<?= $banda->getImagen_banda() ?>" alt="Logo de la banda <?= $banda->getNombre() ?>" class="img-tabla-adm-discos"></td>
                        <td class="p-4 text-center align-middle"><?= $banda->getNombre() ?></td>
                        <td class="p-4 text-center align-middle"><?= $banda->getIntegrantes() ?></td>
                        <td class="p-4 text-center align-middle"><?= $banda->getPais() ?></td>
                        <td class="p-4 text-center align-middle"><?= $banda->getAnio_de_formacion() ?></td>
                        
                        <td class="p-4 text-center align-middle">
                            <div class="d-flex gap-3"> 
                                <a class="btn btn-secondary mb-2" href="index.php?seccion=editar_banda&id=<?= $banda->getId() ?>&text=<?= urlencode('editar banda') ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger mb-2 me-3" href="index.php?seccion=eliminar_banda&id=<?= $banda->getId() ?>&text=<?= urlencode('eliminar banda') ?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>  
                <?php } ?>
            </tbody>
        </table>
    </div>
    

</section>