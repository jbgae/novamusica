<div class="col-md-10 contenido">
    <div>
        <?= form_open('admin/noticias/buscar', array('class'=>'pull-right')); ?>
            <?= form_input($buscador); ?>
            <?php if(isset($busqueda)):?>
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
            <?= form_open('admin/noticias/buscar/Nombre/asc/'.$elementos.'/'.$busq, array('class'=>'cantidad'));?>
        <?php else:?>
            <?= form_open('admin/noticias', array('class'=>'cantidad'));?>
        <?php endif;?>
            <?= form_dropdown('cantidad',$opciones,$limit,'class = input-small');?> 
            <?= form_submit(array('class'=>'btn btn-primary'),'Mostrar');?>
        <?= form_close();?>    
    </div>

    <?php if($numero == 0 && isset($busqueda)):?> 
        <div class="alert alert-error span10" id="Error">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button> 
            No se han encontrado noticias que concuerden con esos criterios.
        </div>
    <?php else:?>

    <?= form_open('admin/noticias/borrar', array('name'=> 'f1')); ?>
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
                                    <?= anchor("admin/noticias/buscar/$field_name/desc/$elementos/$busq", $field_display . ' <i class=" icon-chevron-up"></i>'); ?>
                                <?php elseif($orden == 'desc' && $campo == $field_name):?>
                                    <?= anchor("admin/noticias/buscar/$field_name/asc/$elementos/$busq", $field_display . ' <i class=" icon-chevron-down"></i>'); ?>
                                <?php else: ?>
                                    <?= anchor("admin/noticias/buscar/$field_name/" .(($orden == 'asc' && $campo == $field_name) ? 'desc' : 'asc')."/$elementos/$busq" , $field_display); ?>
                                <?php endif;?>
                            </th>
                        <?php else: ?>    
                            <th>
                                <?php if($orden == 'asc' && $campo == $field_name):?>
                                    <?= anchor("admin/noticias/$field_name/desc/$elementos", $field_display . ' <i class=" icon-chevron-up"></i>'); ?>
                                <?php elseif($orden == 'desc' && $campo == $field_name):?>
                                    <?= anchor("admin/noticias/$field_name/asc/$elementos", $field_display . ' <i class=" icon-chevron-down"></i>'); ?>
                                <?php else: ?>
                                    <?= anchor("admin/noticias/$field_name/" .(($orden == 'asc' && $campo == $field_name) ? 'desc' : 'asc')."/$elementos" , $field_display); ?>
                                <?php endif;?>
                            </th>
                        <?php endif;?>    
                    <?php endforeach; ?>
                    <th class="opciones">Opciones</th>
                </tr>
                </thead>
                <tbody> 
                <?php if(isset($noticias)): ?>
                    <?php foreach($noticias as $noticia): ?>
                        <tr>
                            <?php  $check= array('name' => 'checkbox[]', 'checked'=> FALSE, 'value'=>$noticia->Codigo); ?>
                            <td><?= form_checkbox($check); ?></td>
                            <td><?= $noticia->Titulo;?></td>
                            <?php if(isset($noticia->ContenidoCortado)): ?>
                                <td><?= $noticia->ContenidoCortado; ?></td>
                             <?php else:?>
                                <td><?= $noticia->Contenido; ?></td>
                            <?php endif;?>    
                            <td><?= date("d-m-Y H:i:s", strtotime($noticia->FechaCreacion)); ?></td>
                            <td><?= $noticia->Nombre; ?></td>
                            <td>
                                <div>
                                    <a href="#myModal<?= $noticia->Codigo;?>" data-toggle="modal"> 
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                        Ver
                                    </a>
                                    <div id="myModal<?=$noticia->Codigo;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                    <h5 id="myModalLabel"> <?= $noticia->Nombre; ?></h5>
                                                </div>
                                                <div class="modal-body">                                                 
                                                    <?= date("d-m-Y",strtotime($noticia->FechaCreacion));?><br>
                                                    <strong><?= $noticia->Titulo;?> </strong><br>
                                                    <?= $noticia->Contenido;?>                                                     
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a href="<?=base_url();?>admin/noticias/editar/<?= $noticia->Codigo;?>"> 
                                        <i class="glyphicon glyphicon-edit"></i>
                                        Editar
                                    </a>                            
                                </div>    
                                <div>
                                    <a href="<?=base_url();?>admin/noticias/borrar/<?= $noticia->Codigo;?>" data-confirm="Se va ha eliminar la noticia: <?= $noticia->Titulo;?>,¿Estás seguro?"> 
                                        <i class="glyphicon glyphicon-trash"></i>
                                        Borrar
                                    </a>
                                </div>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
                </tbody>
            </table>
        </div>
    <?= form_close();?>
    <?php endif;?>
    <?php if(!isset($vacio)): ?>
        <div class="text-center">
            <ul class="pagination">
                <?= $links; ?> 
            </ul>    
        </div>
    <?php endif; ?>
</div>
</div>
</body>


