
<section class=" bg-black text-light" id="loguinUser">
    <h2 class="text-center mb-4 py-5 bg-light text-black">Iniciá sesión</h2>
    <p class="text-center text-light mb-5">Acceso para usuarios registrados</p>

    <div class="container d-flex flex-column pt-5 justify-content-center">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lgg rounded-4">
                    <div class="card-body p-4">
                        <?php if($_SESSION) { ?>
                                <?php if(isset($_SESSION['alertas'])) { ?>
                                     <div>
                                    <?php foreach ($_SESSION['alertas'] as $alerta) { ?>
                                        <?php if($alerta['donde'] === 'loginfront') { ?>
                                                <?= Alerta::obtenerAlertas() ?>
                                            <?php } ?> 
                                    <?php } ?>
                                </div> 
                        <?php }} ?>
                        <form action="admin/actions/check_login.php?donde=loginfront" method="POST">
                            <div class="mb-4">
                                <label for="user" class="form-label">Nombre de usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="user" name="user" placeholder="Tu usuario">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="pass" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Tu contraseña">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn bg-black text-light btn-lg">Iniciar sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>