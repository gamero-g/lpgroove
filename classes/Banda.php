<?php 

class Banda {

    private $id;
    private $nombre;
    private $integrantes;
    private $pais;
    private $anio_de_formacion;
    private $imagen_banda;

    private array $generos = [];


    /** 
     * Funcion que obtiene todas las bandas y devuelve un array de objetos Banda.
     * @return Banda[] Un array de objetos Banda.
     */
    public static function getTodasLasBandas(): array {
        $conexion = conexion::getConexion();
        $query = "SELECT * FROM bandas";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $resultadoQuery = $PDOStatement->fetchAll();
        
        return $resultadoQuery;
    }

    /** 
     * Funcion que obtiene una banda por su id y la devuelve.
     * @parammixed $id Es el id de la banda que queremos buscar.
     * @return ?Banda devuelve la banda o null si no la encuentra;
     */

    public static function getBandaPorId(mixed $id): ?Banda {
        $conexion = conexion::getConexion();
        $query = "SELECT * FROM bandas WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);

       

        if( $resultadoQuery = $PDOStatement->fetch()) {
            return $resultadoQuery;
        }

        return null;
    }

    /**
     * Funcion que recibe los campos de la tabla Bandas, para insertar un nuevo registro
     * @param string $nombre Es el nombre de la banda o artista.
     * @param string $integrantes Son los integrantes de la banda o artista.
     * @param string $pais Es el estado/proivincia + el pais de la banda o artista.
     * @param int $anio_de_formacion Es el anio de formacion de la banda o artista.
     * @param string $imagen Es el logo de la banda o artista, que puede ser el anterior como uno nuevo.
     * 
     */
    public static function insert(string $nombre, string $integrantes, string $pais, int $anio_de_formacion, string $imagen) {
        $conexion = (new Conexion)->getConexion();
        $query = 'INSERT INTO bandas (nombre, integrantes, pais, anio_de_formacion, imagen_banda) VALUES (:nombre, :integrantes, :pais, :anio_de_formacion, :imagen)';

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "nombre" => $nombre,
            "integrantes" => $integrantes,
            "pais" => $pais,
            "anio_de_formacion" => $anio_de_formacion,
            "imagen" => $imagen
        ]);
    }

    /**
     * Funcion que recibe los parametros a editar de una banda y la edita en base a su id, en la BBDD;
     * @param string $nombre Es el nombre de la banda o artista.
     * @param string $integrantes Son los integrantes de la banda o artista.
     * @param string $pais Es el estado/proivincia + el pais de la banda o artista.
     * @param int $anio_de_formacion Es el anio de formacion de la banda o artista.
     * @param string $imagen Es el logo de la banda o artista, que puede ser el anterior como uno nuevo. 
     */
    public function edit(string $nombre, string $integrantes, string $pais, int $anio_de_formacion, string $imagen) {
        $conexion = (new Conexion)->getConexion();
        $query = 'UPDATE bandas SET nombre = :nombre, integrantes = :integrantes, pais = :pais, anio_de_formacion = :anio_de_formacion, imagen_banda = :imagen WHERE id = :id';
      
          
    
        $PDOStatement = $conexion->prepare($query);
 
        $PDOStatement->execute([
            "nombre" => $nombre,
            "integrantes" => $integrantes,
            "pais" => $pais,
            "anio_de_formacion" => $anio_de_formacion,
            "imagen" => $imagen,
            "id" => $this->id,
        ]);
    }

    /**
     * Función que elimina una banda de la BBDD dependiendo su ID.
     */
    public function remove() {
        $conexion = (new Conexion)->getConexion();
        $query = 'DELETE FROM bandas WHERE id = ?';

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }


        
    /** 
     * Funcion devuelve el titulo de una banda formateado.
     * 
     * @return string Retorna el título de la banda formateado (sin _ y con mayúsculas)
     *      
     */
    public function formatearTituloBanda():string {
        $banda = $this->getNombre();
        $subtitulo = str_replace("_", " ", $banda);
        $subtitulo = ucwords($subtitulo);
        if($banda === 'acdc') {
            $subtitulo = strtoupper($subtitulo);
        }
        return $subtitulo;
    }

    /**
     * Función que si el género no existe en ela array de géneros de la banda, lo agrega. Sino, no.
     * @param string $genero Es el género a agregar.
     */
    public function generosBanda(string $genero) {
        if(array_search($genero, $this->generos) === false) {
            $this->generos[] = $genero;
        }
    }


    /**
     * Get the value of id.
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
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of integrantes
     */ 
    public function getIntegrantes()
    {
        return $this->integrantes;
    }

    /**
     * Set the value of integrantes
     *
     * @return  self
     */ 
    public function setIntegrantes($integrantes)
    {
        $this->integrantes = $integrantes;

        return $this;
    }

    /**
     * Get the value of pais
     */ 
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     *
     * @return  self
     */ 
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get the value of anio_de_formacion
     */ 
    public function getAnio_de_formacion()
    {
        return $this->anio_de_formacion;
    }

    /**
     * Set the value of anio_de_formacion
     *
     * @return  self
     */ 
    public function setAnio_de_formacion($anio_de_formacion)
    {
        $this->anio_de_formacion = $anio_de_formacion;

        return $this;
    }

    /**
     * Get the value of imagen_banda
     */ 
    public function getImagen_banda()
    {
        return $this->imagen_banda;
    }

    /**
     * Set the value of imagen_banda
     *
     * @return  self
     */ 
    public function setImagen_banda($imagen_banda)
    {
        $this->imagen_banda = $imagen_banda;

        return $this;
    }

    /**
     * Get the value of generos
     */ 
    public function getGeneros()
    {
        return $this->generos;
    }

    /**
     * Set the value of generos
     *
     * @return  self
     */ 
    public function setGeneros($generos)
    {
        $this->generos = $generos;

        return $this;
    }
}



?>