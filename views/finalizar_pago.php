<?php 
    if(isset($_SESSION['carrito'])) {
        $items = $_SESSION['carrito'];
    }
    
    
    $total = Carrito::total();

   
?>

<section class="container " id="finalizarCompra">
    <?php if(!empty($_SESSION['carrito'])) { ?>
        <h2 class="text-center pb-4">Finalizar compra</h2>
        <div class="d-flex flex-column justify-content-center">
        <div>
            <h3>Tus datos</h3>
            <?php if($_SESSION['logueado']) { ?>
                <span>Nombre: <?= $_SESSION['logueado']['usuario'] ?></span>
            <?php } else {
                
            }?>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $id => $item) { ?>
                        <tr>
                            <td class="align-middle">
                                <h3><?= $item['producto'] ?></h3>
                            </td>
                            <td class="align-middle">
                                <p><?= $item['cantidad'] ?></p>
                            </td>
                            <td class="align-middle">
                                <p>$<?= number_format($item['precio'], 2, ",", ".") ?></p>
                            </td>
                            <td class="align-middle">
                                <p>$<?= number_format($item['precio'] * $item['cantidad'], 2, ",", ".") ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td class="align-middle text-end" colspan="3">
                                <span class="fs-3">Total:</span>
                            </td>
                            <td class="align-middle text-end">
                                <span>$<?= number_format($total, 2, ",", ".")?></span>
                            </td> 
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center pt-4">
            <a href="admin/actions/checkout_acc.php" class="pagar text-center">Pagar</a>
        </div>
    </div>
    <?php } else { ?>
        <h2 class="text-center">Primero, agregá productos a tu carrito para continuar con el pago.</h2>
    <?php }?>
</section>