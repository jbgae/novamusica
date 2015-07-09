<div class="col-md-10 contenido">
    <div>
        <?= form_open('admin/alumno/buscar', array('class'=>'pull-right')); ?>
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
            <?= form_open('admin/alumno/buscar', array('class'=>'cantidad'));?>
        <?php else:?>
            <?= form_open('admin/alumno', array('class'=>'cantidad'));?>
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
        <?= form_open('admin/alumno/borrar', array('name'=> 'f1', 'id'=> 'formBorrar')); ?>
        <div>
            <a href="#" class="btn btn-primary"> Filtrar </a>
            <a href="#" class="btn btn-primary"> Exportar </a>
            <?= form_submit($borrar); ?>
        </div>
        <div>
            
    <?php endif; ?>
</div>
