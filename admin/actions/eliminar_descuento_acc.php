<?php
require_once '../../functions/autoloader.php';

function backDelete(array $errors, array $old, $id): void {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $old;
    header("Location: ../index.php?seccion=eliminar_descuento&id=$id&text=descuentos");
    exit;
}

$descuentoId = $_GET['id'] ?? null;

if (!$descuentoId || !ctype_digit((string)$descuentoId)) {
    header('Location: ../index.php?seccion=adm_descuentos&text=descuentos');
    exit;
}

try {
    $descuento = Descuento::getDescuentoPorId($descuentoId);
    if (!$descuento) {
        header('Location: ../index.php?seccion=adm_descuentos&text=descuentos');
        exit;
    }

    // chequeoi
    $Conexion = Conexion::getConexion();
    $stmt = $Conexion->prepare("SELECT id FROM discos WHERE descuento_id = ?");
    $stmt->execute([(int)$descuentoId]);
    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (!empty($ids)) {
        backDelete(
            ['general' => 'Para borrar este descuento primero tenés que desvincularlo de los discos que lo están usando.'],
            [],
            $descuentoId
        );
    }

    $descuento->delete();

} catch (Throwable $e) {
    backDelete(['general' => 'No fue posible eliminar el descuento.'], [], $descuentoId);
}

header('Location: ../index.php?seccion=adm_descuentos&text=descuentos');
exit;
