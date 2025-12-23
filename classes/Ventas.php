<?php

class Ventas {

    /**
     * Función que devuelve los productos más vendidos desde la BBDD.
     * @return array $resultadoQuery Es el array asociativo de productos.
     */
    public static function obtenerMasVendidos(): array {
        $haceTreintaDias = date('Y-m-d', strtotime('-30 days'));

        $Conexion = Conexion::getConexion();

        $query = "SELECT compras.fecha, compras.importe, discos.titulo, discos.imagen_portada,
                        SUM(items_x_compra.cantidad) AS cantidad
                FROM compras
                JOIN items_x_compra ON items_x_compra.compra_id = compras.id
                JOIN discos ON items_x_compra.item_id = discos.id
                WHERE compras.fecha >= ?
                GROUP BY discos.id
                ORDER BY cantidad DESC
                LIMIT 4";

        $stmt = $Conexion->prepare($query);
        $stmt->execute([$haceTreintaDias]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}