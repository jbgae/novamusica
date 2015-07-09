<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aula_model extends CI_Model{
    
    var $Nombre = '';
    var $Capacidad = '';
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar(){
        $aux = FALSE;
        
        $this->Nombre = $this->input->post('nombreAula');
        $this->Capacidad = $this->input->post('capacidad');
        
        if($this->db->insert('Aula', $this)){
            $aux = TRUE;
        }
        
        return $aux;
    }
    
    public function nombre($codigo = ''){
        $aux = '';
        if($codigo != ''){
            $this->db->select('Nombre');
            $this->db->from('Aula');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $asignatura = $query->result();

            $aux = $asignatura[0]->Nombre;
        }
        else{
            $aux = $this->Nombre;
        }
        
        return $aux;
    }
    
    static function obtener(){
        $query = self::$db->get('Aula');
        
        return $query->result();
    }
    
    static function existe($codigo){
        $aux = FALSE;
        
        $query = self::$db->get_where("Aula", array('Codigo'=>$codigo));
        
        if($query->num_rows() > 0){
            $aux = TRUE;
        }
        
        return $aux;
        
    }
    
    public function borrar($cod){
        $aux = FALSE;        
        if($this->db->delete('Aula', array('Codigo' => $cod))){
            $aux = TRUE;
        }
        return $aux;

    }
    
}

?>