<?php

require_once '../../functions/autoloader.php';

function backWithErrors(array $errors, array $old): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header('Location: ../index.php?seccion=agregar_genero&text=generos');
    exit;
}

$old = $_POST;
$errors = [];

$nombre = trim($_POST['nombre'] ?? '');
$historia = trim($_POST['historia'] ?? '');

if ($nombre === '') {
    $errors['nombre'] = 'El nombre del género es obligatorio.';
}

if ($errors) {
    backWithErrors($errors, $old);
}

try {
    Genero::instert($nombre, $historia);
} catch (Throwable $error) {
    $errors['general'] = 'No se pudo subir el género.';
    backWithErrors($errors, $old);
}

unset($_SESSION['form_errors'], $_SESSION['form_old']);

header('Location: ../index.php?seccion=adm_generos&text=generos');
exit;