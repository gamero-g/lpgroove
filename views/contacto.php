<section id="pregfrecuentes">
    <div class="container py-5">
        <h2 class="pb-2 text-center">Preguntas frecuentes</h2>
        <div class=" d-flex justify-content-center">
            <p class="pb-1 dudas">
                ¿Tenés dudas o consultas? siempre podés contactarnos! pero antes <strong>te recomendamos revisar las preguntas frecuentes</strong> , tal vez tu duda esté resuelta y no tengas que esperar un solo segundo!.
            </p>
        </div>
        <div class="row d-flex align-items-center">
            <div class="d-none d-lg-block col-lg-5 col-xxl-4">
                <picture>
                    <img src="img/faq.webp" alt="Imagen preguntas frecuentes" title="Imagen para de ? para preguntas frecuentes">
                </picture>
            </div>
            <div class="col-12 col-lg-7 col-xxl-8">
                <div class="accordion" id="acordionFrecuentes">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#preguntafrecuente1" aria-expanded="true" aria-controls="preguntafrecuente1">
                            ¿Realizan envíos a cualquier parte?
                            </button>
                        </h3>
                        <div id="preguntafrecuente1" class="accordion-collapse collapse show" data-bs-parent="#acordionFrecuentes">
                            <div class="accordion-body">
                                <p><strong>Si! no importa de donde seas, podemos realizar el envío de tu compra.</strong> Los costos variarán según el peso, la distancia y si es un envío internacional o dentro de la Argentina.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#preguntafrecuente2" aria-expanded="false" aria-controls="preguntafrecuente2">
                                Quiero enviar un producto como regalo, ¿es posible?
                            </button>
                        </h3>
                        <div id="preguntafrecuente2" class="accordion-collapse collapse" data-bs-parent="#acordionFrecuentes">
                            <div class="accordion-body">
                                <p><strong>Claro que si! envolveremos el producto y podemos agregar una tarjeta con tu dedicatoria.</strong> siempre que quieras podes marcar la opción de "Prerar para regalo" en el carrito de compras, rellenas los campos y nosotros nos encargamos del resto.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#preguntafrecuente3" aria-expanded="false" aria-controls="preguntafrecuente3">
                            ¿Qué pasa si mi pedido llega roto o no es el correcto?
                            </button>
                        </h3>
                        <div id="preguntafrecuente3" class="accordion-collapse collapse" data-bs-parent="#acordionFrecuentes">
                            <div class="accordion-body">
                                <p><strong>Contamos con un servicio post-venta dispuesto a solucionar cualquier problema que se presente.</strong> Tenemos tanto cariño por los vinilos como vos, así que cada envío sale protegido para que no tengas que esto nunca le pase a tu compra!.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#preguntafrecuente4" aria-expanded="false" aria-controls="preguntafrecuente4">
                            ¿Cómo pagar tu compra?
                            </button>
                        </h3>
                        <div id="preguntafrecuente4" class="accordion-collapse collapse" data-bs-parent="#acordionFrecuentes">
                            <div class="accordion-body">
                                <p><strong>Podés pagar con cualquier medio de pago digital</strong> (Débito, crédito y/o transferencia) y <strong>tu compra va a estar 100% protegida</strong>. Si el producto no es lo que esperabas, te devolveremos el dinero.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#preguntafrecuente5" aria-expanded="false" aria-controls="preguntafrecuente5">
                            ¿Tienen una tienda física?
                            </button>
                        </h3>
                        <div id="preguntafrecuente5" class="accordion-collapse collapse" data-bs-parent="#acordionFrecuentes">
                            <div class="accordion-body">
                                <p>Por el momento no contamos con una tienda física para que puedas visitarnos como comprador.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="d-flex justify-content-center formulario">
    <div class="container">
        <form action="index.php?seccion=respuesta_form" method="POST" id="form" class="min-w-500" >
            <h2 class="fs-5 text-center pt-5 text-light">¿Seguís teniendo dudas? ¡No dudes en consultar!</h2>
            <div class="d-flex flex-column align-items-center">
                <div  class="d-flex flex-column flex-md-row gap-2" id="sobreVos">
                    <div class="d-flex flex-column justify-content-between py-4 ">
                        <h3 class="pb-4 text-left">Datos de contacto</h3>
                        <div class="form-floating">
                            <select class="form-select mb-3" id="motivo" name="motivo" required>
                                <option value="" selected disabled>Elegí una opción</option>
                                <option value>Encargos</option>
                                <option value="devoluciones">Devoluciones</option>
                                <option value="quiero vender">Quiero vender</option>
                                <option value="otros motivos">Otros motivos</option>
                            </select>
                            <label for="motivo">Motivo de contacto</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                            <label for="nombre">Ingresa tu nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu e-mail" required>
                            <label for="email">Ingresa tu e-mail</label>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between py-4 ">
                        
                        <label for="consulta">¿Que te gustaría preguntar?</label>
                        <textarea id="consulta" name="consulta" class="form-control" rows="8" placeholder="Escríbenos aquí tus preguntas" maxlength="200" required></textarea>
                        
                    </div>
                </div>
                <div class="d-flex justify-content-center pb-3">
                    <input type="submit" class="btn btn-dark text-light" value="Enviar">
                </div>
            </div>
        </form>
    </div>
</section>
