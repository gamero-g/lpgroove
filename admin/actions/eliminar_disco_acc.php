<?php
require_once '../../functions/autoloader.php';

$discoId = $_GET['id'] ?? null;

$redirectTo = '../index.php?seccion=adm_discos&text=discos';

if (!empty($_GET['return'])) {
    $candidate = urldecode($_GET['return']);
    //solo permitimos volver a index.php
    if (str_starts_with($candidate, 'index.php')) {
        $redirectTo = '../' . $candidate;
    }
}

if (!$discoId || !ctype_digit((string)$discoId)) {
    header('Location: ' . $redirectTo);
    exit;
}

try {
    $disco = Disco::filtrarPorId((int)$discoId);

    if (!$disco) {
        Alerta::agregarAlerta("danger", "No se encontró el disco que intentás eliminar.", "discosback");
        header('Location: ../index.php?seccion=errores&texto=eliminar el disco?&donde=discosback');
        exit;
    }

    $img = $disco->getImagenPortada();
    if (!empty($img)) {
        Imagen::eliminarImagen("../../img/portadas/" . $img);
    }

    $disco->deleteDiscoXGenero();
    $disco->remove();

} catch (Throwable $error) {
    Alerta::agregarAlerta("danger", "Es posible que el disco ya haya sido comprado en algún momento. Por lo tanto, no podemos eliminarlo de la base de datos.", "discosback");
    Alerta::agregarAlerta("success", "SOLUCIÓN: sacale el stock!", "discosback");
    Alerta::agregarAlerta("warning", "IMPORTANTE: tené en cuenta, que el disco ahora ya NO va a tener géneros relacionados, si querés volver a ponerle stock, agregale nuevamente los géneros. Lo mismo para la imagen", "discosback");
    header('Location: ../index.php?seccion=errores&texto=eliminar el disco?&donde=discosback');
    exit;
}

$back = $_GET['back'] ?? null;
$bandaId = $_GET['banda_id'] ?? null;

if ($back === 'banda' && ctype_digit((string)$bandaId)) {
    header('Location: ../index.php?seccion=eliminar_banda&id=' . $bandaId . '&text=bandas');
    exit;
}

header('Location: ' . $redirectTo);
exit;