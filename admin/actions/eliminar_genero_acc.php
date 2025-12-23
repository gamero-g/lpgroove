<?php

require_once '../../functions/autoloader.php';

$generoId = $_GET['id'] ?? null;

if (!$generoId || !ctype_digit((string)$generoId)) {
    $_SESSION['flash_error'] = 'ID inválido.';
    header('Location: ../index.php?seccion=adm_generos&text=generos');
    exit;
}

try {
    $genero = Genero::getGeneroPorId($generoId);

    if (!$genero) {
        $_SESSION['flash_error'] = 'No se encontró el género.';
        header('Location: ../index.php?seccion=adm_generos&text=generos');
        exit;
    }

    $conexion = Conexion::getConexion();

    $stmt = $conexion->prepare("SELECT COUNT(*) FROM discos_x_generos WHERE generos_id = ?");
    $stmt->execute([(int)$generoId]);
    $enUso = (int)$stmt->fetchColumn();

    if ($enUso > 0) {
        $_SESSION['flash_error'] = "Para borrar el género \"{$genero->getNombre_genero()}\" primero tenés que desvincularlo de sus discos.";
        header("Location: ../index.php?seccion=eliminar_genero&id=$generoId&text=generos");
        exit;
    }

    $conexion->beginTransaction();

    $stmt = $conexion->prepare("DELETE FROM generos WHERE id = ?");
    $stmt->execute([(int)$generoId]);

    $conexion->commit();

} catch (Throwable $error) {
    if (isset($conexion) && $conexion instanceof PDO && $conexion->inTransaction()) {
        $conexion->rollBack();
    }
    $_SESSION['flash_error'] = 'No se pudo eliminar el género.';
    header("Location: ../index.php?seccion=eliminar_genero&id=$generoId&text=generos");
    exit;
}

header('Location: ../index.php?seccion=adm_generos&text=generos');
exit;