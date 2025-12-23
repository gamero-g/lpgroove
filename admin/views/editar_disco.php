<?php 
$bandas = Banda::getTodasLasBandas();
$descuentos = Descuento::getTodosLosDescuentos();
$generos = Genero::getTodosLosGeneros();

$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);


$discoId = $_GET['id'] ?? null;
$disco = Disco::filtrarPorId($discoId);
if($disco) {
    if($disco->getGeneros()) {
        $generos_ids = $disco->getGeneros_ids();
    } else{
         $generos_ids = null;
    }
    $estados = $disco->seleccionarLosEstados();
}



?>


<section class="container" id="formAgregar">
  <?php if(!$disco)  { ?>
    <h3 class="text-light">Lo sentimos! No existe ese disco en nuestra Base de Datos.</h3>
  <?php } else {

    $val = function(string $key, $fallback = '') use ($old) {
      return htmlspecialchars($old[$key] ?? $fallback);
    };

    $bandaSel     = $old['banda']     ?? $disco->getBanda()->getId();
    $descuentoSel = $old['descuento'] ?? (($disco->getOferta()) ? $disco->getOferta()->getId() : '');
    $condSel      = $old['condicion'] ?? $disco->getCondicion();
    $estadoSel    = $old['estado']    ?? $disco->getEstado();
    $ratingSel    = $old['rating']    ?? $disco->getRating();
    $stockSel     = $old['stock']     ?? (string)$disco->getStock();
    $destacadoSel = $old['destacado'] ?? (string)$disco->getDestacado();

    $checkedGeneros = [];
    if (isset($old['generos']) && is_array($old['generos'])) {
      $checkedGeneros = array_map('strval', $old['generos']);
    } else {
      $checkedGeneros = $generos_ids ? array_map('strval', $generos_ids) : [];
    }

    function duracionParaTimeInput($d) {
      $d = trim((string)$d);
      if (preg_match('/^\d{2}:\d{2}$/', $d)) return $d . ':00';
      if (preg_match('/^\d{1}:\d{2}:\d{2}$/', $d)) return '0' . $d;
      return $d;
    }

    $duracionValue = $old['duracion'] ?? duracionParaTimeInput($disco->getDuracion());
  ?>

  <form action="actions/editar_disco_acc.php?id=<?= $disco->getId() ?>" method="POST" enctype="multipart/form-data" novalidate>

    <?php if (isset($errors['general'])): ?>
      <div class="alert alert-danger mt-4"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row primero">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['banda']) ? 'is-invalid' : '' ?>" id="banda" name="banda" required>
          <option value="" disabled <?= empty($bandaSel) ? 'selected' : '' ?>>Elegí una banda</option>

          <?php foreach ($bandas as $banda) { ?>
            <option value="<?= $banda->getId() ?>" <?= ((string)$bandaSel === (string)$banda->getId()) ? 'selected' : '' ?>>
              <?= htmlspecialchars($banda->getNombre()) ?>
            </option>
          <?php } ?>
        </select>
        <label for="banda">Banda dueña del disco</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['banda'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['descuento']) ? 'is-invalid' : '' ?>" id="descuento" name="descuento">
          <option value="" <?= ($descuentoSel === '' || $descuentoSel === null) ? 'selected' : '' ?>>Sin descuento</option>
          <?php foreach ($descuentos as $descuento) { ?>
            <option value="<?= $descuento->getId() ?>" <?= ((string)$descuentoSel === (string)$descuento->getId()) ? 'selected' : '' ?>>
              <?= htmlspecialchars($descuento->getEvento()) ?>
            </option>
          <?php } ?>
        </select>
        <label for="descuento">Elegí un descuento</label>
        <div class="form-text">Si no se quiere aplicar descuentos, elegir opción "Sin descuento".</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['descuento'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column mb-3 flex-md-row tercero">
      <div class="form-floating mb-3">
        <input type="text"
               class="form-control <?= isset($errors['titulo']) ? 'is-invalid' : '' ?>"
               id="titulo" name="titulo" placeholder="Título" required
               value="<?= $val('titulo', $disco->getTitulo()) ?>">
        <label for="titulo">Título</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['titulo'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row segundo">
      <div class="form-floating mb-3">
        <input type="number"
               class="form-control <?= isset($errors['cantidad_canciones']) ? 'is-invalid' : '' ?>"
               id="cantidad_canciones" name="cantidad_canciones" placeholder="Cantidad de Canciones" required
               value="<?= $val('cantidad_canciones', $disco->getCantidadCanciones()) ?>">
        <label for="cantidad_canciones">Cantidad de Canciones</label>
        <div class="form-text">Sólo el numero. Ej: 10, 13, etc.</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['cantidad_canciones'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="time" step="1"
               class="form-control <?= isset($errors['duracion']) ? 'is-invalid' : '' ?>"
               id="duracion" name="duracion" required
               value="<?= htmlspecialchars($duracionValue) ?>">
        <label for="duracion">Duración</label>
        <div class="form-text">Formato: HH:MM:SS</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['duracion'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex gap-3 flex-column flex-md-row align-items-center tercero">
      <div class="form-floating mb-3">
        <input type="number"
               class="form-control <?= isset($errors['anio_de_lanzamiento']) ? 'is-invalid' : '' ?>"
               id="anio_de_lanzamiento" name="anio_de_lanzamiento" required
               value="<?= $val('anio_de_lanzamiento', $disco->getAnioDeLanzamiento()) ?>">
        <label for="anio_de_lanzamiento">Año de lanzamiento del disco</label>
        <div class="form-text">Sólo 4 dígitos. Ej: 1995.</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['anio_de_lanzamiento'] ?? '') ?></div>
      </div>

      <div class="mb-4">
        <img src="../img/portadas/<?= htmlspecialchars($disco->getImagenPortada()) ?>"
             alt="Imagen del disco <?= htmlspecialchars($disco->getTitulo()) ?>"
             class="img-portada_adm">
        <label class="form-label text-light">Portada actual del disco</label>
        <input class="form-control" type="hidden" id="portada_og" name="portada_og" value="<?= htmlspecialchars($disco->getImagenPortada()) ?>">
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="portada">Portada nueva</label>
        <input type="file"
               class="form-control <?= isset($errors['portada']) ? 'is-invalid' : '' ?>"
               id="portada" name="portada">
        <div class="invalid-feedback"><?= htmlspecialchars($errors['portada'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row segundo mb-3">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['condicion']) ? 'is-invalid' : '' ?>" id="condicion" name="condicion" required>
          <option value="" disabled <?= empty($condSel) ? 'selected' : '' ?>>Elegí una condición</option>
          <option value="nuevo" <?= ($condSel === 'nuevo') ? 'selected' : '' ?>>Nuevo</option>
          <option value="usado" <?= ($condSel === 'usado') ? 'selected' : '' ?>>Usado</option>
        </select>
        <label for="condicion">Elegí una condición</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['condicion'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['estado']) ? 'is-invalid' : '' ?>" id="estado" name="estado" required>
          <option value="" disabled <?= empty($estadoSel) ? 'selected' : '' ?>>Elegí un estado</option>
          <?php
            $estadosPermitidos = ["Excelente","Detalles Estéticos","Muy Bueno","Bueno","Regular","Malo","Muy Malo"];
            foreach ($estadosPermitidos as $e) {
          ?>
            <option value="<?= htmlspecialchars($e) ?>" <?= ($estadoSel === $e) ? 'selected' : '' ?>>
              <?= htmlspecialchars($e) ?>
            </option>
          <?php } ?>
        </select>
        <label for="estado">Elegí un estado</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['estado'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row primero">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['rating']) ? 'is-invalid' : '' ?>" id="rating" name="rating" required>
          <option value="" disabled <?= empty($ratingSel) ? 'selected' : '' ?>>Elegí un rating</option>
          <?php
            $ratings = ["1.00 / 5.00","2.00 / 5.00","3.00 / 5.00","4.00 / 5.00","5.00 / 5.00"];
            foreach ($ratings as $r) {
          ?>
            <option value="<?= $r ?>" <?= ($ratingSel === $r) ? 'selected' : '' ?>><?= $r ?></option>
          <?php } ?>
        </select>
        <label for="rating">Rating del disco</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['rating'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="text" inputmode="decimal"
               class="form-control <?= isset($errors['precio']) ? 'is-invalid' : '' ?>"
               id="precio" name="precio" placeholder="Precio del disco" required
               value="<?= $val('precio', $disco->getPrecio()) ?>">
        <label for="precio">Precio del disco</label>
        <div class="form-text">Formato: 0,00</div>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['precio'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row segundo">
      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['stock']) ? 'is-invalid' : '' ?>" id="stock" name="stock" required>
          <option value="" disabled <?= ($stockSel !== '0' && $stockSel !== '1') ? 'selected' : '' ?>>Elegí una opción</option>
          <option value="1" <?= ((string)$stockSel === '1') ? 'selected' : '' ?>>Si</option>
          <option value="0" <?= ((string)$stockSel === '0') ? 'selected' : '' ?>>No</option>
        </select>
        <label for="stock">¿Hay stock?</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['stock'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select <?= isset($errors['destacado']) ? 'is-invalid' : '' ?>" id="destacado" name="destacado" required>
          <option value="" disabled <?= ($destacadoSel !== '0' && $destacadoSel !== '1') ? 'selected' : '' ?>>Elegí una opción</option>
          <option value="1" <?= ((string)$destacadoSel === '1') ? 'selected' : '' ?>>Si</option>
          <option value="0" <?= ((string)$destacadoSel === '0') ? 'selected' : '' ?>>No</option>
        </select>
        <label for="destacado">¿Producto destacado?</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['destacado'] ?? '') ?></div>
      </div>
    </div>

    <div class="d-flex gap-2 flex-column flex-md-row tercero textarea">
      <div class="form-floating mb-3">
        <input type="number"
               class="form-control <?= isset($errors['unidades']) ? 'is-invalid' : '' ?>"
               id="unidades" name="unidades" placeholder="Unidades del disco" required
               value="<?= $val('unidades', $disco->getUnidades()) ?>">
        <label for="unidades">Unidades del disco</label>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['unidades'] ?? '') ?></div>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control"
                  name="descripcion" id="descripcion"
                  placeholder="Descripción"><?= $val('descripcion', $disco->getDescripcion()) ?></textarea>
        <label for="descripcion">Descripción (opcional)</label>
      </div>
    </div>

    <div class="text-light">
      <span class="mb-3 fs-3">Agregá los géneros correspondientes</span>
      <div class="d-flex flex-wrap gap-3 mt-3">
        <?php foreach ($generos as $genero) { ?>
          <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   value="<?= $genero->getId() ?>"
                   id="genero_<?= $genero->getId() ?>"
                   name="generos[]"
                   <?= in_array((string)$genero->getId(), $checkedGeneros, true) ? 'checked' : '' ?>>
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
      <input type="submit" value="Editar" class="mt-3 btn btn-light btn-editar">
      <a href="index.php?seccion=adm_discos&text=discos" class="btn btn-outline-light mt-3">Cancelar</a>
    </div>
  </form>

  <?php } ?>
</section>