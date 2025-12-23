<?php 

class Descuento {

    private $id;
    private $cantidad_descuento;
    private $fecha_inicio;
    private $finalizacion;
    private $evento;


    /**
     * Funcion que obtiene la conexión a la BBDD y selecciona TODOS los descuentos de la base de datos guardandolos en un array.
     * @return Descuento[] $resultadoQuery Un array lleno de objetos Descuento.
     */
    public static function getTodosLosDescuentos():array {
        $Conexion = Conexion::getConexion();
        $query = "SELECT * FROM descuentos";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $resultadoQuery = $PDOStatement->fetchAll();
        
        return $resultadoQuery;
    }

     /**
     * Funcion que obtiene la conexión a la BBDD y mediante un id, devuelve los datos de ese descuento. Si se encuentra, lo devuelve, sino devuelve null.
     * @param mixed $id Es el id del descuento que queremos buscar. 
     * @return ?Descuento Devuelve un objeto descuento, o sino lo encuentra, null.
     */
    public static function getDescuentoPorId(mixed $id): ?Descuento {
        $Conexion = Conexion::getConexion();
        $query = "SELECT * FROM descuentos WHERE descuentos.id = ?";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);

        if($resultadoQuery = $PDOStatement->fetch()) {
            return $resultadoQuery;
        }         

        return null;
    }

    /**
     * Función que inserta un nuevo descuento en la BBDD.
     * @param int $cantidad_descuento Es la cantidad de descuento (%).
     * @param string $fecha_inicio Es la fecha de inicio del descuento.
     * @param string $finalizacion Es la fecha de finalización del descuento.
     * @param string $evento Es el evento por el cual se celebra el descuento. 
     */
    public static function insert(int $cantidad_descuento, string $fecha_inicio, string $finalizacion, string $evento) {
        $Conexion = Conexion::getConexion();
        $query = "INSERT INTO descuentos (cantidad_descuento, fecha_inicio, finalizacion, evento) VALUES (:cantidad_descuento, :fecha_inicio, :finalizacion, :evento)";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "cantidad_descuento" => $cantidad_descuento,
            "fecha_inicio" => $fecha_inicio,
            "finalizacion" => $finalizacion,
            "evento" => $evento . " " . $cantidad_descuento 
        ]);
    }


    /**
     * Funcion que recibe los parametros a editar de un descuento y lo edita en base a su id, en la BBDD;
     * @param int $cantidad_descuento Es la cantidad de descuento (%).
     * @param string $fecha_inicio Es la fecha de inicio del descuento.
     * @param string $finalizacion Es la fecha de finalización del descuento.
     * @param string $evento Es el evento por el cual se celebra el descuento.
     */
    public function edit(int $cantidad_descuento, string $fecha_inicio, string $finalizacion, string $evento) {
        $Conexion = Conexion::getConexion();
        $query = "UPDATE descuentos SET cantidad_descuento = :cantidad_descuento, fecha_inicio = :fecha_inicio, finalizacion = :finalizacion, evento = :evento WHERE id = :id";
        
        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "cantidad_descuento" => $cantidad_descuento,
            "fecha_inicio" => $fecha_inicio,
            "finalizacion" => $finalizacion,
            "evento" => $evento,
            "id" => $this->id,
        ]);
    }

    /**
     * Función que elimina un descuento de la BBDD dependiendo su ID.
     */
    public function delete() {
        $Conexion = (new Conexion)->getConexion();
        $query = 'DELETE FROM descuentos WHERE id = ?';

        $PDOStatement = $Conexion->prepare($query);
        
        $PDOStatement->execute([$this->id]);


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
     * Get the value of cantidad_descuento
     */ 
    public function getCantidad_descuento()
    {
        return $this->cantidad_descuento;
    }

    /**
     * Set the value of cantidad_descuento
     *
     * @return  self
     */ 
    public function setCantidad_descuento($cantidad_descuento)
    {
        $this->cantidad_descuento = $cantidad_descuento;

        return $this;
    }

    /**
     * Get the value of fecha_inicio
     */ 
    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of fecha_inicio
     *
     * @return  self
     */ 
    public function setFecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Get the value of finalizacion
     */ 
    public function getFinalizacion()
    {
        return $this->finalizacion;
    }

    /**
     * Set the value of finalizacion
     *
     * @return  self
     */ 
    public function setFinalizacion($finalizacion)
    {
        $this->finalizacion = $finalizacion;

        return $this;
    }

    /**
     * Get the value of evento
     */ 
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set the value of evento
     *
     * @return  self
     */ 
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }
}

?>