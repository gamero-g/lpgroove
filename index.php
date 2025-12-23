<?php

require_once './functions/autoloader.php';


$seccion = isset($_GET['seccion']) ? $_GET['seccion'] : 'home';
$banda = isset($_GET['banda']) ? $_GET['banda'] : null;

$vista = Vista::validar_vista($seccion);
$catalogoCompleto = Disco::obtenerCatalogoCompleto();
//$hayLogin = $_SESSION['logueado']['rol'] ?? FALSE;
if($vista->getNombre() != '404') {
    Usuario::acreditar($vista->getRestringida());
}
//$usuario = $_SESSION['loguado'] ?? false;
$usuario = $_SESSION['logueado'] ?? false;

$bandas = Banda::getTodasLasBandas();

//control de log
$logueado = $_SESSION['logueado'] ?? null;
$hayLogin = is_array($logueado);

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
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>LPGroove - <?= $vista->getTitulo() ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg" id="navPrincipalCompleta">
            <div class="container">
                <a class="navbar-brand" href="index.php?seccion=home">
                    <img src="img/LPGroove.webp" alt="Logo del sitio LPGroove" class="position-relative">
                    <h1 class="position-absolute top-0 opacity-0">LPGroove</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacionPrincipal" aria-controls="navegacionPrincipal" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navegacionPrincipal">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?seccion=home">Home</a>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?seccion=catalogo">Catálogo</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Bandas
                            </a>
                            <ul class="dropdown-menu">
                                <?php  foreach ($bandas as $banda) { ?>
                                    <li><a class="dropdown-item" href="index.php?seccion=catalogo_banda&banda=<?= rawurlencode($banda->getNombre()) ?>"><?= htmlspecialchars($banda->getNombre()) ?></a></li>
                                <?php } ?>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Nosotros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?seccion=contacto">Contacto</a></li>
                                <li><a class="dropdown-item" href="index.php?seccion=integrantes">Staff</a></li>
                            </ul>
                        </li>
                        <?php if ($hayLogin) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle bg-body rounded text-black"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-fill pe-2"></i><?= htmlspecialchars($_SESSION['logueado']['usuario'] ?? '') ?>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?seccion=panel_usuario">Tu cuenta</a></li>
                                    <li><a class="dropdown-item" href="admin/actions/check_logout.php?donde=front">
                                        Cerrar sesión <i class="bi bi-box-arrow-in-left p-2"></i>
                                    </a></li>

                                    <?php
                                        $rol = $_SESSION['logueado']['rol'] ?? '';
                                        if ($rol === 'Admin' || $rol === 'Superadmin') {
                                    ?>
                                        <li><a class="dropdown-item" href="admin/index.php">Administrador</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?seccion=login">
                                    <i class="bi bi-person-fill"></i> Iniciar sesión
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link bg-body rounded text-black ms-md-2 mt-1 ps-2 ps-md-2 pe-2 mt-md-0 position-relative carrito-nav d-flex justify-content-center" href="index.php?seccion=carrito">
                                <i class="bi bi-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-black border">
                                    <?= (isset($_SESSION['carrito'])) ? count($_SESSION['carrito']) : '0' ?>
                                    <span class="visually-hidden">Carrito</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main  class="flex-grow-1">
        <?php
            require_once "views/" . $vista->getNombre() . ".php";
        ?>
    </main>

    <footer class="bg-black py-5">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-12 col-md-4">
                    <h2 class="border-bottom">¿Tenés dudas?</h2>
                    <ul class="list-unstyled">
                        <li>Preguntas frecuentes</li>
                        <li>Ayuda</li>
                        <li>Términos y condiciones</li>
                        <li>Contacto</li>
                    </ul>
                </div>
                <div class="col-12 col-md-4">
                    <h2 class="border-bottom">La empresa</h2>
                        <ul class="list-unstyled">
                            <li>Sobre nosotros</li>
                            <li>Apartado Legal</li>
                            <li>Política de privacidad</li>
                            <li>Política de cookies</li>
                        </ul>
                </div>
                <div class="col-12 col-md-4">
                    <h2 class="border-bottom">Redes sociales</h2>
                        <ul id="redes" class="list-unstyled">
                            <li id="fb"><a href="#">Facebook</a></li>
                            <li id="ig"><a href="#">Instagram</a></li>
                            <li id="tw"><a href="#">Twitter</a></li>
                            <li id="yt"><a href="#">Youtube</a></li>
                        </ul>
                        
                </div>
            </div>
        </div>
    </footer>
</body>
</html>