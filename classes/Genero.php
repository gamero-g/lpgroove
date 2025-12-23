<?php

class Genero {
    private $id;
    private $nombre_genero;
    private $historia;

    /**
     * Función que obtiene todos los géneros desde la BBDD.
     * @return Genero[] Es un array de objetos géneros. 
     */
    public static function getTodosLosGeneros():array {
        $conexion = conexion::getConexion();
        $query = "SELECT * FROM generos";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $resultadoQuery = $PDOStatement->fetchAll();

        return $resultadoQuery;
    }

    /**
     * Función que obtiene de la BBDD un género segun su id.
     * @param $id Es el id del género, que puede ser un int o un null.
     * @return ?Genero Retorna un objeto género o null, si el id no se encuentra. 
     */
    public static function getGeneroPorId(mixed $id): ?Genero {
        $conexion = conexion::getConexion();
        $query = "SELECT * FROM generos WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);

        if($resultadoQuery = $PDOStatement->fetch()) {
             return $resultadoQuery;
        }
         

        return null;
    }

    /**
     * Función que obtiene todos los generos según cuantos ids de géneros le pasemos.
     * @param ?string $ids Es un string de ids, que luego se utilizarán para obtener esos géneros.
     * @return ?Generos[] Retorna un array de objetos géneros o null.
     */
    public static function getGenerosPorId(?string $ids): ?array {
        if($ids) {
            $conexion = conexion::getConexion();

            $idsArr = explode(",", $ids);
            $placeholders = implode(',', array_fill(0, count($idsArr), '?'));

            $query = "SELECT * FROM generos WHERE id IN($placeholders)";

            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute($idsArr);

            if($resultadoQuery = $PDOStatement->fetchAll()) {
                return $resultadoQuery;
            }
        }
        return null;
        
    }

      /**
     * Función que inserta un nuevo género en la BBDD.
     * @param string $nombre_genero Es el nombre del género.
     * @param string $historia Es la historia del género.
     */
    public static function instert(string $nombre_genero, string $historia) {
        $conexion = conexion::getConexion();
        $query = "INSERT INTO generos (nombre_genero, historia) VALUES (:nombre_genero, :historia)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "nombre_genero" => $nombre_genero,
            "historia" => $historia
        ]);
    }

    
    /**
     * Funcion que recibe los parametros a editar de un género y la edita en base a su id, en la BBDD;
     * @param string $nombre_genero Es el nombre del género.
     * @param string $historia Es la historia del género.
     */
    public function edit(string $nombre_genero, string $historia) {
        $conexion = conexion::getConexion();
        $query = "UPDATE generos SET nombre_genero = :nombre_genero, historia = :historia WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "nombre_genero" => $nombre_genero,
            "historia" => $historia,
            "id" => $this->id
        ]);
    }

    /**
     * Función que elimina un género de la BBDD dependiendo su ID.
     */
    public function delete() {
        $conexion = conexion::getConexion();
        $query = "DELETE FROM generos WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }


    /** 
     * Function que obtiene, si es necesario un máximo, y devuelve el texto del género pero recortado hasta la cantidad maxima de palabras que le especificamos.
     * 
     * @param int $max Es el máximo de palabras que va a tener la nueva descrpción, si no recibe ningún argumento, es 10. 
     * @param string $descripcion Es la descripción del género.
     * @return string Retorna la descripción del producto con un máximo de palabras y, si la descripción original es mayor al $max, se agregan "...". 
     */
    public static function recortarDescripcion(string $descripcion, int $max = 10):string {
        $descripcionRecortada = explode(" ", $descripcion);

        $nuevaDescripcion = [];

        foreach ($descripcionRecortada as $palabra) {
            if(count($nuevaDescripcion) < $max) {
                array_push($nuevaDescripcion, $palabra);
            }
        }

        if(count($descripcionRecortada) > $max) {
            array_push($nuevaDescripcion, '...');
        }

        $nuevaDescripcionString = implode(" ", $nuevaDescripcion);
    

        return $nuevaDescripcionString;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre_genero
     */ 
    public function getNombre_genero()
    {
        return $this->nombre_genero;
    }

    /**
     * Set the value of nombre_genero
     *
     * @return  self
     */ 
    public function setNombre_genero($nombre_genero)
    {
        $this->nombre_genero = $nombre_genero;

        return $this;
    }

    /**
     * Get the value of historia
     */ 
    public function getHistoria()
    {
        return $this->historia;
    }

    /**
     * Set the value of historia
     *
     * @return  self
     */ 
    public function setHistoria($historia)
    {
        $this->historia = $historia;

        return $this;
    }
}