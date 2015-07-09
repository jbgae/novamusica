<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura_model extends CI_Model{
    
    var $Codigo       = '';
    var $Nombre       = ''; 
    var $Precio       = '';
    var $Descripcion  = '';
    var $CodigoAula   = '';  
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar(){
        
        $aux = FALSE;
        $this->Nombre = $this->input->post('nombre');
        $this->Precio = $this->input->post('precio');
        $this->Descripcion = $this->input->post('texto');
        $this->CodigoAula = $this->input->post('aula');
        
        if($this->db->insert('Asignatura', $this)){
            $aux = TRUE;
        }
        
        return $aux;
    }
    
    public function actualizar($codigo){
        $aux = FALSE;
        
        $datos = array(
                'Nombre' => $this->input->post('nombre'),
                'Precio' => $this->input->post('precio'),
                'Descripcion' => $this->input->post('texto'),
                'CodigoAula' =>  $this->input->post('aula')
        );
            
        if($this->db->update('Asignatura', $datos, array('Codigo'=> $codigo))){
            $aux = TRUE;
        }
        
       
        return $aux;
    }
    
    public function datos($codigo){        
        $query = $this->db->get_where('Asignatura', array('Codigo'=>$codigo));
        $asignatura = $query->result();
        
        $this->Codigo = $codigo;
        $this->Nombre = $asignatura[0]->Nombre;
        $this->Precio = $asignatura[0]->Precio;
        $this->Descripcion = $asignatura[0]->Descripcion;
        $this->CodigoAula = $asignatura[0]->CodigoAula;
        
        return $this;            
    }
    
    public function nombre($codigo = ''){
        $aux = '';
        if($codigo != ''){
            $this->db->select('Nombre');
            $this->db->from('Asignatura');
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
    
    
    public function precio($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('Precio');
            $this->db->from('Asignatura');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $asignatura = $query->result();

            $aux = $asignatura[0]->Precio;
        }
        else{
            $aux = $this->Precio;
        }
        
        return $aux;
    }
    
    
    public function descripcion($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('Descripcion');
            $this->db->from('Asignatura');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $asignatura = $query->result();

            $aux = $asignatura[0]->Descripcion;
        }
        else{
            $aux = $this->Descripcion;
        }
        return $aux;
    }
    
    
    public function aula($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('CodigoAula');
            $this->db->from('Asignatura');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $asignatura = $query->result();

            $aux = $asignatura[0]->CodigoAula;
        }
        else{
            $aux = $this->CodigoAula;
        }
        return $aux;
    }
    
    
    static function numero(){
        return self::$db->count_all('Asignatura');
    }    

    
    static function obtener($campo, $orden, $offset = '', $limite = '', $cortado = FALSE) {
		
        $orden = ($orden == 'desc') ? 'desc' : 'asc';
        $sort_columns = array('Nombre', 'Precio');
        $campo = (in_array($campo, $sort_columns)) ? $campo : 'Nombre';

        self::$db->select('*');
        self::$db->from('Asignatura');
        if($limite != ''){
            self::$db->limit($limite, $offset);
        }
        self::$db->order_by($campo, $orden);
        $query = self::$db->get();

        $asignaturas = $query->result();

        return $asignaturas;
    }
    
    static function existe($codigo){
        $aux = FALSE;

        $query = self::$db->get_where("Asignatura", array('Codigo'=>$codigo));             
                
        if($query->num_rows() > 0){
            $aux = TRUE;
        }
        return $aux;
    }
    
    
   
    static function buscar($dato, $campo, $orden, $offset, $limite, $cortado = FALSE){
        
        self::$db-> select('*');
        self::$db-> like('Nombre', $dato);
        self::$db-> or_like('Precio', $dato);
        self::$db-> or_like('Descripcion', $dato);
        self::$db-> limit($limite, $offset);
        self::$db-> order_by($campo, $orden);
        
        $query = self::$db->get('Asignatura');
        $noticias = $query->result();
        
        if($cortado){
            Noticias_model::_limitar_caracteres(30, $noticias);
        }
        
        return $noticias;
    }
    
    
    public function busqueda_cantidad($dato){
        self::$db-> select('*');
        self::$db-> like('Nombre', $dato);
        self::$db-> or_like('Precio', $dato);
        self::$db-> or_like('Descripcion', $dato);
        self::$db ->from('Asignatura');
        return self::$db -> count_all_results();
    }
    
    public function eliminar($codigo){
        if($this->db->delete('Asignatura', array('Codigo' => $codigo)))
            return TRUE;  
    }
    
    /** 
    public function actualizar($id){
        $aux = FALSE;
        
        $this->db->set('Titulo', $this->input->post('titulo'));
        $this->db->set('Contenido', $this->input->post('contenido'));
        $this->db->set('FechaCreacion', date('Y-m-d H:i:s'));
        $this->db->set('EmailAdministrador', $this->session->userdata('email'));
        
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
*/    
    
}
?>
