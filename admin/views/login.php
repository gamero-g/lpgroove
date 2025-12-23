
<section class=" py-5"  id="loguinAdm">
    <h3 class="fs-2 text-center mb-4 text-danger">Área de administración</h3>
    <p class="text-center text-muted mb-5 fw-bold">Acceso exclusivo para personal autorizado</p>
    <div class="d-flex justify-content-center">
        <a class=" text-light bg-black p-1 rounded text-decoration-none mb-4" href="../index.php?seccion=home">Volver al inicio</a>
    </div>
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-body p-4">
                       <?php if($_SESSION) { ?>
                                <?php if(isset($_SESSION['alertas'])) { ?>
                                     <div>
                                    <?php foreach ($_SESSION['alertas'] as $alerta) { ?>
                                        <?php if($alerta['donde'] === 'loginback') { ?>
                                                <?= Alerta::obtenerAlertas() ?>
                                            <?php } ?> 
                                    <?php } ?>
                                </div> 
                        <?php }} ?>
                        <form action="actions/check_login.php?donde=loginback" method="POST">
                            <div class="mb-4">
                                <label for="user" class="form-label">Administrador</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-danger text-white">
                                        <i class="bi bi-shield-lock-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuario admin">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="pass" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-danger text-white">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger btn-lg">Ingresar como administrador</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>