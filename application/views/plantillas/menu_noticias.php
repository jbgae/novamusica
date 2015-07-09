<div id="main-menu"  class="col-md-10">        
    <ul class="nav nav-pills">
        <?php if($this->uri->segment(3) == 'crear'): ?>
            <li class="" id="primero">
                <?= anchor('admin/noticias', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="active">
                <?= anchor('admin/noticias/crear', '<i class="glyphicon glyphicon-plus"></i> Crear noticia');?>
            </li>          
        <?php elseif($this->uri->segment(3) =='editar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/noticias', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/noticias/crear', '<i class="glyphicon glyphicon-plus"></i> Crear noticia', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="icon-edit"></i> Editar noticia</a>
            </li>
         <?php elseif($this->uri->segment(3) =='buscar'):?> 
            <li class="" id="primero">
                <?= anchor('admin/noticias', '<i class="glyphicon glyphicon-th-list"></i> Listado', array('accesskey'=>'-'));?>
            </li>
            <li class="" >
                <?= anchor('admin/noticias/crear', '<i class="glyphicon glyphicon-plus"></i> Crear noticia', array('accesskey'=>'+'));?>
            </li>
            <li class="active">
                <a href="" class="disabled"><i class="icon-search"></i> Buscar noticia</a>
            </li>
        <?php else: ?>
             <li class="active" id="primero">
                <?= anchor('admin/noticias', '<i class="glyphicon glyphicon-th-list"></i> Listado');?>
            </li>
            <li class="" >
                <?= anchor('admin/noticias/crear', '<i class="glyphicon glyphicon-plus"></i> Crear noticia', array('accesskey'=>'+'));?>
            </li>
        <?php endif;?>
    </ul>
</div> 
