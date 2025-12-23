<?php
require_once "../../functions/autoloader.php";

$donde = $_GET['donde'] ?? 'front';
$donde = strtolower(trim($donde));

if (!in_array($donde, ['front', 'back'], true)) {
    $donde = 'front';
}

Carrito::vaciar();

Usuario::logout();

if ($donde === 'front') {
    header('Location: ../../index.php?seccion=home');
    exit;
}

header('Location: ../index.php?seccion=login');
exit;


