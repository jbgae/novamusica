<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumno_model extends CI_Model{
    
    var $NumeroMatricula    = '';
    var $Nombre             = '';
    var $Apellido1          = '';
    var $Apellido2          = '';
    var $DNI                = '';
    var $Email              = '';
    var $Direccion          = '';
    var $CodigoPostal       = '';
    var $Ciudad             = '';
    var $Provincia          = '';
    var $CCC                = '';
    var $CodigoImagen       = '';
    var $Estado             = '';
    var $AutorizacionFoto   = '';
    var $AutorizacionSalida = '';
    var $Telefono           = '';
    var $Movil              = '';
    var $CodigoFamiliar     = '';
    var $CodigoTutor        = '';
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicialiar($datos = ''){
        $aux = FALSE;
        
        if(is_array($datos)){
            
        }
        else{
            $this->NumeroMatricula    = $this->input->post('numeroMatricula');
            $this->Nombre             = $this->input->post('nombre');
            $this->Apellido1          = $this->input->post('apellido1');
            $this->Apellido2          = $this->input->post('apellido2');
            $this->DNI                = $this->input->post('dni');
            $this->Email              = $this->input->post('email');
            $this->Direccion          = $this->input->post('direccion');
            $this->CodigoPostal       = $this->input->post('codigoPostal');
            $this->Ciudad             = $this->input->post('ciudad');
            $this->Provincia          = $this->input->post('provincia');
            $this->CCC                = $this->input->post('ccc');
            $this->CodigoImagen       = $datos;
            $this->Estado             = $this->input->post('estado');
            $this->AutorizacionFoto   = $this->input->post('autFoto');
            $this->AutorizacionSalida = $this->input->post('autSalida');
            $this->Telefono           = $this->input->post('telefono');
            $this->Movil              = $this->input->post('movil');
            $this->CodigoFamiliar     = $this->input->post('codFamiliar');
            $this->CodigoTutor        = $this->input->post('codTutor');
        }
        
    }
    
    
    
    static function numero(){
        return self::$db->count_all('Alumno'); 
    }
    
}
?>