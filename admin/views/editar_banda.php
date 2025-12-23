<?php 

$bandaId = $_GET['id'] ?? null;
$banda = Banda::getBandaPorId($bandaId);
$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);

?>

<section class="container" id="formAgregar">
    <?php if(!$banda)  { ?>
        <h3 class="text-light">No se encontró la banda que buscabas en la Base de Datos.</h3>
    <?php } else { ?>
        
        <form action="actions/editar_banda_acc.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data" novalidate>
        <div class="d-flex flex-column flex-md-row primero">
            <div class="form-floating mb-3">
                <input type="text" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= htmlspecialchars($old['nombre'] ?? $banda->getNombre()) ?>" required>
                <label for="nombre">Nombre</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['nombre'] ?? '') ?></div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="integrantes" name="integrantes" value="<?= htmlspecialchars($old['integrantes'] ?? $banda->getIntegrantes()) ?>">
                <label for="integrantes">Integrantes</label>
                <div class="form-text">Agregar cada integrante separados por coma</div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row segundo">
            <div class="form-floating mb-3">
                <input type="text" class="form-control <?= isset($errors['pais']) ? 'is-invalid' : '' ?>" id="pais" name="pais" value="<?= htmlspecialchars($old['pais'] ?? $banda->getPais()) ?>" required>
                <label for="pais">Pais</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['pais'] ?? '') ?></div>
                <div class="form-text">Ej: Estados Unidos</div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" inputmode="numeric" maxlength="4" class="form-control <?= isset($errors['anio_de_formacion']) ? 'is-invalid' : '' ?>" id="anio_de_formacion" name="anio_de_formacion" value="<?= htmlspecialchars($old['anio_de_formacion'] ?? $banda->getAnio_de_formacion()) ?>" required>
                <label for="anio_de_formacion">Año de formación</label>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['anio_de_formacion'] ?? '') ?></div>
                <div class="form-text">Únicamente entre 1901 y la actualidad.</div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row tercero">
            <div class="mb-3">
                <label for="logo" class="form-label text-light">Logo actual de la banda</label>
                <img src="../img/logos/<?= $banda->getImagen_banda() ?>" alt="Logo de la banda <?= $banda->getNombre() ?>"  class="img-portada_adm">
                <input class="form-control" type="hidden" id="logo_og" name="logo_og" value="<?= $banda->getImagen_banda() ?>">
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label text-light">Logo nuevo de la banda</label>
                <input class="form-control" type="file" id="logo" name="logo">
            </div>
        </div>
        
        <div class="d-flex justify-content-center">
            <input type="submit" value="Editar" class="mt-3">
        </div>
    </form>
    <?php } ?>
</section>