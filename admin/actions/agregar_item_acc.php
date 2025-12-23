<?php 
require_once '../../functions/autoloader.php';


$id = $_GET['id'] ?? null;
$cantidad = $_GET['cantidadProducto'] ?? 1;


if($id) {
    Carrito::agregar_item($id, $cantidad);
    header('Location: ../../index.php?seccion=carrito');
}

?>