<?php 
    
    require_once '../../functions/autoloader.php';
    
    function backWithErrors(array $errors, array $old): void {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_old'] = $old;
        header('Location: ../index.php?seccion=agregar_banda&text=bandas');
        exit;
    }

    $old = $_POST;
    $errors = [];

    // Inputs
    $nombre = trim($_POST['nombre'] ?? '');
    $integrantes = trim($_POST['integrantes'] ?? '');
    $pais = trim($_POST['pais'] ?? '');
    $anio = trim($_POST['anio_de_formacion'] ?? '');

    // Validaciones
    if ($nombre === '') {
        $errors['nombre'] = 'El nombre es obligatorio.';
    }

    if ($pais === '') {
        $errors['pais'] = 'El país es obligatorio.';
    } elseif (!preg_match('/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s.\'-]+$/', $pais)) {
        $errors['pais'] = 'El país no puede contener números ni caracteres inválidos.';
    }

    if ($anio === '') {
        $errors['anio_de_formacion'] = 'El año de formación es obligatorio.';
    } elseif (!preg_match('/^\d{4}$/', $anio)) {
        $errors['anio_de_formacion'] = 'El año debe tener exactamente 4 dígitos (solo números).';
    } else {
        $year = (int)$anio;
        $current = (int)date('Y');
        if ($year < 1800 || $year > $current) {
            $errors['anio_de_formacion'] = "El año debe estar entre 1800 y $current.";
        }
    }

    // Archivo
    if (!isset($_FILES['logo']) || ($_FILES['logo']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors['logo'] = 'El logo es obligatorio.';
    }

    if ($errors) {
        backWithErrors($errors, $old);
    }

    try {
        $imagen = Imagen::subirImagen($_FILES['logo'], '../../img/logos/');
        Banda::insert($nombre, $integrantes, $pais, $anio, $imagen);
    } catch (Exception $e) {
        $errors['logo'] = 'No fue posible cargar el logo.';
        backWithErrors($errors, $old);
    }

    unset($_SESSION['form_errors'], $_SESSION['form_old']);

    header('Location: ../index.php?seccion=adm_bandas&text=bandas');
    exit;

?>




