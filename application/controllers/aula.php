<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aula extends MY_Controller{
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('aula_model', 'Aula');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
    }
    
    private function _validar(){
        $this->form_validation->set_rules('nombreAula', 'Nombre', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('capacidad', 'Capacidad', 'trim|required|is_natural|xss_clean');
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('min_length', '%s debe tener mínimo %s caracteres');
        $this->form_validation->set_message('is_natural', '%s debe ser numérico');
        
        return $this->form_validation->run();
    }
    
    public function registrar(){
        
        if(!$this->input->is_ajax_request()){
            redirect('404');
        }
        else{            
            if(!$this->_validar()){
                $error = json_encode(validation_errors());
                $error = str_replace('"', "", $error);
                $error = str_replace('<\/span>\n', "", $error);                 
                echo '<div class="text-error">'.$error.'</div>';
            }
            else{
                $aula = new Aula_model;
                if($aula->inicializar()){                    
                    echo '<div class="alert alert-success span9">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Éxito</h4>
                    Se ha registrado el aula correctamente.
                    </div>';
                }                
                else{
                   echo '<div class="alert alert-error span9">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Error</h4>
                    El proceso de registro no se ha realizado satisfactoriamente, por favor inténtelo de nuevo más tarde
                    </div>';
                }
            }
               
        }
    }
    
        
    public function eliminar($codigo){
                    
        if(Aula_model::existe($codigo)){
            $aux = FALSE;
            $aula = new Aula_model;
            if($aula->borrar($codigo)){
                $aux =TRUE;
            }
        }

        redirect("admin/asignatura/registrar");        
    }

    
}
?>