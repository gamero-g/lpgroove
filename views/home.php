<?php 

$catalogoDestacado = Disco::filtrarPorDestacado();


?> 

<section id="fondo">
    <div id="carouselPrincipal" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="fondo-1"><img src="img/banners/californication_banner.webp" alt="Banner publicitario del disco Californication de Red Hot Chili Peppers, ofreciendo un 10% de descuento en efectivo o tarjeta"></div>
            </div>
            <div class="carousel-item">
                <div class="fondo-2"><img src="img/banners/back-in-black_banner.webp" alt="Banner publicitario del disco Back in Black de ACDC, ofreciendo un 10% de descuento en efectivo o tarjeta"></div>
            </div>
            <div class="carousel-item">
            <div class="fondo-3"><img src="img/banners/the-colour-and-the-shape_banner.webp" alt="Banner publicitario del disco The Colour and the Shape de Foo Fighters, ofreciendo un 10% de descuento en efectivo o tarjeta"></div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPrincipal" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previo</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselPrincipal" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</section>



<section id="ofertasEspeciales">
    <div class=" container d-flex justify-content-between align-items-center mb-2 gap-2">
        <h2 class="text-center mb-0">Nuestros productos destacados</h2>
        <div class="linea"></div>
        <a href="index.php?seccion=catalogo" class="text-decoration-none bg-black text-light p-1 rounded-1">Ver más <i class="fa-solid fa-chevron-right bg-black text-light"></i></a>
    </div>
    <div class="d-flex container justify-content-between flex-column flex-wrap flex-md-row gap-2">
        <?php  foreach ($catalogoDestacado as $discos) {?>
            
            <section class="p-4">
                <a href="index.php?seccion=detalle_producto&id=<?= $discos->getId() ?>" class="text-decoration-none">
                    <div class="d-flex justify-content-between">
                        <h3> <?=$discos->getTitulo()?></h3>
                        <span><?=  $discos->getAnioDeLanzamiento() ?></span>
                    </div>
                    <div class="d-flex aparecer-vinilo justify-content-center">
                        <img src="img/portadas/<?=$discos->getImagenPortada() ?>" alt="<?= $discos->getTitulo() ?>, <?= $discos->getAnioDeLanzamiento() ?>" class="portada">
                        <img src="img/vinilo/<?=$discos->getImagenVinilo() ?>" alt="Imagen de vinilo genérico" class="disco">
                    </div>
                    <div class="precio d-flex justify-content-center"><?= $discos->generarOferta( TRUE, $discos->getOferta()->cantidad_descuento ?? 0, $discos->getPrecio()) ?></div>
                </a>
            </section> 

        <?php } ?>      
    </div>


</section>

<section class="container-fluid d-flex pt-5 align-items-center flex-column flex-lg-row mt-5" id="sobreNosotros">
    <div class="container p-0">
        <h2>¿Qué es LPGroove?</h2>
        <p><strong>LPGroove</strong> es una <em>tienda online especializada</em> en la venta de <strong>vinilos de bandas y artistas</strong> de todos los géneros y épocas. Nacida de una <em>pasión por el sonido analógico</em> y la <em>cultura musical</em>, <strong>LPGroove</strong> ofrece una cuidada selección de <strong>discos clásicos</strong>, <em>rarezas coleccionables</em> y <strong>lanzamientos modernos</strong> en formato vinilo. Ya sea que estés buscando <em>redescubrir el calor del rock de los 70</em>, la <em>esencia del jazz clásico</em> o las <em>vibraciones actuales del indie</em>, en <strong>LPGroove</strong> siempre hay un <em>nuevo groove esperándote</em>.
        </p>
        <div class="aparecer-link d-flex">
            <i class="fa-solid fa-chevron-right bg-black text-light"></i>
            <a href="#" class="text-decoration-none text-light">Saber más</a>
        </div>
    </div>
</section>

<section class="container py-4 p-md-5 d-flex flex-column  flex-lg-row justify-content-between" id="icons-info">
    <div>
        <img src="img/Iconos/credit-card-solid.svg" alt="Ícono de una tarjeta de crédito">
        <div>
            <h2 class="fs-3">Hasta 12 cuotas</h2>
            <h3>Abonando con tarjetas de crédito</h3>
        </div>
    </div>
    <div>
        <img src="img/Iconos/truck-fast-solid.svg" alt="Ícono de un camión">
        <div>
            <h2 class="fs-3">Envío rápido a todo el país</h2>
            <h3>A través de OCA</h3>
        </div>
    </div>
    <div>
        <img src="img/Iconos/garania.svg" alt="Ícono de un escudo protegido.">
        <div>
            <h2 class="fs-3">Garantía oficial</h2>
            <h3>De hasta 12 meses</h3>
        </div>
    </div>
</section>

<section id="testimonios" class="py-5  ">
    <h2 class="text-center text-light">Testimonios</h2>
    <div class="container">
        <div class="d-flex justify-content-center flex-column flex-md-row flex-wrap gap-2">
            <article class="card card-testimonios mb-4">
                <picture class="d-flex justify-content-center">
                    <img src="img/testimonios/2.webp" class="img-fluid" alt="imagen de la persona que dejó el comentario" title="imagen de LuisAlberto para testimonio">  
                </picture>
                <div class="card-body text-center">
                    <h3 class="card-title">LuisAlberto</h3>
                    <p class="card-text fst-italic">"10/10, cheff kiss. La selección de vinilos es increíble, encontré algunos títulos que no veía por ninguna parte. 
                        La entrega fue rápida y todo funcionó a la perfección. Sin duda, reviento el aguinaldo."</p>
                </div>
            </article>
            <article class="card card-testimonios mb-4">
                <picture class="d-flex justify-content-center">
                    <img src="img/testimonios/1.webp" class="" alt="imagen de la persona que dejó el comentario" title="imagen de MarIAo para testimonio">  
                </picture>
                <div class="card-body text-center">
                    <h3 class="card-title">MarIA</h3>
                    <p class="card-text fst-italic">"Excelente experiencia en esta tienda, ¡che! Los vinilos llegaron en perfectas condiciones y el servicio al cliente fue re piola. 
                        Recomendadísimo. (claramente no soy una IA intentando pasar por argentino)"</p>
                </div>
            </article>
            <article class="card card-testimonios">
                <picture class="d-flex justify-content-center">
                    <img src="img/testimonios/3.webp" class="" alt="imagen de la persona que dejó el comentario" title="imagen de Marquitos para testimonio">  
                </picture>
                <div class="card-body text-center mb-4">
                    <h3 class="card-title">Marquitos</h3>
                    <p class="card-text fst-italic">"Me sorprendió la variedad de títulos que tienen. Encontré un vinilo que buscaba hace años y dentro de las ofertas relámpago! un culo bárbaro. ¡Un lugar imperdible para los coleccionistas!"</p>
                </div>
            </article>
        </div>
    </div>
</section>

