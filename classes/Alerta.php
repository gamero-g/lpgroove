<?php

class Alerta {

    /**
     * Funcion que crea una nueva alerta en el array alertas de la sesión.
     * @param string $tipo Es el tipo de alerta (warning, etc)
     * @param string $mensaje Es el mensaje que muestra la alerta.
     * @param string $donde Es donde se va a mostrar.
     */
    public static function agregarAlerta(string $tipo, string $mensaje, string $donde) {
        $_SESSION['alertas'][] = [
            "tipo" => $tipo,
            "mensaje" => $mensaje,
            "donde" => $donde,
        ];
    }
    /**
     * Funcion que limpia el array de alertas.
     */
    public static function limpiarAlertas() {
        $_SESSION['alertas'] = [];
    }

    /**
     * Funcion que crea la estructura HTML De las alertas.
     * @param $alerta Es la alerta para crear.
     * @return string Estructura HTML.
     */
    public static function imprimirAlertas($alerta):string {
        $alertaHTML = "<div class='alert alert-{$alerta['tipo']} alert-dismissible fade show' role='alert'>";
        $alertaHTML .= $alerta['mensaje'];
        $alertaHTML .=  "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $alertaHTML .= "</div>";

        return $alertaHTML;
    }

     /**
     * Funcion que obtiene las alertas y las imprime.
     */
    public static function obtenerAlertas()  {
        if(!empty($_SESSION['alertas'])) {
            $alertasActuales = "";
            foreach ($_SESSION['alertas'] as $alerta) {
                $alertasActuales .= self::imprimirAlertas($alerta);
            }
            self::limpiarAlertas();
            return $alertasActuales;
        } else {
            return null;
        }
    }
}