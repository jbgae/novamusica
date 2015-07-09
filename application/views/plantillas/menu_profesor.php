<div id="main-menu"  class="col-md-10">        
    <ul class="nav nav-pills">
        <?php if($this->uri->segment(3) == 'registrar'): ?>
            <li class="" id="primero">
                <?= anchor('admin/profesores', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="active">
                <?= anchor('admin/profesor/registrar', '<i class="glyphicon glyphicon-plus"></i> Crear profesor');?>
            </li>          
        <?php elseif($this->uri->segment(3) =='editar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/profesores', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/profesor/registrar', '<i class="glyphicon glyphicon-plus"></i> Crear profesor', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="glyphicon glyphicon-edit"></i> Editar profesor</a>
            </li>
         <?php elseif($this->uri->segment(3) =='buscar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/profesores', '<i class="glyphicon glyphicon-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/profesor/registrar', '<i class="glyphicon glyphicon-plus"></i> Registrar profesor', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="glyphicon glyphicon-search"></i> Buscar profesor</a>
            </li>
        <?php elseif($this->uri->segment(3) =='enviar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/profesores', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/profesor/registrar', '<i class="glyphicon glyphicon-plus"></i> Crear profesor', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="glyphicon glyphicon-envelope"></i> Enviar email</a>
            </li>    
        <?php else: ?>
             <li class="active" id="primero">
                <?= anchor('admin/profesores', '<i class="glyphicon glyphicon-th-list"></i> Listado');?>
            </li>
            <li class="" >
                <?= anchor('admin/profesor/registrar', '<i class="glyphicon glyphicon-plus"></i> Crear profesor', array('accesskey'=>'+'));?>
            </li>
        <?php endif;?>
    </ul>
</div> 