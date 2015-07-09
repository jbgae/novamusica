<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends MY_Controller{
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('noticias_model', 'Noticias');
        $this->load->model('paginas_model', 'Paginas');
    }
    
    public function inicio(){ 
        $this->pagina = 'inicio';
        $this->titulo = $this->pagina;
        $this->estilo = array($this->pagina, 'general_paginas');
        $this->javascript = '';
        
        $datos['noticias'] = Noticias_model::obtenerUltimos();
        
       //$this->output->cache(20);
        $this->mostrar($datos); 
    }
    
    public function contacto(){
        $this->pagina = 'contacto';
        $this->titulo = $this->pagina;
        $this->estilo = array($this->pagina, 'general_paginas');
        $this->javascript = '';

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <h4>Error</h4>', '</div>');
        
        $datos['formulario'] = array(
            'nombre' => array(
                'label'=>array('accesskey'=>'B', 'name'=>'Nom<u>b</u>re'),
                'input'=>array('class' => 'nombre','id'=>'nombre', 'name' => 'nombre', 'maxlength' => '30', 'size' => '20', 'autofocus'=>'autofocus')
            ),
            'email' =>array(
                'label'=>array('accesskey'=>'E', 'name'=>'<u>E</u>mail'),
                'input'=>array('class' => 'email','id'=>'email', 'name' => 'email', 'maxlength' => '30', 'size' => '20')
            ),               
            'asunto' => array(
                'label'=>array('accesskey'=>'A', 'name'=>'<u>A</u>sunto'),
                'input'=>array('class' => 'asunto','id'=>'asunto', 'name' => 'asunto', 'maxlength' => '30', 'size' => '20')
            ),
            'comentario' => array(
                'label'=>array('accesskey'=>'M', 'name'=>'Co<u>m</u>entario'),
                'input'=>array('class' => 'comentario','id'=>'comentario', 'name' => 'comentario', 'maxlength' => '300')
            ),
            'politica' => array(
                'label'=>array('accesskey'=>'*', 'name'=>'He leído y acepto la <a href= "'.base_url().'politica" title="Aviso de la política de privacidad"> Política de privacidad (<u>*</u>)</a>'),
                'input'=>array('class' => 'politica','id'=>'politica', 'name' => 'politica', 'value'=>'acepted')
            )
                
        );
        $datos['boton'] = array('class'=>'btn btn-theme' ,'name' => 'button', 'id' => 'boton_contacto', 'value' => 'Enviar');
        
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('asunto', 'Asunto', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('politica', 'Política de privacidad', 'trim|required');
        
        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
        $this->form_validation->set_message('min_legth', 'El campo %s debe tener mínmo 3 caracteres');
        $this->form_validation->set_message('valid_email', 'El campo %s no es válido');
        $this->form_validation->set_message('xss_clean', 'El campo %s no es válido');
        
        
        if($this->form_validation->run() == TRUE){

            $datosEmail = array(
                            'direccion' => strtolower($_POST['email']),
                            'nombre'    => ucwords(strtolower($_POST['nombre'])),
                            'asunto'    => ucwords(strtolower("Mensaje desde la aplicación web: " . $_POST['asunto'])),
                            'texto'     => $_POST['comentario'],
                            'destino'   => ''
                          );
           
            if($this->my_phpmailer->Enviar($datosEmail)){                                
                $datos['mensaje'] = '<div class="alert alert-success span9">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Éxito</h4>
                    El mensaje ha sido enviado correctamente. En breve nos pondremos en contacto con usted.
                    </div>';
            }
            else{
                $datos['mensaje'] = '<div class="alert alert-error span9">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Error</h4>
                    No se ha podido enviar el comentario  en este momento, por favor inténtelo de nuevo 
                    más tarde
                    </div>';
            }            
        }
        
        //$this->output->cache(20);
        $this->mostrar($datos);
    }
    
    public function politica(){
        $this->pagina = 'politica';
        $this->titulo = 'política de privacidad';        
        $this->estilo = array($this->pagina, 'general_paginas');
        $this->javascript = '';
        
        $text = new Paginas_model;
        $datos['texto'] = $text->texto('1');
        
        $this->output->cache(20);
        $this->mostrar($datos);
    }
}

?>