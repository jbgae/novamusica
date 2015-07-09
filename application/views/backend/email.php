<div class="col-md-10 contenido">
    <?= form_open($this->uri->segment(1).'/'.$this->uri->segment(2)."/enviar/". urlencode($email)); ?>
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
            <?= form_submit($boton, 'Enviar email'); ?>
        </div>    
    <?= form_close(); ?>  
</div>
