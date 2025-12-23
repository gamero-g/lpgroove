<?php

class Disco {
    private $id;
    private $titulo;
    private Banda $banda_id;
    private $descripcion;
    private $cantidad_canciones;
    private $duracion;
    private $anio_de_lanzamiento;
    private $imagen_portada;
    private $imagen_vinilo;
    private $estado;
    private $condicion;
    private $rating;
    private $precio;
    private $stock;
    private $unidades;
    private $destacado;
    private ?Descuento $descuento_id;
    private ?array $generos;

    private static $propiedadesComunes = ['id', 'titulo', 'descripcion', 'cantidad_canciones', 'duracion', 'anio_de_lanzamiento', 'imagen_portada', 'imagen_vinilo', 'estado', 'condicion', 'rating', 'precio', 'stock', 'unidades','destacado'];





    /**
     * Función que recibe un array asociativo que contiene información de un Disco y sus relaciones y luego lo transforma en un objeto Disco complejo.
     * @return Disco El objeto Disco complejo.
     */
    public static function crearDiscoComplejo($discoInformacion):Disco {
        $disco = new self();

        $disco->banda_id = Banda::getBandaPorId($discoInformacion['banda_id']);
        $disco->descuento_id = Descuento:: getDescuentoPorId($discoInformacion['descuento_id']);
        $disco->generos = Genero::getGenerosPorId($discoInformacion['generos']);

    
        foreach (self::$propiedadesComunes as $value) {
            $disco->{$value} = $discoInformacion[$value];
        }


        return $disco;
    }

    
    
    /** 
     * Funcion que obtiene todos los discos de la BBDD, QUE TENGAN STOCK para luego hacerlos objetos complejos.
     * @return Disco[] El array de ojetos Disco.
     */

    public static function obtenerCatalogoCompleto ():array {

        $Conexion = Conexion::getConexion();

        $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos FROM discos LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id WHERE discos.stock > 0 GROUP BY (discos.id)";
     
        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $catalogoCompleto = [];

        while($resultadoQuery = $PDOStatement->fetch()) {
            $catalogoCompleto[] = self::crearDiscoComplejo($resultadoQuery);
        }

        return $catalogoCompleto;
    }

     /** 
     * Funcion que obtiene todos los discos de la BBDD, AUNQUE NO TENGAN STOCKpara luego hacerlos objetos complejos.
     * @return Disco[] El array de ojetos Disco.
     */

    public static function obtenerCatalogoCompletoCompleto ():array {

        $Conexion = Conexion::getConexion();

        $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos FROM discos LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id GROUP BY (discos.id)";
     
        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $catalogoCompleto = [];

        while($resultadoQuery = $PDOStatement->fetch()) {
            $catalogoCompleto[] = self::crearDiscoComplejo($resultadoQuery);
        }

        return $catalogoCompleto;
    }

    /**
     * Función que permite filtrar por destacado o no, obteniendo todo desde la BBDD.
     * @return Disco[] un array de objetos Disco.
     */
    public static function filtrarPorDestacado (): array  {
        $Conexion = Conexion::getConexion();
        $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos
                    FROM discos 
                    LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id 
                    WHERE destacado = ?
                    GROUP BY (discos.id)";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([1]);
        $catalogoFiltrado = [];

        while($resultadoQuery = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::crearDiscoComplejo($resultadoQuery);
        }

        return $catalogoFiltrado;
    }

