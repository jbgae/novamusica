<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller{
    
    public function __construct() {
        parent:: __construct();        
        
        $this->load->library('pagination');
        $this->load->model('admin_model');       
    }
    
    public function novedades(){
        $this->pagina = 'novedades';
        $this->titulo = '';
        $this->estilo = array('backend', 'jquery.easy-pie-chart');
        $this->javascript = array('jquery.easy-pie-chart', 'pie-chart','excanvas.min','jquery.flot','jquery.flot.categories','grafica'); 

        $this->permisos('admin');
        $datos['backend'] = TRUE;
        $this->mostrar($datos);
    }
}
