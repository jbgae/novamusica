<div id="main-menu"  class="col-md-10">        
    <ul class="nav nav-pills">
        <?php if($this->uri->segment(3) == 'registrar'): ?>
            <li class="" id="primero">
                <?= anchor('admin/asignaturas', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="active">
                <?= anchor('admin/asignatura/registrar', '<i class="glyphicon glyphicon-plus"></i> Registrar clase');?>
            </li>          
        <?php elseif($this->uri->segment(3) =='editar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/asignaturas', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/asignatura/registrar', '<i class="glyphicon glyphicon-plus"></i> Registrar clase', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="glyphicon glyphicon-edit"></i> Editar clase</a>
            </li>
         <?php elseif($this->uri->segment(3) =='buscar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/asignaturas', '<i class="glyphicon glyphicon-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/asignatura/registrar', '<i class="glyphicon glyphicon-plus"></i> Registrar clase', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="glyphicon glyphicon-search"></i> Buscar asignatura</a>
            </li>
        <?php elseif($this->uri->segment(3) =='informacion'): ?>
             <li class="" id="primero">
                <?= anchor('admin/asignaturas', '<i class="glyphicon glyphicon-th-list"></i> Listado');?>
            </li>
            <li class="" >
                <?= anchor('admin/asignatura/registrar', '<i class="glyphicon glyphicon-plus"></i> Registrar clase', array('accesskey'=>'+'));?>
            </li>
        <?php else: ?>
             <li class="active" id="primero">
                <?= anchor('admin/asignaturas', '<i class="glyphicon glyphicon-th-list"></i> Listado');?>
            </li>
            <li class="" >
                <?= anchor('admin/asignatura/registrar', '<i class="glyphicon glyphicon-plus"></i> Registrar clase', array('accesskey'=>'+'));?>
            </li>
        <?php endif;?>
    </ul>
</div> 