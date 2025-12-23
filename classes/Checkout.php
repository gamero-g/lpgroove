<?php

class Checkout {


    /**
     * Función que inserta los datos deuna compra en la BBDD
     * @param array $datosCompra Es el array con los datos de la compra.
     * @param array $detalles Es el array con los productos incluidos en la compra.
     */
    public static function insertCompra(array $datosCompra, array $detalles) {
        $Conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (NULL, :usuarioId, :fecha, :importe)";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "usuarioId" => $datosCompra['usuarioId'],
            "fecha" => $datosCompra['fecha'],
            "importe" => $datosCompra['importe']
        ]);

        $compraId = $Conexion->lastInsertId();

        foreach ($detalles as $key => $value) {
            $query = "INSERT INTO items_x_compra VALUES (NULL, :discoId, :compraId, :cantidad)";

            $PDOStatement = $Conexion->prepare($query);
            $PDOStatement->execute([
            "discoId" => $key,
            "compraId" => $compraId,
            "cantidad" => $value
        ]);
        }
    }
}