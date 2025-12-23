<?PHP


class Vista{
    private $id;
    private $nombre;
    private $titulo;
    private $activa;
    private $restringida;

    
   

    /**
     * Valida el nombre de la vista para devolver el objeto Vista apropiado
     * @param ?string $vistaNombre el nombre de la vista o null
     * @return Vista devuelve un objeto vista adecuado
     */
    public static function validar_vista(?string $vistaNombre): Vista{
        $conexion = conexion::getConexion();
        $query = "SELECT * FROM vistas WHERE nombre = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$vistaNombre]);

        $fetchVistas = $PDOStatement->fetch();
        if ($fetchVistas){
            $mostrar = $fetchVistas;

            if($fetchVistas->getActiva()){
                $vista403 = new self();
            }else{
                $vista403 = new self();
                $vista403->nombre = 'mantenimiento';
                $vista403->titulo = 'Págania no disponible';
                $mostrar = $vista403;
            }
        }else{
            $vista404 = new self();
            $vista404->nombre = '404';
            $vista404->titulo = 'No encontramos la página';
            $mostrar = $vista404;
        }

        return $mostrar;
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
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of activa
     */ 
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set the value of activa
     *
     * @return  self
     */ 
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get the value of restringida
     */ 
    public function getRestringida()
    {
        return $this->restringida;
    }

    /**
     * Set the value of restringida
     *
     * @return  self
     */ 
    public function setRestringida($restringida)
    {
        $this->restringida = $restringida;

        return $this;
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
}