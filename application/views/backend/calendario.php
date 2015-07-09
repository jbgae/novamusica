<div class="col-md-10 contenido">
    <div id ="form">
        <div class="btn-group">
            <a href="<?= base_url();?>admin/calendario" class="btn btn-default active">Mes</a>
            <a href="<?= base_url();?>admin/calendario/semana" class="btn btn-default">Semana</a>
            <a href="<?= base_url();?>admin/calendario/dia" class="btn btn-default">Día</a>
        </div>
    </div> 
    <div class="hidden-sm hidden-xs">
        <?= $calendario;?>
    </div>
</div>
