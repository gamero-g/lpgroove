<?php
$bandaId = $_GET['id'] ?? null;
$banda = Banda::getBandaPorId($bandaId);

$msg = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_error']);

$discosBanda = [];

if ($banda) {
    $todos = Disco::obtenerCatalogoCompletoCompleto();

    $discosBanda = array_values(array_filter($todos, function($disco) use ($bandaId) {
        return (string)$disco->getBanda()->getId() === (string)$bandaId;
    }));
}
?>

<section class="container" id="eliminar">
    <?php if(!$banda) { ?>
        <h3 class="text-center">Esa banda no está dando ningún concierto!</h3>
        <div class="d-flex justify-content-center pt-4">
            <a href="index.php?seccion=adm_bandas&text=bandas">Regresar</a>
        </div>

    <?php } else { ?>
        <div class="text-center my-4">
            <img src="../img/logos/<?= htmlspecialchars($banda->getImagen_banda()) ?>" alt="Logo de la banda <?= htmlspecialchars($banda->getNombre()) ?>" class="img-fluid d-block mx-auto" style="max-width: 240px;">
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-danger mt-4">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <?php if (count($discosBanda) > 0) { ?>

            <div class="alert alert-warning mt-4">
                Para borrar a <strong><?= htmlspecialchars($banda->getNombre()) ?></strong> primero tenés que borrar su discografía.
            </div>

            <h3 class="text-center mb-3">
                Discografía de <span class="fs-2"><?= htmlspecialchars($banda->getNombre()) ?></span>
            </h3>

            <div class="table-responsive mb-5" id="adm-tabla">
                <table class="mt-3">
                    <thead>
                        <tr>
                            <th scope="col" class="p-4 text-center">Portada</th>
                            <th scope="col" class="p-4 text-center">Titulo</th>
                            <th scope="col" class="p-4 text-center">Año</th>
                            <th scope="col" class="p-4 text-center">Precio</th>
                            <th scope="col" class="p-4 text-center">Stock</th>
                            <th scope="col" class="p-4 text-center">Unidades</th>
                            <th scope="col" class="p-4 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($discosBanda as $disco) { ?>
                            <tr>
                                <td class="p-4 text-center align-middle">
                                    <img src="../img/portadas/<?= htmlspecialchars($disco->getImagenPortada()) ?>"
                                         alt="Imagen de la portada del disco <?= htmlspecialchars($disco->getTitulo()) ?>"
                                         class="img-tabla-adm-discos">
                                </td>

                                <td class="p-4 text-center align-middle">
                                    <?= htmlspecialchars($disco->getTitulo()) ?>
                                </td>

                                <td class="p-4 text-center align-middle">
                                    <?= htmlspecialchars($disco->getAnioDeLanzamiento()) ?>
                                </td>

                                <td class="p-4 text-center align-middle text-success">
                                    $<?= htmlspecialchars($disco->getPrecio()) ?>
                                </td>

                                <td class="p-4 text-center align-middle">
                                    <?= ($disco->getStock() === 1)
                                        ? '<i class="fa-solid fa-circle-check text-success"></i>'
                                        : '<i class="fa-solid fa-xmark text-danger"></i>' ?>
                                </td>

                                <td class="p-4 text-center align-middle">
                                    <?= htmlspecialchars($disco->getUnidades()) ?>
                                </td>

                                <td>
                                    <div class="d-flex gap-3">
                                        <a class="btn btn-secondary mb-2"
                                           href="index.php?seccion=editar_disco&id=<?= $disco->getId() ?>&text=<?= urlencode('editar disco') ?>">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <?php
                                            $return = urlencode("index.php?seccion=eliminar_banda&id={$banda->getId()}&text=" . urlencode('bandas'));
                                        ?>

                                        <a class="btn btn-danger mb-2 me-3" href="index.php?seccion=eliminar_disco&id=<?= $disco->getId() ?>&text=<?= urlencode('eliminar disco') ?>&return=<?= $return ?>"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center gap-3 pb-5">
                <a href="index.php?seccion=adm_bandas&text=<?= urlencode('bandas') ?>">Regresar</a>
            </div>

        <?php } else { ?>

            <h3 class="text-center">
                Estás seguro que deseas eliminar a la banda
                <span class="fs-2"><?= htmlspecialchars($banda->getNombre()) ?></span>?
            </h3>

            <!--<img src="../img/logos/<?= htmlspecialchars($banda->getImagen_banda()) ?>" alt="Logo de la banda <?= htmlspecialchars($banda->getNombre()) ?>" class="d-block m-auto img-fluid">-->

            <div class="d-flex flex-column flex-md-row justify-content-center gap-3 pt-5">
                <a href="actions/eliminar_banda_acc.php?id=<?= $banda->getId() ?>">Si, estoy seguro.</a>
                <a href="index.php?seccion=adm_bandas&text=bandas">Regresar</a>
            </div>

        <?php } ?>

    <?php } ?>
</section>
