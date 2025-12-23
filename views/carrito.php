<?php
    $items = Carrito::obtenerCarrito();
    $total = Carrito::total();
?>

<section class="container my-5" id="carrito">
    <div>
        <h2 class="text-center mt-3">Tu carrito</h2>
        <?php if(!$items) { ?>
           <div class="d-flex flex-column align-items-center justify-content-center">
                <h3 class="text-center vacio fw-normal fs-4">No hay productos en tu carrito!</h3>
                <div class="d-flex justify-content-center">
                    <a href="index.php?seccion=catalogo" class="agregarP">Agregar productos</a>
                </div>
           </div>
        <?php } else { ?>
            <?php if($items) { ?>
                <div class="d-flex">
                    <a href="index.php?seccion=catalogo" class="seguirC"><i class="bi bi-chevron-left pe-2"></i>Seguir comprando</a>
                </div>
            <?php } ?>
            <div>
                <form action="admin/actions/actualizar_items_acc.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Portada</th>
                                <th scope="col">Producto</th>
                                <th scope="col" class="w-25">Cantidad</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($items as $id => $item) { ?>
                                <tr>
                                <td class="align-middle">
                                    <img src="img/portadas/<?= htmlspecialchars($item['portada']) ?>"
                                        alt="Portada del album <?= htmlspecialchars($item['producto']) ?>"
                                        class="img-fluid img-carrito">
                                </td>

                                <td class="align-middle">
                                    <h3 class="mb-0"><?= htmlspecialchars($item['producto']) ?></h3>
                                </td>

                                <td class="align-middle">
                                    <div class="form-floating">
                                    <input type="number"
                                            class="form-control"
                                            id="cant_<?= (int)$id ?>"
                                            name="cant[<?= (int)$id ?>]"
                                            value="<?= (int)$item['cantidad'] ?>"
                                            max="<?= (int)$item['cantMax'] ?>"
                                            min="1">
                                    <label for="cant_<?= (int)$id ?>">Cantidad</label>
                                    </div>
                                </td>

                                <td class="align-middle">
                                    <p class="mb-0">$<?= number_format($item['precio'], 2, ",", ".") ?></p>
                                </td>

                                <td class="align-middle">
                                    <p class="mb-0">$<?= number_format($item['precio'] * $item['cantidad'], 2, ",", ".") ?></p>
                                </td>

                                <td class="align-middle">
                                    <a href="admin/actions/eliminar_item_acc.php?id=<?= (int)$id ?>" class="btn btn-danger">
                                    <i class="bi bi-x-lg"></i>
                                    </a>
                                </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td class="align-middle text-end" colspan="5">
                                <span class="fs-4">Total:</span>
                                </td>
                                <td class="align-middle text-end">
                                <span>$<?= number_format($total, 2, ",", ".") ?></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>

                    <div class="d-flex flex-column flex-md-row justify-content-end align-items-center my-4 gap-3">
                        <input type="submit" value="Actualizar cantidades">
                        <a href="admin/actions/vaciar_carrito_acc.php" class="vaciar text-center">Vaciar carrito</a>
                    </div>
                </form>
            </div>
        <?php } ?>
        <?php if($items) { ?>
            <div class="d-flex justify-content-center pb-4">
                <a href="index.php?seccion=finalizar_pago" class="finalizar text-center">Finalizar compra</a>
            </div>
        <?php } ?>
    </div>
</section>
