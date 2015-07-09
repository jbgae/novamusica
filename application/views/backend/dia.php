<div class="col-md-10 contenido">
    <div id ="form">
        <div class="btn-group">
            <a href="<?= base_url();?>admin/calendario" class="btn btn-default ">Mes</a>
            <a href="<?= base_url();?>admin/calendario/semana" class="btn btn-default ">Semana</a>
            <a href="<?= base_url();?>admin/calendario/dia" class="btn btn-default active">Día</a>
        </div>
    </div>
    
</div>
<div class="col-md-10">
    <?= anchor("$user/calendario/dia/$yearLess/$monthLess/$dayLess", '<< Anterior', array('class'=>'col-md-3'));?> 
    <h4 class="col-md-5"><?= $fecha;?></h4>
    <?= anchor("$user/calendario/dia/$yearAdd/$monthAdd/$dayAdd", 'Siguiente >>', array('class'=>'col-md-2'));?> 
</div>    
<?php $hora = '';?>
<?php if(empty($eventos) && empty($tareas)):?>
    <div class="col-md-10 offset3">
        <div class="span5 offset1"> No se han registrado eventos para este día</div>
    </div>
<?php elseif(!empty($eventos)):?>
    <?php foreach($eventos as $evento):?>
        <div class="span9 offset2">
            <?php if($hora != date('H:i',strtotime($evento->Fecha))):?>
                <div class="fecha"><?= date('H:i',strtotime($evento->Fecha));?></div>
            <?php endif;?>    
            <h5 class="span5 cita"><?= ucfirst($evento->Cita);?></h5>
            <div class="span5 descripcion"><?= $evento->Descripcion;?></div>
        </div>
        <?php $hora = date('H:i',strtotime($evento->Fecha));?>
    <?php endforeach;?>

<?php elseif(!empty($tareas)):?>
    <?php foreach($tareas as $tarea):?>
        <div class="span9 offset2">
            <?= $tarea;?>
        </div>    
    <?php endforeach;?>
<?php endif;?>
