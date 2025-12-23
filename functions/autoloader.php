<?PHP
session_start();


function autoloaderClasses($nClase){
    $pathClase = __DIR__ . "/../classes/$nClase.php";

    if(file_exists($pathClase)){
        require_once $pathClase;
    }else{
        die("Autoloader buscó: $pathClase (clase: $nClase) ¿Existe?");
    };
}

spl_autoload_register('autoloaderClasses');