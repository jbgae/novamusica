<section>
    <div class="container-fluid container">
        <div class="row-fluid">
            <div class="col-md-6">
                <h3>Contacta con nosotros</h3>
                <div class ="text"> 
                    Si desea realizar alguna consulta o necesita más información sobre 
                    cualquiera de nuestros servicios, póngase en contacto con nosotros y le 
                    responderemos lo antes posible.
                </div>

                <?php if(isset($mensaje)):?>    
                    <?= $mensaje;?>
                <?php endif;?>
                <div class='clearfix'></div>
                
                <?= form_open('contacto', array('id'=>'contacto')); ?>
                    <?php foreach($formulario as $input): ?>
                        <div class="control-group">
                            <?php if($input['input']['name'] != 'politica'):?>
                                <label class="control-label" for="<?= $input['input']['id'];?>" accesskey ="<?= $input['label']['accesskey'];?>"><?= $input['label']['name']; ?><span class='rojo'>*</span></label>
                            <?php else:?>     
                                <label class="control-label" for="<?= $input['input']['id'];?>" accesskey ="<?= $input['label']['accesskey'];?>"><span class='rojo'>*</span><?= $input['label']['name']; ?></label>
                            <?php endif;?>        
                            <div class="controls">
                                <?php if($input['input']['name'] == 'comentario'): ?>
                                    <?= form_textarea($input['input']);?>
                                <?php elseif($input['input']['name'] == 'politica'):?>
                                    <?= form_checkbox($input['input']);?>                                    
                                <?php else: ?>                   
                                    <?= form_input($input['input']); ?>                       
                                <?php endif; ?> 

                                <?= form_error($input['input']['name']); ?>
     
                            </div>
                        </div>
                    <?php endforeach; ?>        
                    <div class="botones">
                        <?php echo form_submit($boton,'Enviar');  ?>
                        <?php echo form_reset('myreset', 'Borrar', 'class = "btn btn-default" id="borrar"'); ?>
                    </div>
                <?= form_close(); ?>
            </div>
            
            <div class="col-md-6"> 
                <h3>Nos encontrarás en</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3210.6233958713296!2d-6.149346999999986!3d36.418305999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0c348330183483%3A0xceccf42219f3921c!2sNova+m%C3%BAsica.+Centro+de+m%C3%BAsica+y+danza!5e0!3m2!1ses!2ses!4v1403892491898" 
                        width="600" height="450" frameborder="0" style="border:0"></iframe>
                
                
            </div>
        </div>
    </div>
</section>
