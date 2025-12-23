<?php

use function PHPSTORM_META\map;

require_once '../../functions/autoloader.php';
$items = Carrito::obtenerCarrito();
$usuarioId = $_SESSION['logueado']['id'] ?? null;

try {
    if(!$usuarioId) {
        Alerta::agregarAlerta("warning", "Su sesión expiró. Por favor, ingrese nuevamente.", "loginfront");
        header('Location: ../../index.php?seccion=login');
        exit;
    } else {
        $compraDatos = [
            "usuarioId" => $usuarioId,
            "fecha" => date('Y-m-d'),
            "importe" => Carrito::total() 
        ];

        $compraDetalle = [];

        foreach ($items as $key => $value) {
            $compraDetalle[$key] = $value['cantidad'];
        }

        Checkout::insertCompra($compraDatos, $compraDetalle);
        Carrito::eliminarTodosLosItems();

        Alerta::agregarAlerta("success", "Compra realizada con éxito", "");
    }
} catch (Exception $error) {
    Alerta::agregarAlerta("warning", "No se pudo finalizar la compra", "");
}
header('Location: ../../index.php?seccion=panel_usuario');
