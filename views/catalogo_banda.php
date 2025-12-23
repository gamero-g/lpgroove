<?PHP
require_once 'functions/autoloader.php';
$nombreBandaURL = isset($_GET['banda']) ? $_GET['banda'] : false;

if ($nombreBandaURL) {
    $nombreBanda = str_replace("_", " ", $nombreBandaURL);
    $catalogoBanda = Disco::filtrarPorBanda($nombreBanda);
    if($catalogoBanda) {
        $banda = Banda::getBandaPorId($catalogoBanda[0]->getBanda()->getId());
        foreach ($catalogoBanda as $disco) {
            foreach ($disco->getGeneros() as $genero) {
                $banda->generosBanda($genero->getNombre_genero());
            }
        }
    }
}

?>

<section>
    <?php if (!empty($catalogoBanda)){?>
        <div class="bg-banda ps-3 p-3 pt-5 text-personalizado">
            <!-- <h2 class="fs-1">Nuestro catálogo</h2> -->
            <div class="d-flex flex-column flex-md-row justify-content-between gap-4 container">
            <div>
                <img  src="img/logos/<?= $banda->getImagen_banda() ?>" alt="Logo de la banda <?= $banda->getNombre() ?>">
            </div>
            <div class="w-100">
                <div>
                    <div>
                        <?php foreach ($banda->getGeneros() as $genero) { ?>
                            <span class="spanGenero"><?= $genero ?></span>
                        <?php } ?>
                    </div>
                    <h2 class="text-light"><?= ucwords($nombreBanda) ?></h2>
                </div>
                <p>Los integrantes de la banda o artista: <?= ($banda->getIntegrantes() === '') ? $banda->getNombre() : $banda->getIntegrantes() ?>, formada en el año <?= $banda->getAnio_de_formacion() ?> y creada en <?= $banda->getPais() ?></p>
            </div>
            </div>
            
        </div>

        <div class="especificidad d-flex flex-wrap flex-column flex-md-row justify-content-center justify-content-xl-between gap-2 gap-xl-0 pt-2 pb-3 catalogo-banda container" id="productos">

            <?php foreach ($catalogoBanda as $disco){?>
                <section class="p-4">
                    <div class="d-flex justify-content-between">
                        <h3 class="fs-3"><?= $disco->getTitulo() ?></h3>
                        <span><?= $disco->getAnioDeLanzamiento() ?></span>
                    </div>
                    <a href="index.php?seccion=detalle_producto&id=<?= $disco->getId() ?>" class="bg-transparent text-decoration-none d-block">
                        <div class="d-flex aparecer-vinilo justify-content-center">
                            <img src="img/portadas/<?= $disco->getImagenPortada() ?>" alt="<?= $disco->getTitulo() ?>" class="portada">
                            <img src="img/vinilo/<?= $disco->getImagenVinilo() ?>" alt="Imagen de vinilo" class="disco">
                        </div>
                    </a>
                    <div class="detalles d-flex gap-2">
                        <p><?= $disco->getCantidadCanciones() ?> canciones</p>
                        <p>-</p>
                        <p><?= $disco->getDuracion() ?></p>
                    </div>
                    <p><?= $disco->recortarDescripcion() ?></p>
                    <div class="text-center"><?= $disco->generarOferta() ?></div>
                    <a href="index.php?seccion=detalle_producto&id=<?= $disco->getId() ?>" class="text-decoration-none text-black">Comprar ahora</a>
                </section>
            <?PHP } ?>
        <?PHP }else{?>
            <h2 class="text-black text-center py-5">No se encontraron discos para esta banda.</h2>
        <?PHP } ?>
    </div>
    
</section>