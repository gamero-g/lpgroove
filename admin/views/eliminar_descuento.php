<?php
$errors = $_SESSION['form_errors'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);

$descuentoId = $_GET['id'] ?? null;
$descuento = Descuento::getDescuentoPorId($descuentoId);

$discos = [];

if ($descuento && $descuentoId && ctype_digit((string)$descuentoId)) {
    $Conexion = Conexion::getConexion();
    $stmt = $Conexion->prepare("SELECT id FROM discos WHERE descuento_id = ?");
    $stmt->execute([(int)$descuentoId]);
    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($ids as $id) {
        $d = Disco::filtrarPorId((int)$id);
        if ($d) $discos[] = $d;
    }
}
?>

<section class="container" id="eliminar">

    <?php if(!$descuento) { ?>
        <h3 class="text-center">No existe el descuento que querés eliminar.</h3>

        <div class="d-flex justify-content-center gap-2 mt-3">
            <a href="index.php?seccion=adm_descuentos&text=descuentos" class="btn btn-outline-light">Regresar</a>
        </div>

    <?php } else { ?>

        <?php if (!empty($errors['general'])): ?>
            <div class="alert alert-warning mt-4">
                <?= htmlspecialchars($errors['general']) ?>
            </div>
        <?php endif; ?>

        <?php if (count($discos) > 0) { ?>

            <h3 class="text-center">
                No se puede eliminar el descuento de
                <span class="fs-2"><?= htmlspecialchars($descuento->getEvento()) ?></span>
                porque está siendo usado por estos discos:
            </h3>

            <div class="table-responsive mb-5 mt-4" id="adm-tabla">
                <table class="mt-3">
                    <thead>
                        <tr>
                            <th scope="col" class="p-4 text-center">Portada</th>
                            <th scope="col" class="p-4 text-center">Banda</th>
                            <th scope="col" class="p-4 text-center">Título</th>
                            <th scope="col" class="p-4 text-center">Año</th>
                            <th scope="col" class="p-4 text-center">Precio</th>
                            <th scope="col" class="p-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($discos as $disco) { ?>
                            <tr>
                                <td class="p-4 text-center align-middle">
                                    <img src="../img/portadas/<?= htmlspecialchars($disco->getImagenPortada()) ?>"
                                         alt="Portada de <?= htmlspecialchars($disco->getTitulo()) ?>"
                                         class="img-tabla-adm-discos">
                                </td>
                                <td class="p-4 text-center align-middle">
                                    <?= htmlspecialchars($disco->getBanda()->getNombre()) ?>
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
                                    <a class="btn btn-secondary"
                                       href="index.php?seccion=editar_disco&id=<?= $disco->getId() ?>&text=<?= urlencode('editar disco') ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center gap-2 pb-5">
                <a href="index.php?seccion=adm_descuentos&text=descuentos" class="btn btn-outline-light">Regresar</a>
                <a href="index.php?seccion=adm_discos&text=discos" class="btn btn-outline-light">Ir a Discos</a>
            </div>

        <?php } else { ?>

            <h3 class="text-center">
                Estás seguro que deseas eliminar el descuento de
                <span class="fs-2"><?= htmlspecialchars($descuento->getEvento()) ?></span>?
            </h3>

            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="actions/eliminar_descuento_acc.php?id=<?= $descuento->getId() ?>" class="btn btn-light btn-editar">Si, estoy seguro.</a>
                <a href="index.php?seccion=adm_descuentos&text=descuentos" class="btn btn-outline-light">Regresar</a>
            </div>

        <?php } ?>

    <?php } ?>

</section>
