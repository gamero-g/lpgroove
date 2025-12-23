<?php

class Conexion {
    // Defaults para XAMPP (fallback)
    private const DEFAULT_DB_SERVER = "127.0.0.1";
    private const DEFAULT_DB_PORT   = "3306";
    private const DEFAULT_DB_USER   = "root";
    private const DEFAULT_DB_PASS   = "";
    private const DEFAULT_DB_NAME   = "lpg_08_26"; // OJO: que coincida con docker-compose

    private static ?PDO $conexion = null;

    private static function env(string $key, string $default): string {
        $v = getenv($key);
        return ($v === false || $v === '') ? $default : $v;
    }

    public static function conectar() {
        $host = self::env('DB_HOST', self::DEFAULT_DB_SERVER);
        $port = self::env('DB_PORT', self::DEFAULT_DB_PORT);
        $user = self::env('DB_USERNAME', self::DEFAULT_DB_USER);
        $pass = self::env('DB_PASSWORD', self::DEFAULT_DB_PASS);
        $name = self::env('DB_DATABASE', self::DEFAULT_DB_NAME);

        $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4;connect_timeout=3";

        // Retry para cuando MariaDB todavía está levantando
        $maxAttempts = 15;
        $delaySeconds = 1;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                self::$conexion = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
                return;
            } catch (PDOException $e) {
                if ($attempt === $maxAttempts) {
                    die("<p>Hubo un error al intentar conectarse a la Base de Datos de LPGroove</p>");
                }
                sleep($delaySeconds);
            }
        }
    }

    public static function getConexion(): PDO {
        if (self::$conexion === null) {
            self::conectar();
        }
        return self::$conexion;
    }
}
