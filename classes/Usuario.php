<?PHP

class Usuario{
    private $id;
    private $email;
    private $usuario;
    private $nombre_completo;
    private $contrasenia;
    private $rol;

    /**
     * Recibe un string y busca si es un usuario válido
     * @param string $usuario Es el nombre de usuario
     */
    public static function usuario_x_username(string $usuario): ?Usuario{
        $conexion = Conexion::getConexion();
        $query = "SELECT * from usuarios where usuario = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$usuario]);
        $rta = $PDOStatement->fetch();

        if (!$rta){
            return null;
        }
        return $rta;
    }

    /**
     * Verifica los datos ingresados por el usuario en la autenticación, si son correctos se alojan en la sesión.
     * @param string $user El nombre del usuario
     * @param string $pass La contraseña del usuario
     * @return mixed Devuelve el rol del usuario logueado. Devuelve FALSE si el usuario existe pero la contraseña es incorrecta. Devuelve NULL si el usuario no existe.
     */
    public static function login(string $user, string $pass, $donde): mixed{
        
        $datosUsuario = SELF::usuario_x_username($user);

        if ($datosUsuario){

            if(password_verify($pass, $datosUsuario->getContraseña())){
                $infoUsuarioLogueado['id'] = $datosUsuario->getId();
                $infoUsuarioLogueado['usuario'] = $datosUsuario->getUsuario();
                $infoUsuarioLogueado['rol'] = $datosUsuario->getRol();
                $_SESSION['logueado'] = $infoUsuarioLogueado;

                return $infoUsuarioLogueado['rol'];
            }else{
                Alerta::agregarAlerta("danger", "Contraseña incorrecta", $donde);
                if($donde === 'back') {
                    header('location: index.php?seccion=login');
                } else {
                    header('location: ../index.php?seccion=login');
                }
                return FALSE;
            }
        }else{
            Alerta::agregarAlerta("danger", "Usuario incorrecto", $donde);
            return NULL;
        };
    }

    /**
     * Credenciales
     * @param int $lvl Es el nivel de restricción de la vista. Si no se pasa ningún valor, se asume como 0.
     * @return bool Si el lvl es = 0, entonces retorna true (podés ver la vista). Si es 1 y estás logueado como admin o superadmin, true, sino false. Si no estás logueado, false.
     */
    public static function acreditar(int $lvl = 0):bool{
        if(!$lvl){
            return true;
        }

        if (isset($_SESSION['logueado'])){

            if($lvl > 1) {
                if($_SESSION['logueado']['rol'] == "Admin" || $_SESSION['logueado']['rol'] == "Superadmin"){
                    return true;
                }else{
                    header('location: index.php?seccion=login');
                    return false;
                }
            } else {
                return true;
            }

        }else{
            header('location: index.php?seccion=login');
            return false;
        }
    }

    /**
     * Si en la sesión, el array 'logueado' tiene contenido lo vacía 
     */
    public static function logout(){
        if (isset($_SESSION['logueado'])){
            unset($_SESSION['logueado']);
        };
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of nombre_completo
     */ 
    public function getNombre_completo()
    {
        return $this->nombre_completo;
    }

    /**
     * Set the value of nombre_completo
     *
     * @return  self
     */ 
    public function setNombre_completo($nombre_completo)
    {
        $this->nombre_completo = $nombre_completo;

        return $this;
    }

    /**
     * Get the value of contrasenia
     */ 
    public function getContraseña()
    {
        return $this->contrasenia;
    }

    /**
     * Set the value of contrasenia
     *
     * @return  self
     */ 
    public function setContraseña($contrasenia)
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}