<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curso_model extends CI_Model{
    
    var $Nombre = '';
    var $FechaInicio = '';
    var $FechaFin = '';
    var $N_Horas = '';
    var $Precio = '';
    var $N_Plazas = '';
    var $CodigoEstadoCurso = '';
    
    private static $db;
    
    public function __construct(){
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar(){
        $aux = FALSE;
        
        $this->Nombre = $this->input->post('nombreCurso');
        $this->FechaInicio = date('Y-m-d', strtotime($this->input->post('fechaInicio')));
        $this->FechaFin = date('Y-m-d', strtotime($this->input->post('fechaFin')));
        $this->N_Horas = $this->input->post('numeroHoras');
        $this->Precio = $this->input->post('precio');
        $this->N_Plazas = $this->input->post('plazas');
        $this->CodigoEstadoCurso = '1';
        
        if($this->db->insert('Curso', $this)){
            $aux = TRUE;
        }
        
        return $aux;
        
    }
}
