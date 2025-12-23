<?php 


require_once '../../functions/autoloader.php';

$bandaId = $_GET['id'] ?? null;

if (!$bandaId || !ctype_digit((string)$bandaId)) {
    $_SESSION['flash_error'] = 'ID inválido.';
    header('Location: ../index.php?seccion=adm_bandas&text=bandas');
    exit;
}

try {
    $banda = Banda::getBandaPorId($bandaId);

    if (!$banda) {
        $_SESSION['flash_error'] = 'No se encontró la banda.';
        header('Location: ../index.php?seccion=adm_bandas&text=bandas');
        exit;
    }

    $todos = Disco::obtenerCatalogoCompletoCompleto();
    $tieneDiscos = false;

    foreach ($todos as $disco) {
        if ((string)$disco->getBanda()->getId() === (string)$bandaId) {
            $tieneDiscos = true;
            break;
        }
    }

    if ($tieneDiscos) {
        $_SESSION['flash_error'] = "Para borrar a {$banda->getNombre()} primero tenés que borrar su discografía.";
        header("Location: ../index.php?seccion=eliminar_banda&id=$bandaId&text=bandas");
        exit;
    }

    Imagen::eliminarImagen("../../img/logos/" . $banda->getImagen_banda());
    $banda->remove();

} catch (Exception $error) {
    $_SESSION['flash_error'] = 'No se pudo eliminar la banda.';
    header("Location: ../index.php?seccion=eliminar_banda&id=$bandaId&text=bandas");
    exit;
}

header('Location: ../index.php?seccion=adm_bandas&text=bandas');
exit;
?>