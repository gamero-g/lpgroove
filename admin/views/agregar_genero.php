<?php

$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);

?>

<section class="container" id="formAgregar">
    <div class="generos">
        <form action="actions/agregar_genero_acc.php" method="POST" novalidate>
            <div class="d-flex flex-column flex-md-row primero">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" id="nombre" name="nombre" placeholder="Nombre del género" value="<?= htmlspecialchars($old['nombre'] ?? '') ?>" required>
                    <label for="nombre">Nombre del género</label>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['nombre'] ?? '') ?></div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="historia" id="historia" placeholder="Historia"><?= htmlspecialchars($old['historia'] ?? '') ?></textarea>
                    <label for="historia">Historia</label>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Agregar" class="mt-3">
            </div>
        </form>
    </div>
</section>