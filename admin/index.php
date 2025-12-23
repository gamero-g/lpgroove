<?php


require_once '../functions/autoloader.php';

$seccion = isset($_GET['seccion']) ? $_GET['seccion'] : 'adm_home';
$adm = $_GET['text'] ?? 'LPGroove';
$vista = Vista::validar_vista($seccion);
$hayLogin = $_SESSION['logueado']['rol'] ?? FALSE;
if($vista->getNombre() != '404') {
    Usuario::acreditar($vista->getRestringida());
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Administrador</title>
</head>
<body>
    <div id="admin">
        <div class="h90">
            <header>
                <nav class="navbar navbar-expand-lg" id="navPrincipalCompleta">
                    <div class="container">
                        <a class="navbar-brand" href="index.php?seccion=adm_home">
                            <img src="../img/LPGroove.webp" alt="Logo del sitio LPGroove" class="position-relative">
                            <h1 class="position-absolute top-0 opacity-0">LPGroove</h1>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacionPrincipal" aria-controls="navegacionPrincipal" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navegacionPrincipal">
                            <ul class="navbar-nav ms-auto">
                                <?PHP if ($hayLogin && $hayLogin != "Usuario"){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?seccion=adm_discos&text=discos">Administrar Discos</a>
                                </li>   
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?seccion=adm_bandas&text=bandas">Administrar Bandas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?seccion=adm_descuentos&text=descuentos">Administrar Descuentos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?seccion=adm_generos&text=generos">Administrar Géneros</a>
                                </li>
                                <?PHP } ?>
                                <li class="nav-item <?= $hayLogin ? "" : "d-none"?> dropdown">
                                    <a class="nav-link bg-white text-black rounded dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i> <?= $_SESSION['logueado']['usuario'] ?></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item <?= $hayLogin ? "" : "d-none"?> dropdown-item">
                                            <a class="nav-link" href="actions/check_logout.php?donde=back">Cerrar sesión</a>
                                        </li>
                                        <li class="nav-item <?= $hayLogin ? "" : "d-none"?> dropdown-item">
                                            <a class="nav-link" href="../index.php?">Volver a la página</a>
                                        </li>
                                    </ul>
                                 </li>
                                <!-- <li class="nav-item <?= $hayLogin ? "" : "d-none"?>">
                                    <a class="nav-link" href="actions/check_logout.php?donde=back">Cerrar sesión</a>
                                </li>
                                <li class="nav-item <?= $hayLogin ? "" : "d-none"?>">
                                    <a class="nav-link" href="actions/check_logout.php?donde=back">Volver a la página</a>
                                </li>
                                <li class="nav-item <?= $hayLogin ? "" : "d-none"?>">
                                    <a class="nav-link" href="#"><i class="bi bi-person-fill"></i> <?= $_SESSION['logueado']['usuario'] ?></a>
                                </li> -->
                                <li class="nav-item <?= $hayLogin ? "d-none" : ""?>">
                                    <a class="nav-link" href="index.php?seccion=login">Iniciar sesión</a>
                                </li>
                                <li class="nav-item <?= $hayLogin ? "d-none" : ""?>">
                                    <a class="nav-link" href="../index.php?seccion=home">Volver a la página</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <h2 class="text-center text-light bg-black fs-1 mb-0 py-5">Administrador de  <?=  $adm ?></h2>
            </header>
            <main>
            <?php
                require_once "views/" . $vista->getNombre() . ".php";
            ?>
            </main>
        </div>
        <footer>
           <p>&copy; 2025 LPGroove. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>