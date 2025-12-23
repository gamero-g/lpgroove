<?php 

require_once '../../functions/autoloader.php';



function backWithErrors(array $errors, array $old, $id): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header("Location: ../index.php?seccion=editar_banda&id=$id&text=bandas");
    exit;
}

$bandaId = $_GET['id'] ?? null;
if (!$bandaId || !ctype_digit((string)$bandaId)) {
    die('ID inválido.');
}

$old = $_POST;
$errors = [];

$nombre = trim($_POST['nombre'] ?? '');
$integrantes = trim($_POST['integrantes'] ?? '');
$pais = trim($_POST['pais'] ?? '');
$anio = trim($_POST['anio_de_formacion'] ?? '');
$logoOg = $_POST['logo_og'] ?? '';

if ($nombre === '') {
    $errors['nombre'] = 'El nombre es obligatorio.';
}

if ($pais === '') {
    $errors['pais'] = 'El país es obligatorio.';
} elseif (!preg_match('/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s.\'-]+$/', $pais)) {
    $errors['pais'] = 'El país no puede contener números ni caracteres inválidos.';
}

if ($anio === '') {
    $errors['anio_de_formacion'] = 'El año de formación es obligatorio.';
} elseif (!preg_match('/^\d{4}$/', $anio)) {
    $errors['anio_de_formacion'] = 'El año debe tener exactamente 4 dígitos (solo números).';
} else {
    $year = (int)$anio;
    $current = (int)date('Y');
    if ($year < 1901 || $year > $current) {
        $errors['anio_de_formacion'] = "El año debe estar entre 1901 y $current.";
    }
}

if ($errors) {
    backWithErrors($errors, $old, $bandaId);
}

try {
    $banda = Banda::getBandaPorId($bandaId);
    if (!$banda) {
        die('No se encontró la banda.');
    }

    $imagen = $logoOg;

    if (isset($_FILES['logo']) && ($_FILES['logo']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
            $errors['logo'] = 'No fue posible subir el logo.';
            backWithErrors($errors, $old, $bandaId);
        }

        $imagen = Imagen::subirImagen($_FILES['logo'], '../../img/logos/');
        if (!empty($logoOg)) {
            Imagen::eliminarImagen("../../img/logos/" . $logoOg);
        }
    }

    $banda->edit($nombre, $integrantes, $pais, $anio, $imagen);

} catch (Exception $e) {
    $errors['general'] = 'No se pudo editar la banda.';
    backWithErrors($errors, $old, $bandaId);
}

unset($_SESSION['form_errors'], $_SESSION['form_old']);

header('Location: ../index.php?seccion=adm_bandas&text=bandas');
exit;

?>