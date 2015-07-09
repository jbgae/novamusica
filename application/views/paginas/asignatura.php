<div class="content container">
            <div class="page-wrapper">
                <?php if($existe):?>
                    <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?=$asignatura->Nombre;?></h1>
                        <div class="breadcrumbs pull-right">
                            <ul class="breadcrumbs-list">
                                <li class="breadcrumbs-label">Te encuentras en:</li>
                                <li><?= anchor('inicio','Inicio <i class="glyphicon glyphicon-chevron-right"></i>');?></li> 
                                <li><?= anchor('asignaturas','Clases <i class="glyphicon glyphicon-chevron-right"></i>');?></li>
                                <li class="current"><?=$asignatura->Nombre;?></li>
                            </ul>
                        </div><!--//breadcrumbs-->
                    </header> 
                    <div class="page-content">
                        <div class="row page-row">
                            <div class="course-wrapper col-md-8 col-sm-7">                         
                                <article class="course-item">
                                    <div class="page-row">
                                        <?= $asignatura->Descripcion;?>
                                    </div><!--//page-row-->                                                    
                                </article><!--//course-item-->
                                <?php if(isset($grupos)):?>
                                    <div>
                                        <h4>Grupos disponibles:</h4>
                                    </div>
                                <?php endif;?>
                            </div><!--//course-wrapper-->
                            
                                
                            
                <?php else:?>
                    <header class="page-heading clearfix">
                        <div class="breadcrumbs pull-right">
                            <ul class="breadcrumbs-list">
                                <li class="breadcrumbs-label">Te encuentras en:</li>
                                <li><?= anchor('inicio','Inicio <i class="glyphicon glyphicon-chevron-right"></i>');?></li> 
                                <li><?= anchor('asignaturas','Asignaturas <i class="glyphicon glyphicon-chevron-right"></i>');?></li>
                                <li class="current"><?= 'Error';?></li>
                            </ul>
                        </div><!--//breadcrumbs-->
                    </header>         
                    <div class="page-content">
                        <div class="row page-row">
                            <div class="alert alert-danger col-md-8 col-sm-7">
                                <h4>Error.</h4>
                                    <?= 'La asignatura solicitada no existe.';?>
                            </div>
                <?php endif;?>            
                        <aside class="page-sidebar  col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1">     
                            <section class="widget has-divider">
                                <h3 class="title">Nuestras clases</h3>
                                <ul class="list-unstyled">
                                    <?php foreach($asignaturas as $key=>$asignatura):?>
                                        <li>
                                            <?= anchor('clase/'.$key, $asignatura);?>
                                        </li>
                                    <?php endforeach;?>                                    
                                </ul>
                            </section><!--//widget-->                            
                        </aside>
                    </div><!--//page-row-->
                </div><!--//page-content-->
            </div><!--//page--> 
        </div><!--//content-->
    </div><!--//wrapper-->

