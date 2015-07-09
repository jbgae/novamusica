<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas_model extends CI_Model{
      
    var $Nombre = '';
    var $Contenido = '';
    
    private static $db;
    
    public function __construct() {
        parent::__construct();        
        self::$db = &get_instance()->db;
    }
        
     
    public function texto($id){
        $texto = '';
        
        $this->db->select('*');
        $this->db->from('Pagina');
        $this->db->where('Codigo', $id);
        $query = $this->db->get();       
        
        if($query->num_rows() > 0){
            if($query->num_rows() == 1){
                $text = $query->result();
                $texto = $text['0']->Contenido;
            }
            else{
                $texto = array();
                foreach($query->result() as $text){
                    $texto[$text->Posicion] = $text->Contenido;
                }
            }    
        }
        return $texto;
    }
    
    
}
?>
