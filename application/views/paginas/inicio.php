<div class="content container">
    <div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            
        </ol>

        <div class="carousel-inner">
            <div class="item active">
                <img src="<?=base_url();?>images/paginas/1.jpg" alt="...">
                <div class="carousel-caption hidden-sm">
                    <span class="main" >Prueba</span>
                    <br>
                    <span class="secondary" >Esto es una prueba</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=base_url();?>images/paginas/2.jpg" alt="...">
                <div class="carousel-caption hidden-sm">
                    <span class="main" >Prueba</span>
                    <br>
                    <span class="secondary clearfix " >Esto es una prueba</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=base_url();?>images/paginas/3.jpg" alt="...">
                <div class="carousel-caption hidden-sm">
                    <span class="main" >Prueba</span>
                    <br>
                    <span class="secondary clearfix" >Esto es una prueba</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=base_url();?>images/paginas/4.jpg" alt="...">
                <div class="carousel-caption hidden-sm">
                    <span class="main" >Prueba</span>
                    <br>
                    <span class="secondary clearfix" >Esto es una prueba</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=base_url();?>images/paginas/5.jpg" alt="...">
                <div class="carousel-caption hidden-sm">
                    <span class="main" >Prueba</span>
                    <br>
                    <span class="secondary clearfix" >Esto es una prueba</span>
                </div>
            </div>
           
        </div>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

    <section>  
        <p class="center-feature-sub-content">
            Somos un centro privado de música y danza situado en Chiclana (Cádiz)
            que ofrece una amplia oferta educativa para todas 
            las edades, con una metodología flexible, lúdica y personalizada. En
            nuestro centro, se imparten clases de música y movimiento, ballet, 
            piano, guitarra clásica, guitarra eléctrica, bajo eléctrico,  violín, técnica 
            vocal – canto, lenguaje musical, armonía, análisis, etc. Contamos con un 
            gran equipo de profesores especializados en cada una de las materias
            impartidas. Visítanos y prueba nuestras clases de música y danza.
        </p>
    </section><!--//promo-->

    <div class="noticias">
        <h1 class="section-heading text-highlight"><span class="line">Últimas noticias</span></h1>     
        <div class="carousel-controls">
            <a class="prev" href="#news-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
            <a class="next" href="#news-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
        </div><!--//carousel-controls--> 
        <div class="section-content clearfix">
            <div id="news-carousel" class="news-carousel carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                    <?php if(count($noticias) >= 3):?>
                        <?php foreach($noticias as $noticia):?>
                            <div class="col-md-4 news-item">
                                <h2 class="title">
                                    <?= anchor("noticia/".$noticia->Codigo, "$noticia->Titulo");?>                                    
                                </h2>
                                <img class="thumb" src="assets/images/news/news-thumb-1.jpg"  alt="" />
                                <p>
                                    <?= $noticia->ContenidoCortado;?>
                                </p>
                                <a class="read-more" href="news-single.html">Leer más<i class="glyphicon glyphicon-chevron-right"></i></a>                
                            </div><!--//news-item-->
                        <?php endforeach;?>
                    <?php elseif(count($noticias)== 2):?>
                        <?php foreach($noticias as $noticia):?>
                            <div class="col-md-6 news-item">
                                <h2 class="title">
                                    <?= anchor("noticia/".$noticia->Codigo, "$noticia->Titulo");?>
                                </h2>
                                <img class="thumb" src="assets/images/news/news-thumb-1.jpg"  alt="" />
                                <p>
                                    <?= $noticia->ContenidoCortado;?>
                                </p>
                                <?= anchor("noticia/".$noticia->Codigo,"Leer más<i class=\"glyphicon glyphicon-chevron-right\"></i>", "class=\"read-more\"");?>                
                            </div><!--//news-item-->
                        <?php endforeach;?>
                    <?php else:?>
                        <?php foreach($noticias as $noticia):?>
                            <div class="col-md-12 news-item">
                                <h2 class="title">
                                    <?= anchor("noticia/".$noticia->Codigo, "$noticia->Titulo");?>
                                </h2>
                                <img class="thumb" src="assets/images/news/news-thumb-1.jpg"  alt="" />
                                <p>
                                    <?= $noticia->ContenidoCortado;?>
                                </p>
                                <?= anchor("noticia/".$noticia->Codigo,"Leer más<i class=\"glyphicon glyphicon-chevron-right\"></i>", "class=\"read-more\"");?>                                            
                            </div><!--//news-item-->
                        <?php endforeach;?>
                    <?php endif;?>    
                    </div><!--//item-->
                    
                                      
                    <a class="btn btn-theme btn-tema" href="events.html">Todas las noticias</a>
                </div><!--//carousel-inner-->
            </div><!--//news-carousel-->  
            
        </div><!--//section-content--> 
        
    </div><!--//noticias-->

    <div class="row cols-wrapper columnas">
        <div class="col-md-4">
            <section class="eventos">
                <h1 class="section-heading text-highlight"><span class="line">Eventos</span></h1>
                <div class="section-content">
                    <div class="event-item">
                        <p class="date-label">
                            <span class="month">FEB</span>
                            <span class="date-number">18</span>
                        </p>
                        <div class="details">
                            <h2 class="title">Open Day</h2>
                            <p class="time"><i class="glyphicon glyphicon-time"></i> 10:00am - 18:00pm</p>
                            <p class="location"><i class="glyphicon glyphicon-map-marker"></i> East Campus</p>                            
                        </div><!--//details-->
                    </div><!--event-item--> 
                    <hr>
                    <div class="event-item">
                        <p class="date-label">
                            <span class="month">SEP</span>
                            <span class="date-number">06</span>
                        </p>
                        <div class="details">
                            <h2 class="title">E-learning at College Green</h2>
                            <p class="time"><i class="glyphicon glyphicon-time"></i> 10:00am - 16:00pm</p>
                            <p class="location"><i class="glyphicon glyphicon-map-marker"></i> Learning Center</p>                            
                        </div><!--//details-->
                    </div><!--event-item-->
                    <hr>
                    <div class="event-item">
                        <p class="date-label">
                            <span class="month">JUN</span>
                            <span class="date-number">23</span>
                        </p>
                        <div class="details">
                            <h2 class="title">Career Fair</h2>
                            <p class="time"><i class="glyphicon glyphicon-time"></i> 09:45am - 16:00pm</p>
                            <p class="location"><i class="glyphicon glyphicon-map-marker"></i> Library</p>                            
                        </div><!--//details-->
                    </div><!--event-item-->
                    <hr>
                    <div class="event-item">
                        <p class="date-label">
                            <span class="month">May</span>
                            <span class="date-number">17</span>
                        </p>
                        <div class="details">
                            <h2 class="title">Science Seminar</h2>
                            <p class="time"><i class="glyphicon glyphicon-time"></i> 14:00pm - 18:00pm</p>
                            <p class="location"><i class="glyphicon glyphicon-map-marker"></i> Library</p>                            
                        </div><!--//details-->
                    </div><!--event-item-->
                    <hr>
                    <a class="btn btn-theme btn-tema" href="events.html">Todos los eventos<i class="fa fa-chevron-right"></i></a>
                </div><!--//section-content-->
            </section><!--//events-->
        </div>
        <div class="col-md-5">
            <section class="enlaces">
                <h1 class="section-heading text-highlight"><span class="line">Próximos cursos</span></h1>
                <div class="section-content">
                    <div class="curso">
                        <h2 class="title">Titulo del curso</h2>
                        <p class="fecha">Días 12, 13, 14 de Junio</p>
                        <p class="descripcion"> Aquí introducimos una pequeña descripción del curso en cuestión</p>                          
                    </div>
                    <hr>
                    <div class="curso">
                        <h2 class="title">Titulo del curso</h2>
                        <p class="fecha">Días 12, 13, 14 de Junio</p>
                        <p class="descripcion"> Aquí introducimos una pequeña descripción del curso en cuestión</p>                          
                    </div>
                    <hr>
                    <div class="curso">
                        <h2 class="title">Titulo del curso</h2>
                        <p class="fecha">Días 12, 13, 14 de Junio</p>
                        <p class="descripcion"> Aquí introducimos una pequeña descripción del curso en cuestión</p>                          
                    </div>
                    <hr>
                </div><!--//section-content--> 
                <a class="btn btn-theme btn-tema" href="events.html">Todos los cursos</a>
            </section><!--//events--> 
        </div>
        
        <div class="col-md-3">
            <section class="enlaces">
                <h1 class="section-heading text-highlight"><span class="line">Enlaces de interés</span></h1>
                <div class="section-content">
                    <p><?= anchor('login','<i class="glyphicon glyphicon-chevron-right"></i> Administración');?></p>
                    <p><?= anchor('login','<i class="glyphicon glyphicon-chevron-right"></i> Zona profesores');?></p>
                    <p><a href="#"><i class="glyphicon glyphicon-chevron-right"></i> Empleo</a></p>
                    <p><?= anchor('contacto','<i class="glyphicon glyphicon-chevron-right"></i> Contacto');?></p>
                </div><!--//section-content-->                
            </section><!--//events--> 
            
            <section class="empresas">
                <h1 class="section-heading text-highlight"><span class="line">Empresas colaboradoras</span></h1>
                <div class="section-content">
                    <a href="#"><img src="<?=base_url();?>images/paginas/emp1.jpg"></a>
                    <a href="#"><img src="<?=base_url();?>images/paginas/emp2.jpg"></a>
                    <a href="#"><img src="<?=base_url();?>images/paginas/tfap.jpeg"></a>
                </div>
                
            </section>
        </div>
    </div>
</div>
