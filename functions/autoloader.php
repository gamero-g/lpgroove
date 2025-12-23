<?PHP
session_start();


function autoloaderClasses($nClase){
    $pathClase = __DIR__ . "/../classes/$nClase.php";

    if(file_exists($pathClase)){
        require_once $pathClase;
    }else{
        die("La clase $nClase no pudo ser accedida. ¿Existe?");
    };
}

spl_autoload_register('autoloaderClasses');