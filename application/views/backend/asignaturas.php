<div class="col-md-10 contenido">
    <div>
        <?= form_open('admin/asignaturas/buscar', array('class'=>'pull-right')); ?>
            <?= form_input($buscador); ?>
            <?php if(isset($busqueda) && $numero > 0):?>
                <div>                        
                    <?php if($numero == 0):?> 
                        <div class="text-error">
                            <?= $numero; ?> resultados encontrados.
                        </div>
                    <?php elseif($numero == 1):?>
                        <div class="text-success">
                            <?= $numero; ?> resultado encontrado.
                        </div>
                    <?php else:?>
                        <div class="text-success">
                            <?= $numero; ?> resultados encontrados.
                        </div>
                    <?php endif;?>    
                </div>
            <?php endif;?>
        <?= form_close();?>                       
    </div>

    <div>
        <?php if(isset($busqueda)):?>
            <?= form_open('admin/asignaturas/buscar', array('class'=>'cantidad'));?>
        <?php else:?>
            <?= form_open('admin/asignaturas', array('class'=>'cantidad'));?>
        <?php endif;?>
            <?= form_dropdown('cantidad',$opciones,$limit,'class = input-small');?> 
            <?= form_submit(array('class'=>'btn btn-primary'),"Mostrar");?>
        <?= form_close();?>    
    </div>

    <?php if($numero == 0 && isset($busqueda)):?> 
        <div class="alert alert-danger span10 al" id="Error">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button> 
            No se han encontrado profesores que concuerden con esos criterios.
        </div>
    <?php else:?>
        <?= form_open('admin/asignaturas/borrar', array('name'=> 'f1', 'id'=> 'formBorrar')); ?>
        <div>
            <?= form_submit($borrar); ?>
        </div>

        <div class="row-fluid" id="flip-scroll">
            <table class="table-hover table-bordered table-condensed cf col-md-12">
                <thead class="cf">
                    <tr>
                        <th class="text-center"><input type="checkbox" id="input" onclick="seleccionar_checkbox(this.checked); crear_boton(this.checked);"></th>

                        <?php foreach($fields as $field_name => $field_display): ?>
                            <?php if(isset($busqueda)):?>
                                <th>
                                     <?php if($orden == 'asc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/asignaturas/buscar/$field_name/desc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet"></i>'); ?>
                                        <?php else:?>    
                                            <?= anchor("admin/asignaturas/buscar/$field_name/desc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-order"></i>'); ?>
                                        <?php endif;?>    
                                    <?php elseif($orden == 'desc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/asignaturas/buscar/$field_name/asc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>'); ?>
                                        <?php else:?>    
                                            <?= anchor("admin/asignaturas/buscar/$field_name/asc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-order-alt"></i>'); ?>
                                        <?php endif;?>    
                                    <?php else: ?>
                                        <?= anchor("admin/asignaturas/buscar/$field_name/" .(($orden == 'asc' && $campo == $field_name) ? 'desc' : 'asc')."/$elementos/$busq" , $field_display); ?>
                                    <?php endif;?>
                                </th>
                            <?php else: ?>
                                <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                    <th>
                                <?php else:?>
                                    <th class="text-center">
                                <?php endif;?>        
                                    <?php if($orden == 'asc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/asignaturas/$field_name/desc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet"></i>'); ?>
                                        <?php else:?>    
                                            <?= anchor("admin/asignaturas/$field_name/desc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-order"></i>'); ?>
                                        <?php endif;?>
                                    <?php elseif($orden == 'desc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/asignaturas/$field_name/asc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>'); ?>
                                        <?php else:?>
                                            <?= anchor("admin/asignaturas/$field_name/asc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-order-alt"></i>'); ?>
                                        <?php endif;?>
                                    <?php else: ?>
                                        <?= anchor("admin/asignaturas/$field_name/" .(($orden == 'asc' && $campo == $field_name) ? 'desc' : 'asc')."/$elementos" , $field_display); ?>
                                    <?php endif;?>
                                </th>
                            <?php endif;?>    
                        <?php endforeach; ?>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($asignaturas)): ?>
                        <?php $aux = 0; ?>
                        <?php foreach($asignaturas as $asignatura): ?>
                            <tr>
                                <?php  $check= array('name' => 'checkbox[]', 'checked'=> FALSE, 'value'=>$asignatura->Codigo); ?>
                                <td class="text-center"><?= form_checkbox($check); ?></td>
                                <td data-title="Nombre"><?= anchor("admin/asignatura/informacion/$asignatura->Codigo",$asignatura->Nombre);?></td>
                                <td data-title="Precio" class="text-center"><?= $asignatura->Precio;?> €</td>                                
                                                             
                                <td data-title="Opciones">
                                    
                                    <div>
                                        <a href="#myModal<?= $aux?>" data-toggle="modal"> 
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                            Datos
                                        </a>
                                        <div class="modal fade" id="myModal<?= $aux;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">                                            
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                        <h5 id="myModalLabel"> <?= $asignatura->Nombre; ?></h5>

                                                    </div>
                                                    <div class="modal-body">                                                        
                                                        <strong>Precio:</strong>
                                                        <?= $asignatura->Precio;?><br>
                                                        <strong>Aula:</strong>
                                                        <?= $asignatura->Aula;?><br>
                                                        <?php if(isset($grupos)):?>
                                                            <strong>Grupos:</strong>
                                                            <?php foreach($grupos as $grupo):?>
                                                                <?= $grupo->Nombre .' '.$grupo->Plazas;?>
                                                            <?php endforeach;?>
                                                        <?php endif;?>        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="<?=base_url();?>admin/asignatura/editar/<?= $asignatura->Codigo;?>"> 
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Editar
                                        </a>                            
                                    </div>    
                                    <div>
                                        <a href="<?=base_url();?>admin/asignatura/borrar/<?= $asignatura->Codigo;?>" data-confirm="¿Desea eliminar los datos correspondientes a la asignatura <?= $asignatura->Nombre;?>?"> 
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Borrar
                                        </a>
                                    </div>    
                                </td>
                            </tr>
                            <?php $aux++;?>
                        <?php endforeach; ?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    <?= form_close();?>
        <?php if(!isset($vacio)): ?>
        <div class="text-center">
            <ul class="pagination">
                <?= $links; ?> 
            </ul>    
        </div>
        <?php endif; ?>
    <?php endif;?>
</div>
</div>
</body>
           

