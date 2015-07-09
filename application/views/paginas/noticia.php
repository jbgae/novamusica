<section>
    <?php if(isset($error)):?>
        <div class="alert alert-danger container">
            <h4>Advertencia.</h4>
            <?= 'La noticia seleccionada no existe. Vuelve a la seción de noticias y selecciona la notica que desees.';?>
        </div>
    <?php else:?>
        <div class="container" id="noticia">        
            <h3><?= ucfirst($noticia->Titulo);?></h3>
            <div class ="datos">Escrito por <?= $escritor; ?> el <?= date("d-m-Y H:i:s", strtotime($noticia->FechaCreacion))?> </div>
            <div class="noticia"> <?= $noticia->Contenido; ?> </div>
            <?php if(isset($_SERVER['HTTP_REFERER'])):?>
                <p><a href="<?=$_SERVER['HTTP_REFERER']?>">Volver</a>
            <?php endif;?>        
        </div>
    <?php endif;?>
</section>