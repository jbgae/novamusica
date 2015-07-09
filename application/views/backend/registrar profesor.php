<div class="col-md-10 contenido">
    <?php if($this->uri->segment(3) == 'registrar' || !isset($imagen)):?>
        <img src ="<?= base_url();?>images/paginas/images.jpeg" class="foto hidden-xs hidden-sm" alt="foto de empleado">        
    <?php else:?>        
        <img src ="<?= $imagen;?>" class="foto hidden-xs hidden-sm" alt="foto de empleado">        
    <?php endif;?>        
    <?php if(isset($mensaje)):?>
        <div class="alert alert-success"><?= $mensaje;?></div>
    <?php endif;?>
    <?php if(isset($error)):?>
        <div class="alert alert-danger"><?= $error;?></div>
    <?php endif;?>
        
    <?php if(isset($actualizar)): ?>
        <?= form_open_multipart('admin/profesor/editar/'.$codigo,array('class'=>'form-horizontal', 'id'=>'empleadoForm')); ?>
    <?php elseif(isset($datos)): ?>
        <?= form_open_multipart("$user/datos",array('class'=>'form-horizontal', 'id'=>'empleadoForm')); ?>
    <?php else: ?>
        <?= form_open_multipart('admin/profesor/registrar',array('class'=>'form-horizontal', 'id'=>'empleadoForm')); ?>                           
    <?php endif;?>

           
    <?php foreach($formulario as $input): ?>
        <div class="form-group">
            <?php if($input['input']['name'] == "texto"):?>
                <h4>Datos públicos</h4>                
            <?php elseif($input['input']['name'] == "nombre"):?> 
                <h4>Datos personales</h4>   
            <?php elseif($input['input']['name'] == "asignaturas"):?> 
                <h4>Asignaturas</h4>
            <?php endif;?>    
            <?php if($input['label']['accesskey'] != ''):?>
                <label class="col-md-2 col-sm-2 control-label" for="<?= $input['input']['id'];?>" accesskey ="<?= $input['label']['accesskey'];?>"><?= $input['label']['name']; ?>
            <?php else:?>
                 <label class="col-md-2 col-sm-2 control-label"><?= $input['label']['name']; ?>
            <?php endif;?>
                <?php if(isset($input['requerido'])):?>
                    <?php if($input['requerido']):?>
                        <span class="rojo">*</span>
                    <?php endif;?>
                <?php endif;?>
            </label>
            <div class="col-sm-9">   
            <?php if($input['input']['name'] == 'pass' || $input['input']['name'] == 'passconf'): ?>
                <?= form_password($input['input']);?>
                <?= form_error($input['input']['name']);?>
            <?php elseif($input['input']['name'] == 'asignaturas'):?>
                <?php foreach($check as $box):?>
                    <div class="col-md-6">    
                        <?=  form_checkbox($box);?>
                        <label><?= $box['id']; ?></label>
                    </div>
                <?php endforeach;?>
            <?php elseif($input['input']['name'] == 'provincia'):?>
                <?php if(isset($actualizar)): ?>
                    <?= form_dropdown($input['input']['name'], $provincias, $input['input']['value'], 'id="provincia"');?>
                <?php else:?>
                    <?= form_dropdown($input['input']['name'], $provincias, '', 'id = "provincia"');?>
                <?php endif;?>
            <?php elseif($input['input']['name'] == 'ciudad'):?>
               <?php if(isset($actualizar)): ?>
                   <select name="ciudad" id="ciudad">                                  
                       <?php foreach($ciudades as $ciudad):?>
                            <?php if($input['input']['value'] == $ciudad->Codigo):?>
                                 <option value="<?= $ciudad->Codigo;?>" selected><?= $ciudad->Ciudad;?></option>
                            <?php else:?>     
                                 <option value="<?= $ciudad->Codigo;?>"><?= $ciudad->Ciudad;?></option>
                            <?php endif;?>        
                       <?php endforeach;?>     
                   </select> 
               <?php else:?>
                   <select name="ciudad" id="ciudad"></select>
               <?php endif;?>
            <?php elseif($input['input']['name'] == 'texto'): ?>
                   
                <?= form_textarea($input['input']); ?>
                <?= form_error($input['input']['name']); ?>
            <?php else: ?>
                <?= form_input($input['input']); ?>
                <?= form_error($input['input']['name']); ?>
            <?php endif;?>
            </div>
        </div>
    <?php endforeach; ?> 
        <label  class="col-md-2 col-sm-2 control-label" for="imagen">Imagen</label>
        <div class="col-sm-9"> 
            <input type="file"  title="Examinar" name="archivo" class="imagen"> 
        </div>
        <br>

    <br>
    <div class="col-sm-2"></div>
    <div class="col-sm-2">
        <?php if(isset($actualizar)): ?>
            <?= form_submit($boton, 'Actualizar profesor'); ?>
        <?php elseif(isset($datos)): ?>
            <?= form_submit($boton, 'Actualizar datos'); ?>
        <?php else: ?>
            <?= form_submit($boton, 'Crear profesor'); ?>
        <?php endif;?>
    </div>    
    <?= form_close(); ?>

    
</div>
