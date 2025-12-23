<?php 

$generoId = $_GET['id'];
$genero = Genero::getGeneroPorId($generoId);

$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);

$msg = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_error']);
?>


<section class="container" id="formAgregar">
   <?php if($genero) { ?>
        <form action="actions/editar_genero_acc.php?id=<?= $genero->getId() ?>" method="POST" novalidate>
            <div class="d-flex flex-column flex-md-row primero">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" id="nombre" name="nombre" placeholder="Nombre del género" value="<?= htmlspecialchars($old['nombre'] ?? $genero->getNombre_genero()) ?>" required>
                    <label for="nombre">Nombre del género</label>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['nombre'] ?? '') ?></div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="historia" id="historia" placeholder="Historia"><?= htmlspecialchars($old['historia'] ?? $genero->getHistoria()) ?></textarea>
                    <label for="historia">Historia (opcional)</label>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Editar" class="mt-3">
            </div>
        </form>
    <?php } else { ?>
        
        <span class="fs-3 text-light">Lo sentimos! El género que querés editar no está en nuestra Base de Datos.</span>
    
    <?php } ?> 
</section>