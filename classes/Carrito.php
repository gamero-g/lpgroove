<?php

class Carrito {

    /**
     * Funcion quevacía el carrito eliminando los items guardados en sesión.
     */
    public static function vaciar(): void {
        unset($_SESSION['carrito']);
    }

    /**
     * Funcion que, agrega un item al carrito (al carrito que contiene la superglobal session).
     * @param int $productoId Es el id del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar. 
     */
    public static function agregar_item(int $productoId, int $cantidad) {
        $itemData = Disco::filtrarPorId($productoId);

        if($itemData) {
            $_SESSION['carrito'][$productoId] = [
                'producto' => $itemData->getTitulo(),
                'portada' => $itemData->getImagenPortada(),
                'precio' => Disco::verificarPrecioFinal($itemData),
                'cantidad' => $cantidad,
                "cantMax" => $itemData->getUnidades()
            ];
        }
    }

    /**
     * Funcion que devuelve el array del carrito.
     * @return array Puede ser tanto un array con datos, como no.
     */
    public static function obtenerCarrito(): array {
        if(!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        } else {
            return [];
        }
    }

    /**
     * Funcion que devuelve el total $ del carrito.
     * @return float El total, o 0 si no hay nada.
     */
    public static function total():float {
        $total = 0;
        if(!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }
        return $total;
    }


    /**
     * Funcion que elimina un item de de la supergobla sesion, basado en su ID.
     * @param int $id Es el id del item a eliminar.
     */
    public static function eliminarItem(int $id) {
        if(isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
    } 

    /**
     * Función que actualiza la cantidad de un producto en base a su id, utilzando un array con las cantidades de cada producto actualizada.
     * @param array $cantidades Es un array con las nuevas cantidades.
     */
    public static function actualizarCantidades(array $cantidades) {
        foreach ($cantidades as $key => $value) {
            if(isset($_SESSION['carrito'][$key])) {
                $_SESSION['carrito'][$key]['cantidad'] = $value;
            }
        }
    }

    public static function eliminarTodosLosItems() {
        $_SESSION['carrito'] = [];
    }

}