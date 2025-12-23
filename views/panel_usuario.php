<?php
$compras = Compra::comprasPorUsuario($_SESSION['logueado']['id']);
?>

<section class="" id="panelUsuario">
    <h2 class="text-center text-light"><?= $_SESSION['logueado']['usuario'] ?></h2>
    <div class="container">
        <div>
            <?= ALerta::obtenerAlertas() ?>
        </div>

        <div>
            <h3 class="text-center text-light fs-4">Tus útlimas compras</h3>
            <div class="table-responsive rounded" id="carrito">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Fecha</th>
                            <th scope="col" class="w-25">Cantidad</th>
                            <th scope="col">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compras as $compra) { ?>
                            <tr>
                                <td class="align-middle"><img src="img/portadas/<?= $compra['imagen_portada'] ?>" alt="Portada del album <?= $compra['titulo'] ?>" class="img-fluid img-carrito"></td>

                                <td class="align-middle">
                                    <h4><?= $compra['titulo'] ?></h4>
                                </td>
                                <td class="align-middle">
                                    <span><?=  $compra['fecha'] ?></span>
                                </td>
                                <td class="align-middle">
                                    <p><?= $compra['cantidad'] ?></p>
                                </td>
                                <td class="align-middle">
                                    <p>$<?= $compra['importe']?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>