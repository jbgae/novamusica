<div class="col-md-10 contenido">
          
    <?php if(isset($mensaje)):?>
        <div class="alert alert-success"><?= $mensaje;?></div>
    <?php endif;?>
    <?php if(isset($error)):?>
        <div class="alert alert-danger"><?= $error;?></div>
    <?php endif;?>
        
    <?php if(isset($actualizar)): ?>
        <?= form_open('admin/asignatura/editar/'.$codigo,array('class'=>'form-horizontal', 'id'=>'empleadoForm')); ?>
    <?php elseif(isset($datos)): ?>
        <?= form_open("$user/datos",array('class'=>'form-horizontal', 'id'=>'empleadoForm')); ?>
    <?php else: ?>
        <?= form_open('admin/asignatura/registrar',array('class'=>'form-horizontal', 'id'=>'empleadoForm')); ?>                           
    <?php endif;?>

     
            
            
    <?php foreach($formulario as $input): ?>
        <div class="form-group">
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
                <?php if($input['input']['name'] == 'texto'): ?>
                    <?= form_textarea($input['input']); ?>
                    <?= form_error($input['input']['name']); ?>
                <?php elseif($input['input']['name'] == 'aula'):?>
                    <?php if($this->uri->segment('3') == 'registrar'):?>
                        <?= form_dropdown($input['input']['name'], $aulas);?>
                    <?php else:?>    
                        <?= form_dropdown($input['input']['name'], $aulas, $input['input']['value']);?>
                    <?php endif;?>    
                    <a href="#aula" data-toggle="modal"> 
                    <i class="glyphicon glyphicon-edit"></i>
                        Editar
                    </a>                    
                <?php else: ?>
                    <?= form_input($input['input']); ?>
                    <?= form_error($input['input']['name']); ?>
                <?php endif;?>
            </div>
        </div>
    <?php endforeach; ?> 
        
    <div class="col-sm-2"></div>
    <div class="col-sm-2">
        <?php if(isset($actualizar)): ?>
            <?= form_submit($boton, 'Actualizar clase'); ?>
        <?php elseif(isset($datos)): ?>
            <?= form_submit($boton, 'Actualizar datos'); ?>
        <?php else: ?>
            <?= form_submit($boton, 'Registrar clase'); ?>
        <?php endif;?>
    </div>    
    <?= form_close(); ?>
    
    <div class="modal fade" id="aula" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">                                            
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h5 id="myModalLabel"> Aulas</h5>
                </div>
                <div class="modal-body">
                    <?php if(!empty($aulasAux)):?>
                        <div class="aulas">
                            <?php foreach($aulasAux as $aula):?>
                                <div>
                                    <strong><?= ucfirst($aula->Nombre) ;?></strong>
                                    <?= " (".$aula->Capacidad. " personas de capacidad)"?> 
                                    <?= anchor("admin/aula/eliminar/$aula->Codigo","<i class=\"glyphicon glyphicon-trash\"></i> Eliminar", "class=\"btn btn-danger btn-xs pull-right eliminar\" ");?>
                                </div>
                                <br>
                            <?php endforeach;?>                                 
                        </div>    
                    <?php endif;?>
                    <div class="clearfix divider"></div>
                    <br>
                    <h5 id="myModalLabel"> Registrar aula</h5>
                    <div class="formulario">
                        <div class="formulario2">
                            <form name="register" method="post" action="" class="form-horizontal" id="formdata">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 control-label">Nombre del aula:</label>
                                    <input type="text" name="nombreAula" value="" class="nombreAula" id="nombreAula" maxlength="40" size="35" autofocus="autofocus"> 
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 control-label">Capacidad:</label>
                                    <input type="text" name="capacidad" value="" class="capacidad" id="capacidad" maxlength="5" size="15"> 
                                </div>
                            </form>
                        </div>
                        <input type="button" value="Crear" id="crear" class="btn btn-primary btn-xs">
                        <div class="mensaje"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    
</div>
