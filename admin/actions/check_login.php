<?PHP
require_once "../../functions/autoloader.php";

$datosPOST = $_POST;
$datosGET = $_GET;

$login =  Usuario::login($datosPOST['user'], $datosPOST['pass'], $datosGET['donde']);


if($login){
    if($login == "Usuario"){
        header('location: ../../index.php');
    }else{
        header('location: ../index.php?seccion=adm_home');
    }
}else{
    if($datosGET) {
        if($datosGET['donde'] === 'loginback') {
            header('location: ../index.php?seccion=login');
        } else {
            header('location: ../../index.php?seccion=login');
        }
    } else {
        header('location: ../../index.php?seccion=home');
    }
}
