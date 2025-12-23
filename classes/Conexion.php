<?php 


class Conexion {
    private const DB_SERVER = "127.0.0.1";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME= "lpg_08_26-6";
    private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

    private static ?PDO $conexion = null;



    /**
     * Función estática que genera una conexión a la BBDD, con el fin de sólo hacer una conexión a la misma.
     * 
     */
    public static function conectar() {
        try {
            self::$conexion = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
        } catch (Exception $error){
            die("<p>Hubo un error al intentar conectarse a la Base de Datos de LPGroove</p>");
        }
    }

    /**
     * Función que obtiene la conexión, si no se hizo, llama al método estatico conectar() y la realiza, si ya está hecha, solo la retorna. 
     * 
     * @return PDO Un objeto PDO que genere la conexión con la BBDD
     */
    public static function getConexion():PDO {
        if(self::$conexion === null) {
            self::conectar();    
        }
        return self::$conexion;
    }

}