<div class="col-md-10 contenido">
    <div>
        <?= form_open('admin/profesores/buscar', array('class'=>'pull-right')); ?>
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
            <?= form_open('admin/profesores/buscar', array('class'=>'cantidad'));?>
        <?php else:?>
            <?= form_open('admin/profesores', array('class'=>'cantidad'));?>
        <?php endif;?>
            <?= form_dropdown('cantidad',$opciones,$limit,'class = input-small');?> 
            <?= form_submit(array('class'=>'btn btn-primary'),"Mostrar");?>
        <?= form_close();?>    
    </div>

    <?php if($numero == 0 && isset($busqueda)):?> 
        <div class="alert alert-error span10" id="Error">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button> 
            No se han encontrado profesores que concuerden con esos criterios.
        </div>
    <?php else:?>
        <?= form_open('admin/profesores/borrar', array('name'=> 'f1', 'id'=> 'formBorrar')); ?>
        <div>
            <?= form_submit($borrar); ?>
        </div>

        <div class="row-fluid" id="flip-scroll">
            <table class="table-hover table-bordered table-condensed cf col-md-12">
                <thead class="cf">
                    <tr>
                        <th><input type="checkbox" id="input" onclick="seleccionar_checkbox(this.checked); crear_boton(this.checked);"></th>

                        <?php foreach($fields as $field_name => $field_display): ?>
                            <?php if(isset($busqueda)):?>
                                <th>
                                     <?php if($orden == 'asc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/profesores/buscar/$field_name/desc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet"></i>'); ?>
                                        <?php else:?>    
                                            <?= anchor("admin/profesores/buscar/$field_name/desc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-order"></i>'); ?>
                                        <?php endif;?>    
                                    <?php elseif($orden == 'desc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/profesores/buscar/$field_name/asc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>'); ?>
                                        <?php else:?>    
                                            <?= anchor("admin/profesores/buscar/$field_name/asc/$elementos/$busq", $field_display . ' <i class="glyphicon glyphicon-sort-by-order-alt"></i>'); ?>
                                        <?php endif;?>    
                                    <?php else: ?>
                                        <?= anchor("admin/profesores/buscar/$field_name/" .(($orden == 'asc' && $campo == $field_name) ? 'desc' : 'asc')."/$elementos/$busq" , $field_display); ?>
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
                                            <?= anchor("admin/profesores/$field_name/desc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet"></i>'); ?>
                                        <?php else:?>    
                                            <?= anchor("admin/profesores/$field_name/desc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-order"></i>'); ?>
                                        <?php endif;?>
                                    <?php elseif($orden == 'desc' && $campo == $field_name):?>
                                        <?php if($field_name == 'Nombre' || $field_name == 'Email'):?>
                                            <?= anchor("admin/profesores/$field_name/asc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>'); ?>
                                        <?php else:?>
                                            <?= anchor("admin/profesores/$field_name/asc/$elementos", $field_display . ' <i class="glyphicon glyphicon-sort-by-order-alt"></i>'); ?>
                                        <?php endif;?>
                                    <?php else: ?>
                                        <?= anchor("admin/profesores/$field_name/" .(($orden == 'asc' && $campo == $field_name) ? 'desc' : 'asc')."/$elementos" , $field_display); ?>
                                    <?php endif;?>
                                </th>
                            <?php endif;?>    
                        <?php endforeach; ?>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($profesores)): ?>
                        <?php $aux = 0; ?>
                        <?php foreach($profesores as $profesor): ?>
                            <tr>
                                <?php  $check= array('name' => 'checkbox[]', 'checked'=> FALSE, 'value'=>$profesor->Email); ?>
                                <td><?= form_checkbox($check); ?></td>
                                <td data-title="Nombre"><?= $profesor->Nombre. ' ' . $profesor->Apellido1. ' ' .$profesor->Apellido2;?></td>
                                <td data-title="Email"><?= anchor('admin/profesor/enviar/'.urlencode($profesor->Email), $profesor->Email);?> </td>
                                <td data-title="DNI"><?= $profesor->DNI;?></td>                                
                                <td data-title="Fecha de nacimiento" class="text-center"><?= date("d-m-Y", strtotime($profesor->FechaNacimiento));?></td>
                                <td data-title="Fecha alta" class="text-center"><?= date("d-m-Y", strtotime($profesor->FechaAlta)); ?></td>
                                <td data-title="Fecha último acceso" class="text-center">
                                <?php if($profesor->FechaUltimoAcceso == NULL):?>
                                    <?= '-----';?>
                                <?php else:?>    
                                    <?= date("d-m-Y H:i:s", strtotime($profesor->FechaUltimoAcceso));?></td>
                                <?php endif;?>
                                

                                <td data-title="Opciones">
                                    <div>
                                        <a href="#myModal<?= $aux?>" data-toggle="modal"> 
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                            Otros datos
                                        </a>
                                        <div class="modal fade" id="myModal<?= $aux;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">                                            
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                        <h5 id="myModalLabel"> <?= $profesor->Nombre. ' '. $profesor->Apellido1. ' ' .$profesor->Apellido2 ; ?></h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <address>
                                                            <strong>Nº de cuenta:</strong>
                                                            <?= $profesor->NCC;?><br>
                                                            
                                                            <strong>Imparte:</strong><br>
                                                            <?php if(is_array($profesor->Imparte)):?>
                                                            <ul>
                                                                <?php foreach($profesor->Imparte as $imp):?>
                                                                <li><?= $imp;?></li>   
                                                                <?php endforeach;?>
                                                            </ul>
                                                            <?php else:?>
                                                                <?= $profesor->Imparte;?><br>
                                                            <?php endif;?>    
                                                                
                                                            <strong>Nº horas semanales:</strong><br>
                                                            <strong>Texto:</strong><br>
                                                            <?= $profesor->Texto;?>
                                                           
                                                        </address>    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="<?=base_url();?>admin/profesor/editar/<?= $profesor->Codigo;?>"> 
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Editar
                                        </a>                            
                                    </div>    
                                    <div>
                                        <a href="<?=base_url();?>admin/profesores/borrar/<?= $profesor->Codigo;?>" data-confirm="¿Desea eliminar los datos correspondientes al profesor <?= $profesor->Nombre. ' '. $profesor->Apellido1. ' ' .$profesor->Apellido2 ; ?>?"> 
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
           