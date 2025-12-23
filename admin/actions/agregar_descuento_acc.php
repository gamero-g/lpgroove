<?php 

require_once '../../functions/autoloader.php';

function backAdd(array $errors, array $old): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header('Location: ../index.php?seccion=agregar_descuento&text=agregar descuento');
    exit;
}

$datos = $_POST;
$old = $datos;
$errors = [];

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

// Reglas de fechas
/*if (!isset($errors['fecha_inicio'])) {
    $hoy = new DateTime('today');
    if ($dtInicio < $hoy) {
        $errors['fecha_inicio'] = 'La fecha de inicio debe ser hoy o posterior.';
    }
}*/

if (!isset($errors['fecha_inicio']) && !isset($errors['finalizacion'])) {
    if ($dtFin <= $dtInicio) {
        $errors['finalizacion'] = 'La finalización debe ser posterior a la fecha de inicio.';
    }
}

$evento = trim($datos['evento'] ?? '');
if ($evento === '') {
    $errors['evento'] = 'El evento es obligatorio.';
}

if ($errors) backAdd($errors, $old);

try {
    Descuento::insert($cantidad, $fecha_inicio, $finalizacion, $evento);
} catch (Throwable $e) {
    $errors['general'] = 'No se pudo agregar el descuento.';
    backAdd($errors, $old);
}

unset($_SESSION['form_errors'], $_SESSION['form_old']);
header('Location: ../index.php?seccion=adm_descuentos&text=descuentos');
exit;