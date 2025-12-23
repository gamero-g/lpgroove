<?php

class Compra {


    /** 
     * Función que devuelve las compras de un usuario ordendas por fecha descendiente (ultima a primera).
     * @param int $usuarioId Es el id del usuario.
     * @return Compra[] Es un array de objetos compra.
     */
    public static function comprasPorUsuario(int $usuarioId):array {
        $Conexion = Conexion::getConexion();
        $query = "SELECT compras.fecha, compras.importe, discos.titulo, discos.imagen_portada, items_x_compra.cantidad AS cantidad
            FROM `compras`
            JOIN items_x_compra ON items_x_compra.compra_id = compras.id
            JOIN discos ON items_x_compra.item_id = discos.id
            WHERE compras.usuario_id = ?
            ORDER BY compras.fecha DESC";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$usuarioId]);

        $resultadoQuery = $PDOStatement->fetchAll();
        return $resultadoQuery;
    }
}