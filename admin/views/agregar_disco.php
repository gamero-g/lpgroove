<?php

$bandas = Banda::getTodasLasBandas();
$descuentos = Descuento::getTodosLosDescuentos();
$generos = Genero::getTodosLosGeneros();

$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);
?>

<section class="container" id="formAgregar">
  <form action="actions/agregar_disco_acc.php" method="POST" enctype="multipart/form-data" novalidate>

    <?php if (isset($errors['general'])): ?>
      <div class="alert alert-danger mt-4"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row primero">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['banda']) ? 'is-invalid' : '' ?>" id="banda" name="banda" required>
          <option value="" disabled <?= empty($old['banda']) ? 'selected' : '' ?>>Elegí una banda</option>
          <?php foreach ($bandas as $banda) { ?>
            <option value="<?= $banda->getId() ?>" <?= (($old['banda'] ?? '') == $banda->getId()) ? 'selected' : '' ?>>
              <?= htmlspecialchars($banda->getNombre()) ?>
            </option>
          <?php } ?>
        </select>
        <label for="banda">Banda dueña del disco</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['banda'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['descuento']) ? 'is-invalid' : '' ?>" id="descuento" name="descuento">
          <option value="" <?= empty($old['descuento']) ? 'selected' : '' ?>>Sin descuentos</option>
          <?php foreach ($descuentos as $descuento) { ?>
            <option value="<?= $descuento->getId() ?>" <?= (($old['descuento'] ?? '') == $descuento->getId()) ? 'selected' : '' ?>>
              <?= htmlspecialchars($descuento->getEvento()) ?>
            </option>
          <?php } ?>
        </select>
        <label for="descuento">Descuento</label>
        <div class="form-text">Si no se quiere aplicar descuentos, dejar en "Sin descuentos".</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['descuento'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column mb-3 flex-md-row tercero">
      <div class="form-floating mb-3">
        <input type="text"
               class="form-control <?= isset($errors['titulo']) ? 'is-invalid' : '' ?>"
               id="titulo" name="titulo" placeholder="Título" required
               value="<?= htmlspecialchars($old['titulo'] ?? '') ?>">
        <label for="titulo">Título</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['titulo'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row segundo">
      <div class="form-floating mb-3">
        <input type="number"
               class="form-control <?= isset($errors['cantidad_canciones']) ? 'is-invalid' : '' ?>"
               id="cantidad_canciones" name="cantidad_canciones" placeholder="Cantidad de Canciones" required
               value="<?= htmlspecialchars($old['cantidad_canciones'] ?? '') ?>">
        <label for="cantidad_canciones">Cantidad de Canciones</label>
        <div class="form-text">Sólo el numero. Ej: 10, 13, etc.</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['cantidad_canciones'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="time" step="1"
               class="form-control <?= isset($errors['duracion']) ? 'is-invalid' : '' ?>"
               id="duracion" name="duracion" required
               value="<?= htmlspecialchars($old['duracion'] ?? '') ?>">
        <label for="duracion">Duración</label>
        <div class="form-text">Formato: HH:MM:SS</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['duracion'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex gap-3 flex-column flex-md-row segundo">
      <div class="form-floating mb-3">
        <input type="number"
               class="form-control <?= isset($errors['anio_de_lanzamiento']) ? 'is-invalid' : '' ?>"
               id="anio_de_lanzamiento" name="anio_de_lanzamiento"
               placeholder="Año de lanzamiento del disco" required
               value="<?= htmlspecialchars($old['anio_de_lanzamiento'] ?? '') ?>">
        <label for="anio_de_lanzamiento">Año de lanzamiento del disco</label>
        <div class="form-text">Sólo 4 dígitos. Ej: 1995.</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['anio_de_lanzamiento'] ?? '') ?></div>
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="portada">Portada</label>
        <input type="file"
               class="form-control <?= isset($errors['portada']) ? 'is-invalid' : '' ?>"
               id="portada" name="portada" required>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['portada'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row primero mb-3">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['condicion']) ? 'is-invalid' : '' ?>" id="condicion" name="condicion" required>
          <option value="" disabled <?= empty($old['banda']) ? 'selected' : '' ?>>Elegí una condición</option>
          <option value="nuevo" <?= (($old['condicion'] ?? '') === 'nuevo') ? 'selected' : '' ?>>Nuevo</option>
          <option value="usado" <?= (($old['condicion'] ?? '') === 'usado') ? 'selected' : '' ?>>Usado</option>
        </select>
        <label for="condicion">Condición</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['condicion'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['estado']) ? 'is-invalid' : '' ?>" id="estado" name="estado" required>
          <option value="" disabled <?= empty($old['banda']) ? 'selected' : '' ?>>Elegí un estado</option>
          <?php
            $estados = ["Excelente","Detalles Estéticos","Muy Bueno","Bueno","Regular","Malo","Muy Malo"];
            foreach ($estados as $estado) {
          ?>
            <option value="<?= htmlspecialchars($estado) ?>" <?= (($old['estado'] ?? '') === $estado) ? 'selected' : '' ?>>
              <?= htmlspecialchars($estado) ?>
            </option>
          <?php } ?>
        </select>
        <label for="estado">Estado</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['estado'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row primero">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['rating']) ? 'is-invalid' : '' ?>" id="rating" name="rating" required>
          <option value="" disabled <?= empty($old['banda']) ? 'selected' : '' ?>>Elegí un rating</option>
          <?php
            $ratings = ["1.00 / 5.00","2.00 / 5.00","3.00 / 5.00","4.00 / 5.00","5.00 / 5.00"];
            foreach ($ratings as $r) {
          ?>
            <option value="<?= $r ?>" <?= (($old['rating'] ?? '') === $r) ? 'selected' : '' ?>><?= $r ?></option>
          <?php } ?>
        </select>
        <label for="rating">Rating</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['rating'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="text" inputmode="decimal"
               class="form-control <?= isset($errors['precio']) ? 'is-invalid' : '' ?>"
               id="precio" name="precio" placeholder="Precio del disco" required
               value="<?= htmlspecialchars($old['precio'] ?? '') ?>">
        <label for="precio">Precio del disco</label>
        <div class="form-text">Formato: 0,00</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['precio'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row segundo">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['stock']) ? 'is-invalid' : '' ?>" id="stock" name="stock" required>
          <option value="" disabled <?= !isset($old['stock']) ? 'selected' : '' ?>>Elegí una opción</option>
          <option value="1" <?= (($old['stock'] ?? '') === '1') ? 'selected' : '' ?>>Si</option>
          <option value="0" <?= (($old['stock'] ?? '') === '0') ? 'selected' : '' ?>>No</option>
        </select>
        <label for="stock">¿Hay stock?</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['stock'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['destacado']) ? 'is-invalid' : '' ?>" id="destacado" name="destacado" required>
          <option value="" disabled <?= !isset($old['destacado']) ? 'selected' : '' ?>>Elegí una opción</option>
          <option value="1" <?= (($old['destacado'] ?? '') === '1') ? 'selected' : '' ?>>Si</option>
          <option value="0" <?= (($old['destacado'] ?? '') === '0') ? 'selected' : '' ?>>No</option>
        </select>
        <label for="destacado">¿Producto destacado?</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['destacado'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex gap-2 flex-column flex-md-row primero">
      <div class="form-floating mb-3 mt-3">
        <input type="number"
               class="form-control <?= isset($errors['unidades']) ? 'is-invalid' : '' ?>"
               id="unidades" name="unidades" placeholder="Unidades del disco" required
               value="<?= htmlspecialchars($old['unidades'] ?? '') ?>">
        <label for="unidades">Unidades del disco</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['unidades'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3 mt-3">
        <textarea class="form-control"
                  name="descripcion" id="descripcion" placeholder="Descripción"><?= htmlspecialchars($old['descripcion'] ?? '') ?></textarea>
        <label for="descripcion">Descripción (opcional)</label>
      </div>
    </div>

    <div class="text-light">
      <span class="mb-3 fs-3">Agregá los géneros correspondientes</span>
      <div class="d-flex flex-wrap gap-3 mt-3">
        <?php
          $oldGeneros = $old['generos'] ?? [];
          if (!is_array($oldGeneros)) $oldGeneros = [];
        ?>
        <?php foreach ($generos as $genero) { ?>
          <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   value="<?= $genero->getId() ?>"
                   id="genero_<?= $genero->getId() ?>"
                   name="generos[]"
                   <?= in_array((string)$genero->getId(), array_map('strval', $oldGeneros), true) ? 'checked' : '' ?>>
            <label class="form-check-label" for="genero_<?= $genero->getId() ?>">
              <?= htmlspecialchars($genero->getNombre_genero()) ?>
            </label>
          </div>
        <?php } ?>
      </div>
      <?php if (isset($errors['generos'])): ?>
        <div class="text-danger mt-2"><?= htmlspecialchars($errors['generos']) ?></div>
      <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center gap-2 mt-3">
        <input type="submit" value="Agregar" class="btn btn-light btn-editar mt-0">
        <a href="index.php?seccion=adm_discos&text=discos" class="btn btn-outline-light">Cancelar</a>
    </div>

  </form>
</section>
