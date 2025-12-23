<?php
    $errors = $_SESSION['form_errors'] ?? [];
    $old = $_SESSION['form_old'] ?? [];
    unset($_SESSION['form_errors'], $_SESSION['form_old']);
?>

<section class="container" id="formAgregar">
    <form action="actions/agregar_descuento_acc.php" method="POST" novalidate>
        <div class="d-flex flex-column flex-md-row primero">
            <div class="form-floating mb-3">
                <input type="number" class="form-control <?= isset($errors['cantidad']) ? 'is-invalid' : '' ?>" id="cantidad" name="cantidad" required value="<?= htmlspecialchars($old['cantidad'] ?? '') ?>">
                <label for="cantidad">Cantidad</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['cantidad'] ?? '') ?></div>
                <div class="form-text">Sin %.</div>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control <?= isset($errors['fecha_inicio']) ? 'is-invalid' : '' ?>" id="fecha_inicio" name="fecha_inicio" required value="<?= htmlspecialchars($old['fecha_inicio'] ?? '') ?>">
                <label for="fecha_inicio">Fecha de inicio</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['fecha_inicio'] ?? '') ?></div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row segundo">
            <div class="form-floating mb-3">
                <input type="date" class="form-control <?= isset($errors['finalizacion']) ? 'is-invalid' : '' ?>" id="finalizacion" name="finalizacion" required value="<?= htmlspecialchars($old['finalizacion'] ?? '') ?>">
                <label for="finalizacion">Fecha de finalizacion</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['finalizacion'] ?? '') ?></div>
            </div>
            <div class="form-floating mb-3">
                 <input type="text" class="form-control <?= isset($errors['evento']) ? 'is-invalid' : '' ?>" id="evento" name="evento" placeholder="Evento" required value="<?= htmlspecialchars($old['evento'] ?? '') ?>">
                <label for="evento">Evento</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['evento'] ?? '') ?></div>
                <div class="form-text">Ej: Otoño, Semana de la música.</div>
            </div>
        </div>
        <div class="d-flex tercero">
        </div>
        
        <div class="d-flex justify-content-center gap-2 mt-3">
            <input type="submit" value="Agregar" class="btn btn-light btn-editar mt-0">
            <a href="index.php?seccion=adm_descuentos&text=descuentos" class="btn btn-outline-light">Cancelar</a>
        </div>
    </form>
</section>