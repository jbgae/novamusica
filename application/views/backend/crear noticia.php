<div class="col-md-10 contenido">
    <?php if(isset($actualizar)): ?>
        <?= form_open('admin/noticias/editar/'.$id, array('id'=>'noticiaForm')); ?>
    <?php else: ?>
        <?= form_open('admin/noticias/crear', array('id'=>'noticiaForm')); ?>
    <?php endif;?>

    <?php if(isset($valido)):?>
    <div class="alert alert-success">
        <?= $valido;?>
    </div>
    <?php endif;?>
    <?php if(isset($error)):?>
    <div class="alert alert-error">
        <?= $error;?>
    </div>
    <?php endif;?>

    <?php foreach($formulario as $input): ?>
        <div class="form-group">    
            <label class="col-md-2 col-sm-2 control-label" for="<?= $input['id']; ?>">
                <?= ucfirst($input['label']); ?>
            </label>
            <?php if($input['id'] == 'contenido'): ?>
                <?= form_textarea($input); ?>
                <?= form_error($input['name']); ?>
            <?php else: ?>
                <?= form_input($input); ?>
                <?= form_error($input['name']); ?>
            <?php endif;?>
        </div>
    <?php endforeach; ?>
    <br>
    <div>
        <?php if(isset($actualizar)): ?>
            <?= form_submit($boton, 'Actualizar noticia'); ?>
        <?php else: ?>
            <?= form_submit($boton, 'Crear noticia'); ?>
        <?php endif;?>
    </div>    
    <?= form_close(); ?> 
</div>

