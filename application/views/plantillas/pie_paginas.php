  <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-3 col-sm-4 about">
                        <div class="footer-col-inner">
                            <h3>Sobre nosotros</h3>
                            <ul>
                                <li><?= anchor("contacto", "<i class=\"glyphicon glyphicon-chevron-right\"></i> Contacto");?></li>
                                <li><?= anchor("politica", "<i class=\"glyphicon glyphicon-chevron-right\"></i> Política de privacidad");?></li>
                                <li><?= anchor("accesibilidad", "<i class=\"glyphicon glyphicon-chevron-right\"></i> Accesibilidad");?></li>
                                <li><?= anchor("mapa", "<i class=\"glyphicon glyphicon-chevron-right\"></i> Mapa web");?></li>
                            </ul>
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->
                    <div class="footer-col col-md-6 col-sm-8 newsletter">
                        <div class="footer-col-inner">
                            <h3>Suscríbase</h3>
                            <p>Si desea que le envíemos las últimas noticias, suscríbase</p>
                            <form class="subscribe-form">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Introduzca su email" />
                                </div>
                                <input class="btn btn-theme btn-subscribe" type="submit" value="Enviar">
                            </form>

                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col--> 
                    <div class="footer-col col-md-3 col-sm-12 contact">
                        <div class="footer-col-inner">
                            <h3>Contacto</h3>
                            <div class="row">
                                <p class="adr clearfix col-md-12 col-sm-4">
                                    <i class="glyphicon glyphicon-map-marker pull-left"></i>        
                                    <span class="adr-group pull-left">       
                                        <span class="street-address"> Calle Hormaza nº 5</span><br>
                                        <span class="region"> Chiclana de la Frontera (Cádiz)</span><br>
                                        <span class="postal-code"> 11130</span><br>

                                    </span>
                                </p>
                                <p class="tel col-md-12 col-sm-4"><i class="glyphicon glyphicon-earphone"></i> 856152635</p>
                                <p class="email col-md-12 col-sm-4"><i class="glyphicon glyphicon-envelope"></i> <a href="#">info@novamusica.es</a></p>  
                            </div> 
                        </div><!--//footer-col-inner-->            
                    </div><!--//foooter-col-->   
                </div>   
            </div>        
        </div><!--//footer-content-->
       
    </footer><!--//footer-->
  </div>
  </body>
  </html>