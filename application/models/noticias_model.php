<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias_model extends CI_Model{
    
    var $Codigo         = '';
    var $Titulo         = ''; 
    var $Contenido      = '';
    var $FechaCreacion  = '';
    var $CodigoAdmin     = '';
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar(){
        
        $aux = FALSE;
        $this->Titulo = $this->input->post('titulo');
        $this->Contenido = $this->input->post('contenido');
        $this->FechaCreacion = date('Y-m-d H:i:s');
        $this->CodigoAdmin = $this->session->userdata('codigo');
        
        if($this->db->insert('Noticia', $this)){
            $aux = TRUE;
        }
        
        return $aux;
    }
    
    public function datos($codigo){        
        $query = $this->db->get_where('Noticia', array('Codigo'=>$codigo));
        $noticia = $query->result();
        
        $this->Titulo = $noticia[0]->Titulo;
        $this->Contenido = $noticia[0]->Contenido;
        $this->FechaCreacion = $noticia[0]->FechaCreacion;
        $this->CodigoAdmin = $noticia[0]->CodigoAdmin;
        
        return $this;            
    }
    
    public function titulo($codigo = ''){
        $aux = '';
        if($codigo != ''){
            $this->db->select('Titulo');
            $this->db->from('Noticia');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $noticia = $query->result();

            $aux = $noticia[0]->Titulo;
        }
        else{
            $aux = $this->Titulo;
        }
        
        return $aux;
    }
    
    
    public function contenido($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('Contenido');
            $this->db->from('Noticia');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $noticia = $query->result();

            $aux = $noticia[0]->Contenido;
        }
        else{
            $aux = $this->Contenido;
        }
        
        return $aux;
    }
    
    
    public function fecha($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('FechaCreacion');
            $this->db->from('Noticia');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $noticia = $query->result();

            $aux = $noticia[0]->FechaCreacion;
        }
        else{
            $aux = $this->FechaCreacion;
        }
        return $aux;
    }
    
    
    public function codigoAdmin($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('CodigoAdmin');
            $this->db->from('Noticia');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $noticia = $query->result();

            $aux = $noticia[0]->CodigoAdmin;
        }
        else{
            $aux = $this->CodigoAdmin;
        }
        return $aux;
    }
    
    /*
    public function escritor($id){
        $this->db->select('Nombre, ApellidoP, ApellidoM');
        $this->db->from('Noticias');
        $this->db->where('Codigo', $id);
        $query = $this->db->get();
        
        $noticia = $query->result();

        return $noticia[0]->Nombre . ' ' . $noticia[0]->ApellidoP . ' ' . $noticia[0]->ApellidoM;
    }
    */

    
    static function numero(){
        return self::$db->count_all('Noticia');
    }    

    
    static function obtener($campo, $orden, $offset = '', $limite = '', $cortado = FALSE) {
		
        $orden = ($orden == 'desc') ? 'desc' : 'asc';
        $sort_columns = array('Titulo', 'Contenido', 'FechaCreacion', 'Escritor');
        $campo = (in_array($campo, $sort_columns)) ? $campo : 'Titulo';

        self::$db->select('*');
        self::$db->from('Noticia');
        if($limite != ''){
            self::$db->limit($limite, $offset);
        }
        self::$db->order_by($campo, $orden);
        $query = self::$db->get();

        $noticias = $query->result();

        if($cortado){
            Noticias_model::_limitar_caracteres (50, $noticias);
        }
            
        return $noticias;
    }
    
    
    static function obtenerUltimos(){
        self::$db->select('*');
        self::$db->from('Noticia');
        self::$db->order_by('FechaCreacion', 'asc');
        self::$db->limit('3');       
       
        $query = self::$db->get();
        $noticias = $query->result();

        if(!empty($noticias)){
            foreach($noticias as $noticia){
                $noticia->Contenido = strip_tags($noticia->Contenido);
            }
            if(count($noticias) == 1){
                Noticias_model::_limitar_caracteres (90, $noticias);
            }
            elseif(count($noticias) == 2){
                Noticias_model::_limitar_caracteres (60, $noticias);
            }
            else{
                Noticias_model::_limitar_caracteres (30, $noticias);
            }
            foreach($noticias as $noticia){
                $noticia->Contenido = strip_tags($noticia->Contenido);
            }
            
        }
        
            
        return $noticias;
        
    }
    
    
    static function buscar($dato, $campo, $orden, $offset, $limite, $cortado = FALSE){
        
        self::$db-> select('*');
        self::$db-> like('Titulo', $dato);
        self::$db-> or_like('Contenido', $dato);
        self::$db-> or_like('Nombre', $dato);
        self::$db-> or_like('ApellidoP', $dato);
        self::$db-> or_like('ApellidoM', $dato);
        self::$db-> or_like('CONCAT(Nombre, " ", ApellidoP, " ", ApellidoM)', $dato);
        self::$db-> or_like('CONCAT(Nombre, " ", ApellidoP)', $dato);
        self::$db-> or_like('CONCAT(ApellidoP, " ", ApellidoM)', $dato);
        self::$db-> limit($limite, $offset);
        self::$db-> order_by($campo, $orden);
        
        $query = self::$db->get('Noticia');
        $noticias = $query->result();
        
        if($cortado){
            Noticias_model::_limitar_caracteres(30, $noticias);
        }
        
        return $noticias;
    }
    
    
    public function busqueda_cantidad($dato){
        self::$db-> select('*');
        self::$db-> like('Titulo', $dato);
        self::$db-> or_like('Contenido', $dato);
        self::$db-> or_like('Nombre', $dato);
        self::$db-> or_like('ApellidoP', $dato);
        self::$db-> or_like('ApellidoM', $dato);
        self::$db-> or_like('CONCAT(Nombre, " ", ApellidoP, " ", ApellidoM)', $dato);
        self::$db-> or_like('CONCAT(Nombre, " ", ApellidoP)', $dato);
        self::$db-> or_like('CONCAT(ApellidoP, " ", ApellidoM)', $dato);
        self::$db ->from('Noticia');
        return self::$db -> count_all_results();
    }
    
    
    public function actualizar($id){
        $aux = FALSE;
        
        $this->db->set('Titulo', $this->input->post('titulo'));
        $this->db->set('Contenido', $this->input->post('contenido'));
        $this->db->set('FechaCreacion', date('Y-m-d H:i:s'));
        $this->db->set('CodigoAdmin', $this->session->userdata('codigo'));
        
        $this->db->where('Codigo', $id);
        
        if($this->db->update('Noticia')){
            $aux = TRUE;
        }
                
        return $aux;
    }
    
    public function borrar($cod = ''){
        if ($cod == ''){
            $cod = $this->input->post('checkbox');
        }
        
        if(!is_array($cod)){
            $this->db->delete('Noticia', array('Codigo' => $cod)); 
        }
        else{
            foreach ($cod as $codigo) {
                $this->db->delete('Noticia', array('Codigo' => $codigo));
            }
        }
    }
    
    static function noticias_recientes($limit){
        self::$db->select('Titulo, FechaCreacion, EmailAdmin');
        self::$db->from('Noticia');
        self::$db->order_by("FechaCreacion", "desc");
        self::$db->limit($limit);
        $query = self::$db->get(); 
        return $query->result();
    }
    
    static function existe($codigo){
        $aux = FALSE;

        $query = self::$db->get_where("Noticia", array('Codigo'=>$codigo));             
                
        if($query->num_rows() > 0){
            $aux = TRUE;
        }
        return $aux;
    }
    
    private function _limitar_caracteres($palabras, $noticias){
        
        foreach($noticias as &$noticia){
            $aux = explode(" ", $noticia->Contenido);
            $cadena = '';
            if(count($aux) > $palabras){
                for($i = 0; $i < $palabras; $i++){
                    $cadena .= $aux[$i]. " ";
                }
                $noticia->ContenidoCortado = strip_tags($cadena);
                $noticia->ContenidoCortado .= '...';
            }
            $cadena = '';
        }
        return $noticias;
    }
    
    
}

?>