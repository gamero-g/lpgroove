<?php 

require_once '../../functions/autoloader.php';

function backWithErrors(array $errors, array $old): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header('Location: ../index.php?seccion=agregar_disco&text=agregar disco');
    exit;
}

$discoDatos = $_POST;
$discoArchivos = $_FILES['portada'] ?? null;

$old = $discoDatos;
$errors = [];

function isIntStr($v): bool { return $v !== '' && ctype_digit((string)$v); }

if (!isIntStr($discoDatos['banda'] ?? '')) {
    $errors['banda'] = 'La banda es obligatoria.';
}

if (empty($discoDatos['descuento'])) {
    $discoDatos['descuento'] = null;
} else if (!isIntStr($discoDatos['descuento'])) {
    $errors['descuento'] = 'El descuento es inválido.';
}

$titulo = trim($discoDatos['titulo'] ?? '');
if ($titulo === '') $errors['titulo'] = 'El título es obligatorio.';
$discoDatos['titulo'] = $titulo;

if (!isIntStr($discoDatos['cantidad_canciones'] ?? '')) {
    $errors['cantidad_canciones'] = 'La cantidad de canciones debe ser un número entero.';
}

$duracion = trim($discoDatos['duracion'] ?? '');
if ($duracion === '') {
    $errors['duracion'] = 'La duración es obligatoria.';
} else {
    if (preg_match('/^\d{2}:\d{2}$/', $duracion)) $duracion .= ':00';
    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/', $duracion)) {
        $errors['duracion'] = 'Duración inválida. Formato HH:MM:SS.';
    }
}
$discoDatos['duracion'] = $duracion;

$anio = trim($discoDatos['anio_de_lanzamiento'] ?? '');
if (!preg_match('/^\d{4}$/', $anio)) {
    $errors['anio_de_lanzamiento'] = 'El año debe tener 4 dígitos.';
}

if (!$discoArchivos || ($discoArchivos['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    $errors['portada'] = 'La portada es obligatoria.';
}

$condicion = $discoDatos['condicion'] ?? '';
if (!in_array($condicion, ['nuevo','usado'], true)) {
    $errors['condicion'] = 'La condición es obligatoria.';
}

$estadosPermitidos = ["Excelente","Detalles Estéticos","Muy Bueno","Bueno","Regular","Malo","Muy Malo"];
if (!in_array(($discoDatos['estado'] ?? ''), $estadosPermitidos, true)) {
    $errors['estado'] = 'El estado es obligatorio.';
}

$ratingsPermitidos = ["1.00 / 5.00","2.00 / 5.00","3.00 / 5.00","4.00 / 5.00","5.00 / 5.00"];
if (!in_array(($discoDatos['rating'] ?? ''), $ratingsPermitidos, true)) {
    $errors['rating'] = 'El rating es obligatorio.';
}

$precioRaw = trim($discoDatos['precio'] ?? '');
if ($precioRaw === '') {
    $errors['precio'] = 'El precio es obligatorio.';
} else {
    if (!preg_match('/^\d+(?:[.,]\d{1,2})?$/', $precioRaw)) {
        $errors['precio'] = 'Precio inválido. Ej: 123,45';
    }
}
$discoDatos['precio'] = str_replace(',', '.', $precioRaw);

if (!in_array(($discoDatos['stock'] ?? ''), ['0','1'], true)) {
    $errors['stock'] = 'Stock es obligatorio.';
}

if (!in_array(($discoDatos['destacado'] ?? ''), ['0','1'], true)) {
    $errors['destacado'] = 'Destacado es obligatorio.';
}

if (!isIntStr($discoDatos['unidades'] ?? '')) {
    $errors['unidades'] = 'Unidades debe ser un número.';
}

$discoDatos['descripcion'] = trim($discoDatos['descripcion'] ?? '');

if (isset($discoDatos['generos']) && is_array($discoDatos['generos'])) {
    foreach ($discoDatos['generos'] as $g) {
        if (!isIntStr($g)) {
            $errors['generos'] = 'Géneros inválidos.';
            break;
        }
    }
}

if ($errors) backWithErrors($errors, $old);

try {
    $imagen = Imagen::subirImagen($discoArchivos, '../../img/portadas/');

    $discoId = Disco::insert(
        $discoDatos['banda'],
        $discoDatos['descuento'],
        $discoDatos['titulo'],
        $discoDatos['cantidad_canciones'],
        $discoDatos['duracion'],
        $discoDatos['anio_de_lanzamiento'],
        $discoDatos['condicion'],
        $discoDatos['estado'],
        $discoDatos['rating'],
        $discoDatos['precio'],
        $discoDatos['stock'],
        $discoDatos['unidades'],
        $discoDatos['destacado'],
        $discoDatos['descripcion'],
        $imagen
    );

    if (isset($discoDatos['generos'])) {
        foreach ($discoDatos['generos'] as $genero) {
            Disco::insertDiscoXGenero($discoId, $genero);
        }
    }

} catch (Throwable $error) {
    $errors['general'] = 'No se pudo insertar el disco.';
    backWithErrors($errors, $old);
}

unset($_SESSION['form_errors'], $_SESSION['form_old']);
header('Location: ../index.php?seccion=adm_discos&text=discos');
exit;