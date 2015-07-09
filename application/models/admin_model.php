<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    static function existe($codigo){
        $aux = FALSE;
        
        $query = self::$db->get_where("Administrador", array('Codigo'=>$codigo));
        
        if($query->num_rows() > 0){
            $aux = TRUE;
        }
        
        return $aux;
        
    }
}
