<header>

    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">               
                <?= anchor("inicio", "Novamusica", array("class" => "navbar-brand"));?>
            </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">                                
                    <span class="label label-success"><i class="glyphicon glyphicon-envelope"></i> 4 </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Tienes 4 mensajes</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="<?= base_url();?>images/paginas/images.jpeg" class="img-circle" alt="imagen usuario">
                                    </div>
                                    <h4>
                                        Cabecera mensaje
                                        <small><i class="glyphicon glyphicon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Cuerpo mensaje cortado</p>
                                </a>
                            </li><!-- end message -->
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="<?= base_url();?>images/paginas/images.jpeg" class="img-circle" alt="imagen usuario">
                                    </div>
                                    <h4>
                                        Cabecera mensaje
                                        <small><i class="glyphicon glyphicon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Cuerpo mensaje cortado</p>
                                </a>
                            </li><!-- end message -->
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="<?= base_url();?>images/paginas/images.jpeg" class="img-circle" alt="imagen usuario">
                                    </div>
                                    <h4>
                                        Cabecera mensaje
                                        <small><i class="glyphicon glyphicon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Cuerpo mensaje cortado</p>
                                </a>
                            </li><!-- end message -->
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="<?= base_url();?>images/paginas/images.jpeg" class="img-circle" alt="imagen usuario">
                                    </div>
                                    <h4>
                                        Cabecera mensaje
                                        <small><i class="glyphicon glyphicon-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Cuerpo mensaje cortado</p>
                                </a>
                            </li><!-- end message -->

                        </ul>
                    </li>
                    <li class="footer"><a href="#">Ver todos los mensajes</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?= $nombre;?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">  
                    <?php if($this->session->userdata('usuario') == 'admin'):?>  
                        <li><?= anchor('admin/datos', '<i class="glyphicon glyphicon-user"></i> Mis datos');?></li>
                    <?php else:?>
                        <li><?= anchor('profesor/datos', '<i class="glyphicon glyphicon-user"></i> Mis datos');?></li>
                    <?php endif;?>    
                    <li><?= anchor('admin/mensaje', '<i class="glyphicon glyphicon-comment"></i> Enviar mensaje');?></li>
                    <li><?= anchor('admin/email', '<i class="glyphicon glyphicon-envelope"></i> Enviar email');?></li>
                    <li class="divider"></li>
                    <li><?= anchor('admin/cerrar', '<i class="glyphicon glyphicon-off"></i> Cerrar sesión', array('data-confirm'=>"Va a abandonar la sesión,¿Estás seguro?"));?></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>          
</header>