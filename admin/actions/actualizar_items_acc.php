<?php
require_once "../../functions/autoloader.php";

$postData = $_POST;


if(!empty($postData)) {
    Carrito::actualizarCantidades($postData['cant']);
    header('Location: ../../index.php?seccion=carrito');
}

?>