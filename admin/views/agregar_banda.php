<?php
$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);
?>

<section class="container" id="formAgregar">
    <form id="formAgregarBanda" action="actions/agregar_banda_acc.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="d-flex flex-column flex-md-row primero">
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>"
                    id="nombre"
                    name="nombre"
                    placeholder="Nombre"
                    value="<?= htmlspecialchars($old['nombre'] ?? '') ?>"
                    required
                >
                <label for="nombre">Nombre</label>

                <div class="invalid-feedback">
                    <?= htmlspecialchars($errors['nombre'] ?? '') ?>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="integrantes"  name="integrantes" placeholder="Integrantes">
                <label for="integrantes">Integrantes</label>
                <div class="form-text">Agregar cada integrante separados por coma</div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row segundo">
            <div class="form-floating mb-3">
                <input type="text" class="form-control <?= isset($errors['pais']) ? 'is-invalid' : '' ?>" id="pais" name="pais" value="<?= htmlspecialchars($old['pais'] ?? '') ?>" required>
                <label for="pais">Pais</label>
                <div class="form-text">Ej: Estados Unidos</div>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['pais'] ?? '') ?></div>
            </div>
            <div class="form-floating mb-3">
                <input
                type="text"
                class="form-control <?= isset($errors['anio_de_formacion']) ? 'is-invalid' : '' ?>"
                id="anio_de_formacion"
                name="anio_de_formacion"
                value="<?= htmlspecialchars($old['anio_de_formacion'] ?? '') ?>"
                required
                >
                <label for="anio_de_formacion">Año de formación</label>
                <div class="form-text">Únicamente entre 1901 y la actualidad.</div>
                <div class="invalid-feedback">
                    <?= htmlspecialchars($errors['anio_de_formacion'] ?? '') ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row tercero">
            <div class="mb-3">
                <label for="logo" class="form-label text-light">Logo de la banda</label>
                <input class="form-control <?= isset($errors['logo']) ? 'is-invalid' : '' ?>" type="file" id="logo" name="logo" required>
                <div class="invalid-feedback">
                <?= htmlspecialchars($errors['logo'] ?? '') ?>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" value="Agregar" class="mt-3">
        </div>
    </form>
</section>