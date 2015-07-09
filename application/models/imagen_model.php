<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagen_model extends CI_Model{
    
    var $Codigo     = '';
    var $Nombre     = '';
    var $Ruta       = ''; 
    var $Tamanyo    = '';
    var $Extension  = '';
        
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
        $this->load->library('image_lib');
        $this->load->helper('file');
    }
    
    public function inicializar( $tipo = 'foto'){
        $aux = FALSE;
        $path = getcwd();
        
        if(!is_dir(realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR))){           
            mkdir($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR, 0755);     
        }
        
        $config['upload_path'] =  realpath("$path/images/paginas/");
        $config['allowed_types'] = 'gif|jpg|jpeg|png|PNG|JPG|JPEG|GIF';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $this->load->library('upload',$config);
        
        if ($this->upload->do_upload('archivo')){ 
            log_message('info','La imagen ha sido subida con éxito');
            $foto = $this->upload->data();     
            $config['image_library'] = 'gd2';
            
            //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
            $config['source_image'] = realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR.$foto['file_name'] );
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['new_image']=realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR);
            if($tipo == 'foto'){
                $config['width'] = 220;
                $config['height'] = 220;
            }
            else{
                $config['width'] = 960;
                $config['height'] = 350;
            }
            
            $this->image_lib->initialize($config);
            
            if(!$this->image_lib->resize()){
                log_message('error', "Error imagen:".$this->image_lib->display_errors());
            }
            
            $this->image_lib->clear();
            unlink(realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR.$foto['file_name']));

            $this->Ruta = base_url().'images/paginas/'.$foto['raw_name'].'_thumb'.$foto['file_ext'];
            $this->Nombre = $foto['raw_name'];
            $this->Extension = $foto['file_ext'];
            $this->Tamanyo = $foto['file_size'];
            
            if($this->db->insert('Imagen', $this)){
                $aux = TRUE;
            }
            else{
                log_message('error', "Error imagen: No se ha introducido en la BD");
            }
        }
        else{
            log_message('error', "Error imagen:".$this->upload->display_errors());
        }
        
        return $aux;
    }
    
    
    public function codigo(){
        return $this->db->insert_id();
    }
    
    
    public function nombre($codigo = ''){
        $aux = '';
        if($codigo != ''){
            $this->db->select('Nombre');
            $this->db->from('Imagen');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $noticia = $query->result();

            $aux = $noticia[0]->Nombre;
        }
        else{
            $aux = $this->Nombre;
        }
        
        return $aux;
    }
    
    public function ruta($codigo = ''){
        $aux = '';
        if($codigo != ''){
            $this->db->select('Ruta');
            $this->db->from('Imagen');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $imagen = $query->result();

            $aux = $imagen[0]->Ruta;
        }
        else{
            $aux = $this->Ruta;
        }
        
        return $aux;
    }
    
    
    public function extension($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            if($this->existe($codigo)){
                $this->db->select('Extension');
                $this->db->from('Imagen');
                $this->db->where('Codigo', $codigo);
                $query = $this->db->get();

                $archivo = $query->result();

                $aux = $archivo[0]->Extension;
            }
        }
        else{
            $aux = $this->Extension;
        }
        
        return $aux;
    }
    
    public function tamanyo($codigo = '', $tam=''){
        $aux = '';
        if($tam == ''){
            if($codigo != ''){
                if($this->existe($codigo)){
                    $this->db->select('Tamanyo');
                    $this->db->from('Imagen');
                    $this->db->where('Codigo', $codigo);
                    $query = $this->db->get();

                    $archivo = $query->result();

                    $aux = $archivo[0]->Tamanyo;
                }
            }
            else{
                $aux = $this->Extension;
            }
        }
        else{
            $datos = array('Tamanyo' => $tam);
            if($this->db->update('Archivo', $datos, array('Codigo'=> $codigo))){
                    $aux = TRUE;
            }
        }

        return $aux;
    }
    
    
    public function actualizar($codigo, $tipo = 'foto'){
        $aux = FALSE;
        $path = getcwd();
        
        if(!is_dir(realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR))){           
            mkdir($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR, 0755);     
        }
        
        $config['upload_path'] =  realpath("$path/images/paginas/");
        $config['allowed_types'] = 'gif|jpg|jpeg|png|PNG|JPG|JPEG|GIF';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $this->load->library('upload',$config);
        
        $ruta = str_replace(MY_Controller::base(), realpath($path),$this->ruta($codigo));
        if(file_exists($ruta)){ 
            if(substr($ruta, -1) != '/'){
                if(unlink($ruta)){
                    $aux = TRUE;
                    log_message('info','La imagen ha sido borrada con éxito');
                }
                else{
                    $aux = FALSE;
                    log_message('error','La imagen no ha sido borrada');
                }
            }
        }     
        
        if ($this->upload->do_upload('archivo')){ 
            log_message('info','La nueva imagen ha sido subida con éxito');
            $foto = $this->upload->data();     
            $config['image_library'] = 'gd2';
            
            //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
            $config['source_image'] = realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR.$foto['file_name'] );
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['new_image']=realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR);
            if($tipo == 'foto'){
                $config['width'] = 220;
                $config['height'] = 220;
            }
            else{
                $config['width'] = 960;
                $config['height'] = 350;
            }
            
            $this->image_lib->initialize($config);
            
            if(!$this->image_lib->resize()){
                log_message('error', "Error imagen:".$this->image_lib->display_errors());
            }
            
            $this->image_lib->clear();
            unlink(realpath($path.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."paginas".DIRECTORY_SEPARATOR.$foto['file_name']));

            $this->Codigo = $codigo;
            $this->Ruta = base_url().'images/paginas/'.$foto['raw_name'].'_thumb'.$foto['file_ext'];
            $this->Nombre = $foto['raw_name'];
            $this->Extension = $foto['file_ext'];
            $this->Tamanyo = $foto['file_size'];
            
            if($this->db->update('Imagen', $this, array('Codigo'=> $codigo))){
                    $aux = TRUE;
            }
            else{
                log_message('error', "Error imagen: No se ha introducido en la BD");
            }
        }
        else{
            log_message('error', "Error imagen:".$this->upload->display_errors());
        }
        
        return $aux;
    }
    
    
    static function existe($codigo){
        $aux = FALSE;
  
        $query = self::$db->get_where('Imagen', array('Codigo'=>$codigo));
        
        if($query->num_rows() > 0){
            $aux = TRUE;
        }
        
        return $aux;
    }
    
    
    static function obtener($codigoPagina){
        self::$db->select('*');
        self::$db->from('ImagenPagina');
        self::$db->where('CodigoPagina', $codigoPagina);
        
        
        $query = self::$db->get();
        $imagenesAux = $query->result();
        $imagenes = array();
        
        
        foreach($imagenesAux as $imagen){
            self::$db->select('Titulo, Contenido');
            self::$db->from('ImagenTexto');
            self::$db->where('CodigoImagen', $imagen->Codigo);
            
            $query = self::$db->get();
            $imagenTexto = $query->result();
            
            if(!empty($imagenTexto)){
                $imagenes[$imagen['Codigo']] = array(
                    'imagen' => $imagen,
                    'contenido' => $imagenTexto
                ); 
            }
            else{
                $imagenes[$imagen['Codigo']] = array(
                    'imagen' => $imagen,
                    'contenido' => ''
                ); 
            }        
        }
        
        return $imagenes;
    }
}
?>