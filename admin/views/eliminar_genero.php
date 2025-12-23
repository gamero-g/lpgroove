<?php
$generoId = $_GET['id'] ?? null;
$genero = Genero::getGeneroPorId($generoId);

$msg = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_error']);

function getDiscoIdsPorGenero(PDO $conexion, int $generoId): array {
    try {
        $stmt = $conexion->prepare("SELECT discos_id FROM discos_x_generos WHERE generos_id = ?");
        $stmt->execute([$generoId]);
        $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return array_map('intval', $ids);
    } catch (Throwable $e) {
        return [];
    }
}

$discos = [];

if ($genero && $generoId && ctype_digit((string)$generoId)) {
    $conexion = Conexion::getConexion();
    $discoIds = getDiscoIdsPorGenero($conexion, (int)$generoId);

    foreach ($discoIds as $id) {
        $d = Disco::filtrarPorId($id);
        if ($d) $discos[] = $d;
    }
}
?>

<section class="container" id="eliminar">
    <?php if(!$genero) { ?>
        <h3 class="text-center">No existe el género que querés eliminar.</h3>

        <div class="d-flex justify-content-center gap-3 pt-4">
            <a href="index.php?seccion=adm_generos&text=generos">Regresar</a>
            <a href="index.php?seccion=adm_discos&text=discos">Ir a Discos</a>
        </div>

    <?php } else { ?>

        <?php if ($msg): ?>
            <div class="alert alert-warning mt-4">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <?php if (count($discos) > 0) { ?>

            <h3 class="text-center">
                No se puede eliminar el género
                <span class="fs-2"><?= htmlspecialchars($genero->getNombre_genero()) ?></span>
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

            <div class="d-flex justify-content-center gap-3 pb-5">
                <a href="index.php?seccion=adm_generos&text=generos">Regresar</a>
                <a href="index.php?seccion=adm_discos&text=discos">Ir a Discos</a>
            </div>

        <?php } else { ?>

            <h3 class="text-center">
                Estás seguro que deseas eliminar el género
                <span class="fs-2"><?= htmlspecialchars($genero->getNombre_genero()) ?></span>?
            </h3>

            <div class="d-flex justify-content-center flex-column flex-md-row gap-3">
                <a href="actions/eliminar_genero_acc.php?id=<?= $genero->getId() ?>">Si, estoy seguro.</a>
                <a href="index.php?seccion=adm_generos&text=generos">Regresar</a>
            </div>

        <?php } ?>

    <?php } ?>
</section>
