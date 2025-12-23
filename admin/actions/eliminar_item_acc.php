<?php 


require_once '../../functions/autoloader.php';


$id = $_GET['id'] ?? null;

if($id) {
    Carrito::eliminarItem($id);
    header('Location: ../../index.php?seccion=carrito');
}