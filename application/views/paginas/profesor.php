<div class="content container">
            <div class="page-wrapper">
                <?php if($existe):?>
                    <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?=$profesor->Nombre.' '.$profesor->Apellido1.' '.$profesor->Apellido2;?></h1>
                        <div class="breadcrumbs pull-right">
                            <ul class="breadcrumbs-list">
                                <li class="breadcrumbs-label">Te encuentras en:</li>
                                <li><?= anchor('inicio','Inicio <i class="glyphicon glyphicon-chevron-right"></i>');?></li> 
                                <li><?= anchor('profesores','Profesores <i class="glyphicon glyphicon-chevron-right"></i>');?></li>
                                <li class="current"><?=$profesor->Nombre.' '.$profesor->Apellido1.' '.$profesor->Apellido2;?></li>
                            </ul>
                        </div><!--//breadcrumbs-->
                    </header> 
                    <div class="page-content">
                        <div class="row page-row">
                            <div class="course-wrapper col-md-8 col-sm-7">                         
                                <article class="course-item">
                                    <?php if(!isset($imagen)):?>
                                        <p class="featured-image page-row hidden-xs"><img class="img-responsive" src="<?=base_url();?>images/paginas/images.jpeg" alt="imagen de profesor"/></p>
                                    <?php else:?>    
                                        <p class="featured-image page-row hidden-xs"><img class="img-responsive" src="<?= $imagen;?>" alt="imagen de profesor"/></p>
                                    <?php endif;?>    
                                    <div class="page-row">
                                        <?= $profesor->Texto;?>
                                    </div><!--//page-row-->                                                    
                                </article><!--//course-item-->                                              
                            </div><!--//course-wrapper-->
                <?php else:?>
                    <header class="page-heading clearfix">
                        <div class="breadcrumbs pull-right">
                            <ul class="breadcrumbs-list">
                                <li class="breadcrumbs-label">Te encuentras en:</li>
                                <li><?= anchor('inicio','Inicio <i class="glyphicon glyphicon-chevron-right"></i>');?></li> 
                                <li><?= anchor('profesores','Profesores <i class="glyphicon glyphicon-chevron-right"></i>');?></li>
                                <li class="current"><?= 'Error';?></li>
                            </ul>
                        </div><!--//breadcrumbs-->
                    </header>         
                    <div class="page-content">
                        <div class="row page-row">
                            <div class="alert alert-danger col-md-8 col-sm-7">
                                <h4>Error.</h4>
                                    <?= 'El profesor solicitado no existe.';?>
                            </div>
                <?php endif;?>            
                        <aside class="page-sidebar  col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1">     
                            <section class="widget has-divider">
                                <h3 class="title">Nuestros profesores</h3>
                                <ul class="list-unstyled">
                                    <?php foreach($profesores as $key=>$profesor):?>
                                        <li>
                                            <?= anchor('profesor/'.$key, $profesor);?>
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

