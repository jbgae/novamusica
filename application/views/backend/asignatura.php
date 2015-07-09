<div class="col-md-10 contenido">
    <br>
    <h4><?= $asignatura->Nombre;?></h4>
    <div class="marginBottom">
        <a href="#myModalForm" data-toggle="modal" class="btn btn-primary"> 
            <i class="glyphicon glyphicon-plus"></i>
            Crear grupo
        </a>
    </div>
    <?php if(isset($grupos) && !empty($grupos)):?>
         <div class="row-fluid" id="flip-scroll">
            <table class="table-hover table-bordered table-condensed cf col-md-12">
                <thead class="cf">
                    <tr>
                        <td>Grupo</td>
                        <td>Opciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php $aux = 0; ?>
                <?php foreach($grupos as $grupo):?>
                    <tr>
                        <td><?= $grupo->Nombre;?></td>
                        <td>
                            <div>
                                <a href="#myModal<?= $aux?>" data-toggle="modal"> 
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                    Datos
                                </a>
                            </div>
                            <div>
                                <a href="<?=base_url();?>admin/grupo/borrar/<?= $grupo->Codigo;?>" data-confirm="¿Desea eliminar los datos correspondientes al  grupo <?= $grupo->Nombre;?>?"> 
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Borrar
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
         </div>
    <?php endif;?>
    <div class="modal fade" id="myModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">                                            
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 id="myModalLabel"> <?= $asignatura->Nombre; ?></h4>

                </div>
                <div class="modal-body">
                    <form name="register" method="post" action="" class="form-horizontal" id="formdata">
                        <div class="form-inline">
                            <input type="hidden" value="<?= $asignatura->Codigo;?>" name="cod">
                        </div>
                        <div class="form-inline">                                                            
                            <label>Nombre grupo:</label>
                            <?= form_input(array('placeholder'=>'ej: Grupo 1','name'=>'NombreGrupo', 'id'=>'NombreGrupo')); ?>                                                                                                                               
                        </div>

                        <div class="form-inline" id="semana">
                            <?= form_dropdown('diaSemana[]',$semana);?>
                            <label>Hora inicio:</label>
                            <?= form_input(array('placeholder'=>'ej: 09:00', 'size'=>'10','name'=>'HoraInicio[]', 'id'=>'HoraInicio')); ?>
                            <label>Hora fin:</label>
                            <?= form_input(array('placeholder'=>'ej: 10:30', 'size'=>'10','name'=>'HoraFin[]', 'id'=>'HoraFin')); ?>
                        </div>

                        <div>
                            <a href="#campos" onclick="AgregarCampos();">
                                <i class="glyphicon glyphicon-plus"></i> Añadir dia
                            </a>    
                        </div> 
                        <div id="mensaje"></div>
                    <?= form_close(); ?>
                </div>
                <div class="modal-footer">
                    <?= form_submit('','Crear grupo', "class='btn btn-default' id='crearGrupo'"); ?> 
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
