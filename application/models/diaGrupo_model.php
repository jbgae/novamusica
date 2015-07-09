<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DiaGrupo_model extends Grupo_Model{
    
    var $Dia            = '';
    var $HoraInicio     = '';
    var $HoraFin        = '';
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar($datos){
        $aux = FALSE;
        
        if($this->db->insert('DiasGrupo', $datos)){
            $aux = TRUE;
        }
        
        return $aux;    
        
    }
}