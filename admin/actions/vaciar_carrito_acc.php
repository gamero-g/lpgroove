<?php 
require_once "../../functions/autoloader.php";
Carrito::eliminarTodosLosItems();
header('Location: ../../index.php?seccion=carrito');