<?php 

$discoId = $_GET['id'] ?? null;
$disco = Disco::filtrarPorId($discoId);
$back = $_GET['back'] ?? null;
$bandaId = $_GET['banda_id'] ?? null;
$return = $_GET['return'] ?? 'index.php?seccion=adm_discos&text=discos';

?>

<section class="container" id="eliminar">
    <?php if(!$disco) { ?>
        <h3 class="text-center">No existe el disco que querés eliminar. </h3>
    <?php } else { ?>
        

        <h3 class="text-center">Estás seguro que deseas eliminar el disco <span class="fs-2"><?= $disco->getTitulo() ?></span>?</h3>
        <img src="../img/portadas/<?= $disco->getImagenPortada() ?>" alt="Portada del disco <?= $disco->getTitulo() ?>" class="img-fluid m-auto d-block">
        <div class="d-flex justify-content-center flex-column flex-md-row gap-3 pt-5">
            <a href="actions/eliminar_disco_acc.php?id=<?= $disco->getId() ?>&return=<?= urlencode($return) ?>">
                Si, eliminar!
            </a>
            <a href="<?= ($back==='banda' && ctype_digit((string)$bandaId)) ? 'index.php?seccion=eliminar_banda&id='.$bandaId.'&text=bandas' : 'index.php?seccion=adm_discos&text=discos' ?>">
                Regresar
            </a>
        </div>
    
    <?php } ?>

</section>