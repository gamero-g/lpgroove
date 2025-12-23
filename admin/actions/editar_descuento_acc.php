<?php 


require_once '../../functions/autoloader.php';

function backEdit(array $errors, array $old, $id): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header("Location: ../index.php?seccion=editar_descuento&id=$id&text=editar descuento");
    exit;
}

$datos = $_POST;
$old = $datos;
$errors = [];

$descuentoId = $_GET['id'] ?? null;
if (!$descuentoId || !ctype_digit((string)$descuentoId)) {
    header('Location: ../index.php?seccion=adm_descuentos&text=descuentos');
    exit;
}

$cantidad = trim($datos['cantidad'] ?? '');
if ($cantidad === '' || !ctype_digit($cantidad)) {
    $errors['cantidad'] = 'La cantidad es obligatoria y debe ser un número.';
} else {
    $cant = (int)$cantidad;
    if ($cant < 1 || $cant > 100) {
        $errors['cantidad'] = 'La cantidad debe estar entre 1 y 100.';
    }
}

$fecha_inicio = trim($datos['fecha_inicio'] ?? '');
$finalizacion = trim($datos['finalizacion'] ?? '');

$dtInicio = DateTime::createFromFormat('Y-m-d', $fecha_inicio);
$dtFin = DateTime::createFromFormat('Y-m-d', $finalizacion);

if (!$dtInicio || $dtInicio->format('Y-m-d') !== $fecha_inicio) {
    $errors['fecha_inicio'] = 'Fecha de inicio inválida.';
}
if (!$dtFin || $dtFin->format('Y-m-d') !== $finalizacion) {
    $errors['finalizacion'] = 'Fecha de finalización inválida.';
}

// if (!isset($errors['fecha_inicio'])) {
//     $hoy = new DateTime('today');
//     if ($dtInicio < $hoy) {
//         $errors['fecha_inicio'] = 'La fecha de inicio debe ser hoy o posterior.';
//     }
// }

if (!isset($errors['fecha_inicio']) && !isset($errors['finalizacion'])) {
    if ($dtFin <= $dtInicio) {
        $errors['finalizacion'] = 'La finalización debe ser posterior a la fecha de inicio.';
    }
}

$evento = trim($datos['evento'] ?? '');
if ($evento === '') {
    $errors['evento'] = 'El evento es obligatorio.';
}

if ($errors) backEdit($errors, $old, $descuentoId);

try {
    $descuento = Descuento::getDescuentoPorId($descuentoId);
    if (!$descuento) {
        $errors['general'] = 'No se encontró el descuento.';
        backEdit($errors, $old, $descuentoId);
    }

    $descuento->edit($cantidad, $fecha_inicio, $finalizacion, $evento);
} catch (Throwable $e) {
    $errors['general'] = 'No fue posible actualizar el descuento.';
    backEdit($errors, $old, $descuentoId);
}

unset($_SESSION['form_errors'], $_SESSION['form_old']);
header('Location: ../index.php?seccion=adm_descuentos&text=descuentos');
exit;