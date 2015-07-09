
    <header class="header">
        <div class="top-bar">
            <div class="container">
                <ul class="social-icons col-md-6 col-sm-6 col-xs-12 hidden-xs">
                    <li>
                        <a href="https://twitter.com/novamusica_es" target="_blank">
                            <img src="<?=base_url();?>/images/twitter1.png">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/novamusica.es" target="_blank">
                            <img src="<?=base_url();?>/images/facebook1.png" alt="facebook">
                        </a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/108971737282172416912/about" target="_blank">
                            <img src="<?=base_url();?>/images/google.png" alt="facebook">
                        </a>
                    </li>
                </ul>
                <form class="pull-right search-form" role="search">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Buscar en el sitio...">
                    </div>
                    <button class="btn btn-theme" type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <div class="header-main container">
            <h1 class="logo col-md-4 col-sm-4">
                <?= anchor("inicio",'<img id="logo" alt="Logo" src="'. base_url().'images/logo.png">');?>
                
            </h1>
            
            <div class="info col-md-8 col-sm-8">                   
                <ul class="menu-top navbar-right hidden-xs">
                    <li class="divider">
                        <?php if($usuario == 'profesor'):?>
                            <?= anchor('profesor/inicio', "<i class=\"glyphicon glyphicon-user\"></i> ".$nombre, array('accesskey'=>'K', "title"=>"Página de inicio de sesión de usuario"));?>
                       <?php elseif($usuario == 'admin'):?>
                            <?= anchor('admin/novedades', "<i class=\"glyphicon glyphicon-user\"></i> ".$nombre, array('accesskey'=>'K', "title"=>"Página de inicio de sesión de usuario"));?>
                        <?php endif;?>
                    </li> 
                    <li class="divider">
                        <?=anchor("inicio","<i class=\"glyphicon glyphicon-home\"></i> Inicio");?>
                    </li>
                    <li class="divider">
                        <a href="faq.html"><i class="glyphicon glyphicon-question-sign"></i> Preguntas Frecuentes</a>
                    </li>
                    <li>
                        <?= anchor("contacto","<i class=\"glyphicon glyphicon-comment\"></i> Contacto");?> 
                    </li>
                    <?php if(isset($nombre)):?>
                           
                <?php endif;?>
                </ul>
                <br>
                <div class="contact pull-right">
                    <p class="hidden-md hidden-lg hidden-sm">
                        <?php if($usuario == 'profesor'):?>
                            <?= anchor('profesor/inicio', "<i class=\"glyphicon glyphicon-user\"></i> ". $nombre, array('accesskey'=>'K', "title"=>"Página de inicio de sesión de usuario"));?>
                       <?php elseif($usuario == 'admin'):?>
                            <?= anchor('admin/novedades',"<i class=\"glyphicon glyphicon-user\"></i> ". $nombre, array('accesskey'=>'K', "title"=>"Página de inicio de sesión de usuario"));?>
                        <?php endif;?>
                    </p> 
                    <p class="phone">
                        <i class="glyphicon glyphicon-earphone"></i>
                        Llámanos al 856152635
                    </p>
                    <p class="email">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <a href="#">info@novamusica.es</a>
                    </p>
                </div>
            </div>
        </div>
    </header>
    
    <nav class="main-nav" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-target="#navbar-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar-collapse" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if($this->uri->segment('1') == '' || $this->uri->segment('1') == 'inicio'):?>
                        <li class="active nav-item">
                    <?php else:?>        
                        <li class="nav-item">
                    <?php endif;?>        
                        <?= anchor("inicio","Inicio");?> 
                    </li>
                    
                    <?php if($this->uri->segment('1') == 'clases'):?>
                        <li class="active nav-item dropdown">
                    <?php else:?>        
                        <li class="nav-item dropdown">
                    <?php endif;?>         
                        <a class="dropdown-toggle" href="#" data-close-others="false" data-delay="0" data-hover="dropdown" data-toggle="dropdown">
                            Clases
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($asignaturas as $key=>$asignatura):?>
                                <li>
                                    <?= anchor('clase/'.$key, $asignatura);?>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    
                    <?php if($this->uri->segment('1') == 'profesor'):?>
                        <li class="active nav-item dropdown">
                    <?php else:?>        
                        <li class="nav-item dropdown">
                    <?php endif;?> 
                        <a class="dropdown-toggle" href="#" data-close-others="false" data-delay="0" data-hover="dropdown" data-toggle="dropdown">
                            Profesorado
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($profesores as $key=>$profesor):?>
                                <li>
                                    <?= anchor('profesor/'.$key, $profesor);?>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    
                    <?php if($this->uri->segment('1') == 'noticias' ||$this->uri->segment('1') == 'noticia'):?>
                        <li class="active nav-item">
                    <?php else:?>        
                        <li class="nav-item">
                    <?php endif;?> 
                        <?= anchor('noticias','Noticias');?>
                    </li>
                    
                    <?php if($this->uri->segment('1') == 'eventos' ||$this->uri->segment('1') == 'evento'):?>
                        <li class="active nav-item">
                    <?php else:?>        
                        <li class="nav-item">
                    <?php endif;?> 
                        <?= anchor('eventos','Eventos');?>
                    </li>
                    
                    
                    <?php if($this->uri->segment('1') == 'cursos' ||$this->uri->segment('1') == 'curso'):?>
                        <li class="active nav-item">
                    <?php else:?>        
                        <li class="nav-item">
                    <?php endif;?> 
                        <?= anchor('cursos','Cursos');?>                        
                    </li>
                    
                    <?php if($this->uri->segment('1') == 'contacto'):?>
                        <li class="active nav-item">
                    <?php else:?>        
                        <li class="nav-item">
                    <?php endif;?>
                        <?= anchor("contacto","Contacto");?> 
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    