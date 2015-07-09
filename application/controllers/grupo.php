<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo extends MY_Controller{
    
    public function __construct() {
        parent:: __construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('grupo_model', 'Grupo');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
    }
    
    private function _validar(){
        $this->form_validation->set_rules('NombreGrupo', 'Nombre', 'trim|required|min_length[3]|xss_clean');
        $diasSemanas = $this->input->post('diaSemana');
        $horasInicio = $this->input->post('HoraInicio');
        $horasFin = $this->input->post('HoraFin');
        
        if(is_array($diasSemanas)){
            foreach($diasSemanas as $key=>$diaSemana){
                $this->form_validation->set_rules("diaSemana[$key]", "Dia de la semana", 'trim|required|xss_clean');
            }
        }
        else{
            $this->form_validation->set_rules("diaSemana", "Dia de la semana", 'trim|required|xss_clean');
        }
        
        if(is_array($horasInicio)){
            foreach($horasInicio as $key=>$horaInicio){
                $this->form_validation->set_rules("HoraInicio[$key]", "Hora de inicio", 'trim|required|xss_clean|callback_hora');
            }
        }
        else{
            $this->form_validation->set_rules("HoraInicio", "Hora de inicio", 'trim|required|xss_clean|callback_hora');
        }
        
        if(is_array($horasFin)){
            foreach($horasFin as $key=>$horaFin){
                $this->form_validation->set_rules("HoraFin[$key]", "Hora fin", 'trim|required|xss_clean|callback_hora');
            }
        }
        else{
            $this->form_validation->set_rules("HoraFin", "Hora fin", 'trim|required|xss_clean|callback_hora');    
        }
        
        
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('min_length', '%s debe tener al menos %s caracteres');
        $this->form_validation->set_message('xss_clean', ' %s no es válido');
        
        return $this->form_validation->run(); 
    } 
    
    public function hora($str){        
        $aux = FALSE;
        
        if (strpos($str, ":") !== FALSE){
            list($hh, $mm) = explode(":", $str);

            if (!is_numeric($hh) || !is_numeric($mm)){
                $this->form_validation->set_message('hora', 'no es numerico');
            }
            else if ((int) $hh > 24 || (int) $mm > 59){
                $this->form_validation->set_message('hora', 'La hora es inválida');
            }   
            else if (mktime((int) $hh, (int) $mm) === FALSE){
                $this->form_validation->set_message('hora', 'La hora es inválida');
            }
            else{
                $aux = TRUE;
            }
        }
        else{
            $this->form_validation->set_message('hora', 'El formato no es correcto');
        }

        return $aux;       
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
                $error = str_replace('<\/div>\n', "", $error);                 
                echo '<div class="text-error">'.$error.'</div>';
            }
            else{
                $grupo = new Grupo_model;
                
                if($grupo->inicializar()){
                    echo '<div class="alert alert-success span9">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Éxito</h4>
                    Se ha registrado el grupo correctamente.
                    </div>';
                }
                else{
                   echo '<div class="alert alert-danger span9">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Error</h4>
                    El proceso de registro no se ha realizado satisfactoriamente, 
                    por favor inténtelo de nuevo más tarde.
                    </div>';
                } 
            }
        }
        
    }
}