   /** 
     * función que recibe el nombre de una banda y devuelve un catalogo de productos de esa banda si existe.
     * 
     * @param ?string $nombreBanda Es la banda a filtrar.
     * @return Disco[]|array Devuelve un array de objetos disco, o si esa banda no existe, un array vacío.
     */
    public static function filtrarPorBanda(?string $nombreBanda): array {
    $Conexion = Conexion::getConexion();
        $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos 
                FROM discos 
                JOIN bandas ON bandas.id = discos.banda_id 
                LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id 
                WHERE bandas.nombre = :nombre AND discos.stock > 0
                GROUP BY discos.id";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([
            'nombre' => $nombreBanda
        ]);

        $catalogoFiltrado = [];

        while($resultadoQuery = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::crearDiscoComplejo($resultadoQuery);
        }

        return $catalogoFiltrado;
    }



    /**
     * Funcion que mediante un id, busca en la BBDD ese ID y devuelve el disco, si no lo encuentra rentorna null. 
     * 
     * @param mixed $id Es el id del disco que queremos filtrar, que puede ser null también.
     * @return ?Disco Puede retornar el disco encontrado (desde la función $crearDiscoComplejo), pero si no lo encuentra, retorna null. 
     */
    public static function filtrarPorId(mixed $id):?Disco {
        
        $Conexion = Conexion::getConexion();
        $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos FROM discos LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id WHERE discos.id = ? GROUP BY (discos.id);";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$id]);
    
      
        if($resultadoQuery = $PDOStatement->fetch()) {
            return self::crearDiscoComplejo($resultadoQuery);
        }

        return null;   
    }



    /**
     * Funcion que recibe el valor de la condicion del disco y devuelve un array de objetos discos o un array vacío.
     * @param ?string $condicion Es la condición, que puede ser null también.
     * @return array|Disco[] $catalogoFiltrado Retorna el catalogo filtrado por el value que le proporcionaste a la función, si no se encuentra nada, retorna un array vacío. 
     */
    public static function filtrarPorCondicion (?string $condicion): array  {
        $Conexion = Conexion::getConexion();
        $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos
                    FROM discos 
                    LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id 
                    WHERE condicion = :condicion
                    GROUP BY (discos.id)";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([
            "condicion" => $condicion
        ]);
        $catalogoFiltrado = [];

        while($resultadoQuery = $PDOStatement->fetch()) {
            $catalogoFiltrado[] = self::crearDiscoComplejo($resultadoQuery);
        }

        return $catalogoFiltrado;
    }




    /**
     * Función que recibe la fecha de lanzamiento de un disco (solo año) y devuelve un catálogo filtrado constituido por los discos que sean de esa fecha a 9 años por delante. Es decir, por decadas.
     *  
     * @param int $fechaMin Es la fecha de lanzamiento del disco.
     * @return ?Disco[] $resultadoQuery Retorna el catalogo filtrado por la fecha que le proporcionaste a la función, en caso de ser una fecha que no exista o que no tengamos discos de esa fecha, retorna null. 
     * 
     */
    public static function filtrarPorFechas(int $fechaMin):?array {
        if($fechaMin >= 0 && $fechaMin <= 2030) {
            $Conexion = Conexion::getConexion();
            $query = "SELECT discos.*, GROUP_CONCAT(discos_x_generos.generos_id) AS generos
                    FROM discos 
                    LEFT JOIN discos_x_generos ON discos.id = discos_x_generos.discos_id 
                    WHERE anio_de_lanzamiento BETWEEN :fechaMin and :fechaMax AND discos.stock > 0
                    GROUP BY (discos.id)";

            $PDOStatement = $Conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute([
                "fechaMin" => $fechaMin,
                "fechaMax" => $fechaMin + 9
            ]);

            $catalogoFiltrado = [];

            while($fila = $PDOStatement->fetch()) {
                $catalogoFiltrado[] = self::crearDiscoComplejo($fila);
            }

            return $catalogoFiltrado;
        }

        return null;
    }


    /** Función que obtiene todas las fechas de los discos y las formatea para crear los filtros.
     * 
     */
    public static function crearFechasParaFiltro():array {
        $Conexion = Conexion::getConexion();
        $query = "SELECT anio_de_lanzamiento FROM discos";
        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        $resultadoQuery = $PDOStatement->fetchAll();

        // echo "<pre>";
        // print_r($resultadoQuery);
        // echo "</pre>";

        $soloDecadaFormateada = [];
        $resultadoFinal = [];
        foreach ($resultadoQuery as $fechas) {
            foreach ($fechas as $fecha) {
                $fechaSplit = str_split($fecha);
                // echo "<pre>";
                // print_r($fecha);
                // echo "</pre>";
                $fechaRedondeada = floor($fecha / 10) * 10;
                // echo "<pre>";
                // print_r($fechaRedondeada);
                // echo "</pre>";
                if($fechaSplit[2] > 2) {
                    $fechaSplit[2] .= "0's";
                } else if($fechaSplit[2] == 0){
                    $fechaSplit[2] = "2000's";
                } else if($fechaSplit[2] == 1) {
                    $fechaSplit[2] = "2010's";
                } else if($fechaSplit[2] == 2) {
                    $fechaSplit[2] = "2020's";
                }
                // Buscamos en el array, si el valor de fechaRedondeada es igual al del valor de anio del array de decadaFormateada. Luego, hacemos una comparacion estricta ===, porque array_search puede devolver 0 si el valor está en la primera posicion y 0 es falsy, al usar un !, lo convertimos en true y entra en el array final.
                if(array_search($fechaRedondeada, array_column($soloDecadaFormateada, 'anio')) === false) {
                    $soloDecadaFormateada[] = [
                        'anio' => $fechaRedondeada,
                        'fechaFormateada' => $fechaSplit[2]
                    ];
                }
                sort($soloDecadaFormateada);
                // echo "<pre>";
                // print_r($soloDecadaFormateada);
                // echo "</pre>";
            }
       
        }
        
        return $soloDecadaFormateada;
    }


   /**
     * Funcion que verifica cuantas unidades quedan de un disco, generando un parrafo acorde. 
     * @return string Retorna un string con la cantidad de unidades.
     */
    public function chequearUnidades ():string {
        if($this->unidades === 1) {
            $parrafoUnidades = "¡Última unidad disponible!";
        } else {
            $parrafoUnidades = "Quedan " . $this->unidades . " unidades";
        }
        return $parrafoUnidades;
    }

    

    /**
     * Funcion que devuelve el precio del producto con o sin descuento dependiendo el valor de $oferta.
     * 
     * @return string Retorna el precio del producto sin descuento (en un parrafo) o un div con un 2 parrafos y un span, que incluye el precio del producto con descuento y el descuento.
     */
    public function generarOferta () {
        $precio = $this->precio;
        if($this->getOferta() && $this->getOferta()->getFinalizacion() > date('Y-m-d')) {
           
            $dto = $this->getOferta()->getCantidad_descuento();
            $precioDescuento = ($precio * (100 - $dto)) / 100;
            return "<div>" . "<p class='tachar mb-0'>$" . self::formatearPrecio($precio) . "</p>" . "<p class='fs-2 mb-0'>$" .  self::formatearPrecio($precioDescuento) . "<span class='fs-6 text-success'>$dto%</span> </p>" .   "</div>";
        }
        return "<p class='fs-2 mb-0'>$" . self::formatearPrecio($precio) . "</p>";
    }


    /** 
     * Funcion que obtiene el precio de un producto y lo fomatea.
     * 
     * @param int $precio Es el precio del producto.
     * @return string Retorna el precio del producto fromateado, en forma de string.
     */
    public static function formatearPrecio(int $precio):string {
        return number_format($precio, 0, '', '.');
    }


    /** 
     * Function que obtiene, si es necesario un máximo, y devuelve el texto del disco pero recortado hasta la cantidad maxima de palabras que le especificamos.
     * 
     * @param int $max Es el máximo de palabras que va a tener la nueva descrpción, si no recibe ningún argumento, es 10. 
     * @return string Retorna la descripción del producto con un máximo de palabras y, si la descripción original es mayor al $max, se agregan "...". 
     */
    public function recortarDescripcion(int $max = 10):string {
        $descripcionRecortada = explode(" ", $this->descripcion);

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
     * Funcion que devuelve un precio en cuotas con interes dependiendo la cantidad de cuotas.
     * 
     * @param float $interes Es el interes aplicado al precio, que puede ser un entero como no.
     * @param int $cantidadCuotas Es la cantidad de cuotas.
     * 
     * @return float Retorna un precio por cada cuota, puede ser un int (que vale como float) o un float.
     */
    public function generarCuotas (float $interes, int $cantidadCuotas):float {
        $precio = $this->precio;
        if($cantidadCuotas === 3) {
            $cuotas = ($precio * $interes) / 100;
        } else if ($cantidadCuotas === 6) {
            $cuotas = ($precio * ($interes * 1.2)) / 100;
        } else {
            $cuotas = ($precio * ($interes * 1.4)) / 100;
        }
        return self::formatearPrecio($cuotas);
    }



        /**
     * Función que inserta un nuevo disco en la BBDD.
     * @param int $banda_id Es el ID de la banda dueña del disco.
     * @param mixed$descuento_id Es el ID del descuento, que puede ser null.
     * @param string $titulo Es el título del disco.
     * @param int $cantidad_cancionesvento Es la cantidad de canciones del disco.
     * @param string $duracion Es la duración del disco.
     * @param int $anio_de_lanzamiento Es el año de lanzamiento del disco.
     * @param string $condicion Es la condición del disco.
     * @param string $estado Es el estado del disco.
     * @param string $rating Es el rating del disco.
     * @param float $precio Es el precio del disco.
     * @param int $unidades Son las unidades del disco.
     * @param int $destacado Es si el disco es un disco destacado o no.
     * @param string $descripción Es la descripción del disco.
     * @param string $imagen Es la imagen del disco.
     */
    public static function insert(int $banda_id, mixed $descuento_id, string $titulo, int $cantidad_canciones, string $duracion, int $anio_de_lanzamiento, string $condicion, string $estado, string $rating, float $precio, int $stock, int $unidades, int $destacado, string $descripcion, string $imagen):int {
        $Conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO discos (banda_id, descuento_id, titulo, cantidad_canciones, duracion, anio_de_lanzamiento, imagen_portada, imagen_vinilo, condicion, estado, rating, precio, stock, unidades, destacado, descripcion) VALUES (:banda_id, :descuento_id, :titulo, :cantidad_canciones, :duracion, :anio_de_lanzamiento, :imagen_portada, :imagen_vinilo, :condicion, :estado, :rating, :precio, :stock, :unidades,:destacado, :descripcion)";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "banda_id" => $banda_id,
            "descuento_id" => $descuento_id,
            "titulo" => $titulo,
            "cantidad_canciones" => $cantidad_canciones,
            "duracion" => $duracion,
            "anio_de_lanzamiento" => $anio_de_lanzamiento,
            "imagen_portada" => $imagen,
            "imagen_vinilo" => "vinilo_default.webp",
            "condicion" => $condicion,
            "estado" => $estado,
            "rating" => $rating,
            "precio" => $precio,
            "stock" => $stock,
            "unidades" => $unidades,
            "destacado" => $destacado,
            "descripcion" => $descripcion
        ]); 

        return $Conexion->lastInsertId();
    } 

    /** 
     * Función que inserta las relaciones entre un disco y sus géneros, en la tabla pivot discos_x_generos.
     * @param $discoId Es el ID del disco.
     * @param $generoId Es el ID del género.
     */
    public static function insertDiscoXGenero($discoId, $generoId) {
        $Conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO discos_x_generos VALUES (NULL, :discos_id, :generos_id)";
        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "discos_id" => $discoId,
            "generos_id" => $generoId,
        ]);
        
    }
    
      /** 
     * Función que elimina las relaciones entre un disco y sus géneros, en la tabla pivot discos_x_generos.
     */
    public function deleteDiscoXGenero() {
        $Conexion = (new Conexion())->getConexion();
        $query = "DELETE FROM discos_x_generos WHERE discos_id = :discos_id";
        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "discos_id" => $this->id,
        ]);
    }

     /**
     * Función que edita un disco según su ID, en la BBDD.
     * @param int $banda_id Es el ID de la banda dueña del disco.
     * @param mixed $descuento_id Es el ID del descuento, que puede ser null.
     * @param string $titulo Es el título del disco.
     * @param int $cantidad_cancionesvento Es la cantidad de canciones del disco.
     * @param string $duracion Es la duración del disco.
     * @param int $anio_de_lanzamiento Es el año de lanzamiento del disco.
     * @param string $condicion Es la condición del disco.
     * @param string $estado Es el estado del disco.
     * @param string $rating Es el rating del disco.
     * @param float $precio Es el precio del disco.
     * @param int $unidades Son las unidades del disco.
     * @param int $destacado Es si el disco es un disco destacado o no.
     * @param string $descripción Es la descripción del disco.
     * @param string $imagen Es la imagen del disco.
     */
    public function edit(int $banda_id, mixed $descuento_id, string $titulo, int $cantidad_canciones, string $duracion, int $anio_de_lanzamiento, string $condicion, string $estado, string $rating, float $precio, int $stock, int $unidades, int $destacado, string $descripcion, string $imagen) {
        $Conexion = (new Conexion())->getConexion();
        $query = "UPDATE discos SET banda_id = :banda_id, descuento_id = :descuento_id, titulo = :titulo, cantidad_canciones = :cantidad_canciones, duracion = :duracion, anio_de_lanzamiento = :anio_de_lanzamiento, imagen_portada = :imagen_portada, imagen_vinilo = :imagen_vinilo, condicion = :condicion, estado = :estado, rating = :rating, precio = :precio, stock = :stock, unidades = :unidades, destacado = :destacado, descripcion = :descripcion WHERE id = :id";

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([
            "banda_id" => $banda_id,
            "descuento_id" => $descuento_id,
            "titulo" => $titulo,
            "cantidad_canciones" => $cantidad_canciones,
            "duracion" => $duracion,
            "anio_de_lanzamiento" => $anio_de_lanzamiento,
            "imagen_portada" => $imagen,
            "imagen_vinilo" => "vinilo_default.webp",
            "condicion" => $condicion,
            "estado" => $estado,
            "rating" => $rating,
            "precio" => $precio,
            "stock" => $stock,
            "unidades" => $unidades,
            "destacado" => $destacado,
            "descripcion" => $descripcion,
            "id" => $this->id,
        ]); 
    }

    
    /**
     * Función que elimina un disco de la BBDD dependiendo su ID.
     */
    public function remove() {
        $Conexion = (new Conexion)->getConexion();
        $query = 'DELETE FROM discos WHERE id = ?';

        $PDOStatement = $Conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Funcion que, elimina del array de estados, el estado el cual es el del disco. Con la finalidad de evitar redundancias en los select del edit_disco.
     * @return array Un array de los estados existentes MENOS el del disco.
     */
    public function seleccionarLosEstados():array {
        $estadosExistentes = ['Excelente', 'Detalles Estéticos', 'Muy Bueno', 'Bueno', 'Regular', 'Malo', 'Muy Malo'];
        $posicionAEliminar = array_search($this->estado, $estadosExistentes);
        unset($estadosExistentes[$posicionAEliminar]);
        return $estadosExistentes;
    }

    /**
     * Función que recibe por parametro un disco, y verifica si la oferta sigue siendo válida, a ver cual es su precio final.
     * @param Disco $itemData Es un objeto disco.
     * @return float Es el precio final.
     */
    public static function verificarPrecioFinal(object $itemData):float {  
        if($itemData->getOferta() && $itemData->getOferta()->getFinalizacion() > date('Y-m-d')) {
            $precioFinal = ($itemData->getOferta()) ? ($itemData->getPrecio() - ($itemData->getPrecio() * $itemData->getOferta()->getCantidad_descuento()) / 100 ) : $itemData->getPrecio();
        } else {
            $precioFinal = $itemData->getPrecio();
        }
        return $precioFinal;
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
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of cantidad_canciones
     */ 
    public function getCantidadCanciones()
    {
        return $this->cantidad_canciones;
    }

    /**
     * Set the value of cantidadCanciones
     *
     * @return  self
     */ 
    public function setCantidadCanciones($cantidad_canciones)
    {
        $this->cantidad_canciones = $cantidad_canciones;

        return $this;
    }

    /**
     * Get the value of duracion
     */ 
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of duracion
     *
     * @return  self
     */ 
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get the value of anio_de_lanzamiento
     */ 
    public function getAnioDeLanzamiento()
    {
        return $this->anio_de_lanzamiento;
    }

    /**
     * Set the value of anioDeLanzamiento
     *
     * @return  self
     */ 
    public function setAnioDeLanzamiento($anio_de_lanzamiento)
    {
        $this->anio_de_lanzamiento = $anio_de_lanzamiento;

        return $this;
    }

    /**
     * Get the value of imagen_portada
     */ 
    public function getImagenPortada()
    {
        return $this->imagen_portada;
    }

    /**
     * Set the value of imagen_portada
     *
     * @return  self
     */ 
    public function setImagenPortada($imagen_portada)
    {
        $this->imagen_portada = $imagen_portada;

        return $this;
    }

    /**
     * Get the value of imagenVinilo
     */ 
    public function getImagenVinilo()
    {
        return $this->imagen_vinilo;
    }

    /**
     * Set the value of imagen_vinilo
     *
     * @return  self
     */ 
    public function setImagenVinilo($imagen_vinilo)
    {
        $this->imagen_vinilo = $imagen_vinilo;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of condicion
     */ 
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set the value of condicion
     *
     * @return  self
     */ 
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of unidades
     */ 
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set the value of unidades
     *
     * @return  self
     */ 
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get the value of banda_id
     */ 
    public function getBanda()
    {
        return $this->banda_id;
    }

    /**
     * Set the value of banda_id
     *
     * @return  self
     */ 
    public function setBanda($banda_id)
    {
        $this->banda_id = $banda_id;

        return $this;
    }


    /**
     * Get the value of descuento_id
     */ 
    public function getOferta()
    {
        return $this->descuento_id;
    }

    /**
     * Set the value of descuento_id
     *
     * @return  self
     */ 
    public function setOferta($descuento_id)
    {
        $this->descuento_id = $descuento_id;

        return $this;
    }

    /**
     * Get the value of destacado
     */ 
    public function getDestacado()
    {
        return $this->destacado;
    }

    /**
     * Set the value of destacado
     *
     * @return  self
     */ 
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;

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

    /**
     * Funcion que devuelve un array de los IDs de los generos del disco.
     */
    public function getGeneros_ids():array
    {
        $generos = [];
        foreach ($this->generos as $genero) {
            $generos[] = $genero->getId();
        }
        return $generos;
    }
}