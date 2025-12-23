<?php 

    $descuentoId = $_GET['id'] ?? null;

    $descuento = Descuento::getDescuentoPorId($descuentoId);

    $errors = $_SESSION['form_errors'] ?? [];
    $old = $_SESSION['form_old'] ?? [];
    unset($_SESSION['form_errors'], $_SESSION['form_old']);

    $val = function(string $key, $fallback = '') use ($old) {
        return htmlspecialchars($old[$key] ?? $fallback);
    };

?>

<section class="container" id="formAgregar">
   <?php if($descuento) { ?>

        <?php if (isset($errors['general'])): ?>
            <div class="alert alert-danger mt-4">
                <?= htmlspecialchars($errors['general']) ?>
            </div>
        <?php endif; ?>

        <form action="actions/editar_descuento_acc.php?id=<?= $descuento->getId() ?>" method="POST" novalidate>
            <div class="d-flex flex-column flex-md-row primero">
                <div class="form-floating mb-3">
                    <input
                        type="number"
                        class="form-control <?= isset($errors['cantidad']) ? 'is-invalid' : '' ?>"
                        id="cantidad"
                        name="cantidad"
                        required
                        value="<?= $val('cantidad', $descuento->getCantidad_descuento()) ?>"
                    >
                    <label for="cantidad">Cantidad</label>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['cantidad'] ?? '') ?></div>
                    <div class="form-text">Sin %.</div>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="date"
                        class="form-control <?= isset($errors['fecha_inicio']) ? 'is-invalid' : '' ?>"
                        id="fecha_inicio"
                        name="fecha_inicio"
                        required
                        value="<?= $val('fecha_inicio', $descuento->getFecha_inicio()) ?>"
                    >
                    <label for="fecha_inicio">Fecha de inicio</label>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['fecha_inicio'] ?? '') ?></div>
                    <div class="form-text">Elegí una fecha de inicio.</div>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row segundo">
                <div class="form-floating mb-3">
                    <input
                        type="date"
                        class="form-control <?= isset($errors['finalizacion']) ? 'is-invalid' : '' ?>"
                        id="finalizacion"
                        name="finalizacion"
                        required
                        value="<?= $val('finalizacion', $descuento->getFinalizacion()) ?>"
                    >
                    <label for="finalizacion">Fecha de finalizacion</label>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['finalizacion'] ?? '') ?></div>
                    <div class="form-text">Debe ser posterior a la fecha de inicio.</div>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control <?= isset($errors['evento']) ? 'is-invalid' : '' ?>"
                        id="evento"
                        name="evento"
                        required
                        value="<?= $val('evento', $descuento->getEvento()) ?>"
                    >
                    <label for="evento">Evento</label>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['evento'] ?? '') ?></div>
                    <div class="form-text">Ej: Otoño, Semana de la música.</div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2 mt-3">
                <input type="submit" value="Editar" class="btn btn-light btn-editar mt-0">
                <a href="index.php?seccion=adm_descuentos&text=descuentos" class="btn btn-outline-light">Cancelar</a>
            </div>
        </form>

    <?php } else { ?>

        <span class="fs-3 text-light">Lo sentimos! El descuento que querés editar no está en nuestra Base de Datos.</span>

        <div class="d-flex justify-content-center gap-2 mt-3">
            <a href="index.php?seccion=adm_descuentos&text=descuentos" class="btn btn-outline-light">Regresar</a>
        </div>

    <?php } ?>
</section>