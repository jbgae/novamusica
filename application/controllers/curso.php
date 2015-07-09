<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curso extends MY_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('curso_model', 'Curso');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
    }
    
    private function _validar(){
        
        
    }
    
    public function registrar(){        
        $this->permisos('admin');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        $this->pagina = 'registrar curso';
        $this->carpeta = 'administrador';
        $this->titulo = 'Crear curso';
        $this->estilo = array('formulario','noticia','backend','jquery-te-1.3.3');
        $this->javascript = array('jquery.validate.min','validarNoticia','editor', 'jquery-te-1.3.3.min','validarNoticia');
        $this->menu = 'menu_noticias';
        
        $datos['backend'] = TRUE;
        $datos['formulario'] = array(
            'titulo' => array('class'=>'input-xlarge', 'id'=> 'titulo' ,'name'=>'titulo', 'label' => 'titulo', 'maxlength'=> '150', 'size'=>'65', 'type' => 'text', 'value' => $this->input->post('titulo'), 'autofocus'=> 'autofocus'),
            'contenido' => array('class' => 'editor', 'id' => 'contenido', 'name'=>'contenido', 'label' => 'contenido', 'value' => $this->input->post('contenido'))
        );
        
        $datos['boton'] = array( 'class'=> 'btn btn-primary', 'name'=>'button', 'id' => 'boton_noticia');
   
        if($error != ''){
            $datos['error'] = "<h4>Error.</h4> Actualmente no existe ninguna noticia.
                Si lo desea puede empezar a registrar noticias";
        } 
        
        if($this->_validarNoticia()){
            $noticia = new Noticias_model;
            if($noticia->inicializar()){
               $datos['valido'] = 'La noticia ha sido registrada satisfactoriamente.';               
            }
            else{
                $datos['error'] = 'No se ha podido registrar la noticia, por favor inténtelo de nuevo más tarde';
            } 
        }

        $this->mostrar($datos);
    }
}
