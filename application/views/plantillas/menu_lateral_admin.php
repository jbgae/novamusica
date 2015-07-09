
<div class="container">
    <div class="row">
        <div class="col-md-2 left-sidebar">            
            <nav class="main-nav ">            
                <ul class="nav nav-pills nav-stacked">  
                    <?php if($this->uri->segment(2) == 'novedades'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li>
                    <?php endif;?>    
                        <?= anchor("admin/novedades", '<i class="glyphicon glyphicon-dashboard"></i> Dashboard');?>
                    </li>           

                    <?php if($this->uri->segment(2) == 'calendario'): ?> 
                    <li class="active">               
                    <?php else:?> 
                    <li>
                    <?php endif;?>    
                        <?= anchor("admin/calendario/", '<i class="glyphicon glyphicon-calendar"></i> Calendario')?>
                    </li>
                    <?php if($this->uri->segment(2) == 'profesor' || $this->uri->segment(2) == 'profesores'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li>
                    <?php endif;?> 
                        <?= anchor("admin/profesores", '<i class="glyphicon glyphicon-user"></i> Profesores')?>
                    </li>


                    <?php if($this->uri->segment(2) == 'alumno'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li>
                    <?php endif;?>
                        <?= anchor('admin/alumno', '<i class="glyphicon glyphicon-user"></i> Alumnos')?>
                    </li>

                    <?php if($this->uri->segment(2) == 'asignatura' || $this->uri->segment(2) == 'asignaturas'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li>
                    <?php endif;?>
                        <?= anchor('admin/asignaturas', '<i class="glyphicon glyphicon-music"></i> Clases')?>
                    </li>


                    <?php if($this->uri->segment(2) == 'curso'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li>
                    <?php endif;?>
                        <?= anchor('admin/clientes', '<i class="glyphicon glyphicon-book"></i> Cursos')?>
                    </li>

                    <?php if($this->uri->segment(2) == 'evento'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li>
                    <?php endif;?>
                        <?= anchor('admin/clientes', '<i class="glyphicon glyphicon-bookmark"></i> Eventos')?>
                    </li> 




                    <?php if($this->uri->segment(2) == 'noticias'): ?> 
                    <li class="active">               
                    <?php else:?>
                    <li class="">
                    <?php endif;?>
                        <?= anchor('admin/noticias', '<i class="glyphicon glyphicon-edit"></i> Noticias')?>
                    </li>          

                    <?php if($this->uri->segment(2) == 'web'): ?>
                        <li class="active ">
                    <?php else:?>
                        <li class="">
                    <?php endif;?>
                        <?= anchor('admin/web', '<i class="glyphicon glyphicon-list-alt"></i> Páginas web')?>
                    </li> 



                </ul>
            </nav>
            <?php if($this->uri->segment('2') != 'calendario'):?>
                <div class="hidden-sm hidden-xs">
                    <?= $calendar;?>
                </div> 
            <?php endif;?>
        </div>
    



