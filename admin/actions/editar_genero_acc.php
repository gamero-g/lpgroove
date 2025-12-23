<?php 

require_once '../../functions/autoloader.php';

function backWithErrors(array $errors, array $old, $id): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header("Location: ../index.php?seccion=editar_genero&id=$id&text=generos");
    exit;
}

$generoId = $_GET['id'] ?? null;
if (!$generoId || !ctype_digit((string)$generoId)) {
    $_SESSION['flash_error'] = 'ID inválido.';
    header('Location: ../index.php?seccion=adm_generos&text=generos');
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
    backWithErrors($errors, $old, $generoId);
}

try {
    $genero = Genero::getGeneroPorId($generoId);
    if (!$genero) {
        $_SESSION['flash_error'] = 'No se encontró el género.';
        header('Location: ../index.php?seccion=adm_generos&text=generos');
        exit;
    }

    $genero->edit($nombre, $historia);

} catch (Throwable $error) {
    $errors['general'] = 'No se pudo editar el género.';
    backWithErrors($errors, $old, $generoId);
}

unset($_SESSION['form_errors'], $_SESSION['form_old']);

header('Location: ../index.php?seccion=adm_generos&text=generos');
exit;