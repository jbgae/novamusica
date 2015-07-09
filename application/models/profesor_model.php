<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor_model extends CI_Model{
    
    var $Email          = '';
    var $DNI            = ''; 
    var $Nombre         = '';
    var $Apellido1      = '';
    var $Apellido2      = '';
    var $Telefono       = '';
    var $FechaNacimiento    = '';
    var $NCC            = '';
    var $FechaAlta      = '';
    var $FechaUltimoAcceso  = '';
    var $CodigoImagen   = '';
    var $Texto          = '';
    var $Pass           = '';
    var $NumeroIntentos    = '';
    var $FechaUltimoIntento = '';
    
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar($codigoImagen = ''){
        $aux = FALSE;
        
        $this->Email = strtolower($this->input->post('email'));
        $this->DNI = $this->input->post('dni');
        $this->Nombre = ucwords(strtolower($this->input->post('nombre')));
        $this->Apellido1 = ucwords(strtolower($this->input->post('apellido1')));
        $this->Apellido2 = ucwords(strtolower($this->input->post('apellido2')));
        $this->Telefono = $this->input->post('telefono');
        $this->FechaNacimiento = date('Y-m-d', strtotime($this->input->post('fechaNacimiento')));
        $this->NCC = $this->input->post('ncc');
        $this->FechaAlta = date('Y-m-d H:i:s');
        $this->FechaUltimoAcceso = NULL;
        if($codigoImagen != ''){
            $this->CodigoImagen = $codigoImagen;
        }
        else{
            $this->CodigoImagen = NULL;
        }
        $this->Texto = $this->input->post('texto');
        $this->Pass = md5($this->input->post('pass'));
        $this->NumeroIntentos = 0;
        $this->FechaUltimoIntento = NULL;
        
        if($this->db->insert('Profesor', $this)){
            $aux = TRUE;
        }
        
        return $aux;
    }
    
    public function datos($codigo){
        $query = $this->db->get_where('Profesor', array('Codigo'=>$codigo));
        $profesor = $query->result();
        
        $this->Codigo         = $codigo;
        $this->Email          = $profesor[0]->Email;
        $this->DNI            = $profesor[0]->DNI; 
        $this->Nombre         = $profesor[0]->Nombre;
        $this->Apellido1      = $profesor[0]->Apellido1;
        $this->Apellido2      = $profesor[0]->Apellido2;
        $this->Telefono       = $profesor[0]->Telefono;
        $this->FechaNacimiento    = date("d-m-Y", strtotime($profesor[0]->FechaNacimiento));
        $this->NCC            = $profesor[0]->NCC;
        $this->FechaAlta      = $profesor[0]->FechaAlta;
        $this->FechaUltimoAcceso  = $profesor[0]->FechaUltimoAcceso;
        $this->CodigoImagen   = $profesor[0]->CodigoImagen;
        $this->Texto          = $profesor[0]->Texto;
        $this->Pass           = $profesor[0]->Pass;
        $this->NumeroIntentos    = $profesor[0]->NumeroIntentos;
        $this->FechaUltimoIntento = $profesor[0]->FechaUltimoIntento;
        
        return $this;
    }
    
    public function actualizar($codigo, $datos = ''){
        $aux = FALSE;        
        
        if($datos != ''){
            if(!empty($datos) ){
                if($this->db->update('Profesor', $datos, array('Codigo'=> $codigo))){
                    $aux = TRUE;
                }            
            }
        }
        else{
            $this->Email = strtolower($this->input->post('email'));
            $this->DNI = $this->input->post('dni');
            $this->Nombre = ucwords(strtolower($this->input->post('nombre')));
            $this->Apellido1 = ucwords(strtolower($this->input->post('apellido1')));
            $this->Apellido2 = ucwords(strtolower($this->input->post('apellido2')));
            $this->Telefono = $this->input->post('telefono');
            $this->FechaNacimiento = date('Y-m-d', strtotime($this->input->post('fechaNacimiento')));
            $this->NCC = $this->input->post('ncc');
            $this->Texto = $this->input->post('texto');
            $this->CodigoImagen = $this->codigoImagen($codigo);
            if($this->input->post('pass') != ''){
                $this->Pass = md5($this->input->post('pass'));
            }

            if($this->db->update('Profesor', $this, array('Codigo'=> $codigo))){
                $aux = TRUE;
            }
        }
        
        return $aux;
    }
    
    
    public function codigo($email){
        $aux = '';       
        
        $this->db->select('Codigo');
        $this->db->from('Profesor');
        $this->db->where('Email', $email);
        $query = $this->db->get();

        $profesor = $query->result();

        if(!empty($profesor)){
            $aux = $profesor[0]->Codigo;
        }
        
        return $aux;
    }
    
    public function dni($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('DNI');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->DNI;
        }
        else{
            $aux = $this->DNI;
        }
        
        return $aux;
    }
    
    public function nombre($codigo = ''){
        $aux = '';
        
        if($codigo != ''){
            $this->db->select('Nombre');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Nombre;
        }
        else{
            $aux = $this->Nombre;
        }
        
        return $aux;
    }
    
    public function apellido1($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('Apellido1');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Apellido1;
        }
        else{
            $aux = $this->Apellido1;
        }
        
        return $aux;        
    }
    
    public function apellido2($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('Apellido2');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Apellido2;
        }
        else{
            $aux = $this->Apellido2;
        }
        
        return $aux;        
    }
    
    public function telefono($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('Telefono');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Telefono;
        }
        else{
            $aux = $this->Telefono;
        }
        
        return $aux;        
    } 
    
    public function fechaNacimiento($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('FechaNacimiento');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->FechaNacimiento;
        }
        else{
            $aux = $this->FechaNacimiento;
        }
        
        return $aux;        
    }
    
    public function ncc($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('NCC');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->NCC;
        }
        else{
            $aux = $this->NCC;
        }
        
        return $aux;        
    }
    
    
    public function email($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('Email');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Email;
        }
        else{
            $aux = $this->Email;
        }
        
        return $aux;        
    }
    
    public function fechaAlta($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('FechaAlta');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->FechaAlta;
        }
        else{
            $aux = $this->FechaAlta;
        }
        
        return $aux;        
    }
    
    public function fechaUltimoAcceso($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('FechaUltimoAcceso');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->FechaUltimoAcceso;
        }
        else{
            $aux = $this->FechaUltimoAcceso;
        }
        
        return $aux;        
    }

    
    public function codigoImagen($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('CodigoImagen');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->CodigoImagen;
        }
        else{
            $aux = $this->CodigoImagen;
        }
        
        return $aux;        
    }    
    
    public function texto($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('Texto');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Texto;
        }
        else{
            $aux = $this->Texto;
        }
        
        return $aux;        
    }
    
    public function pass($codigo = ''){
        $aux ='';
        
        if($codigo != ''){
            $this->db->select('Pass');
            $this->db->from('Profesor');
            $this->db->where('Codigo', $codigo);
            $query = $this->db->get();

            $profesor = $query->result();

            $aux = $profesor[0]->Pass;
        }
        else{
            $aux = $this->Pass;
        }
        
        return $aux;        
    }
    
    public function numeroIntentos($email = ''){
        $aux = '';
        
        if($email != ''){
            if($this->existe($email)){
                $this->db->select('NumeroIntentos');
                $this->db->from('Profesor');
                $this->db->where('Email', $email);
                $query = $this->db->get();

                $profesor = $query->result();
                
                $aux = $profesor[0]->NumeroIntentos;
                
            }
        }
        else{
            $aux = $this->NumeroIntentos;
        }
        
        return $aux;
    }
    
    
    public function fechaUltimoIntento($email = ''){
        $aux = '';
        
        if($email != ''){
            if($this->existe($email)){
                $this->db->select('FechaUltimoIntento');
                $this->db->from('Usuarios');
                $this->db->where('Email', $email);
                $query = $this->db->get();

                $usuario = $query->result();

                $aux = $usuario[0]->FechaUltimoIntento;
            }
        }
        else{
            $aux = $this->FechaUltimoIntento;
        }
        
        return date('d/m/Y H:i:s', strtotime($aux));
    }
    
    public function tipo($codigo = ''){
        $aux = 'profesor';
        
        if($codigo != ''){
            $query = $this->db->query("SELECT * FROM Administrador WHERE Codigo LIKE $codigo");
            if($query->num_rows() > 0){
                $aux = 'admin';
            }
        }
        else{
            $query = $this->db->query("SELECT * FROM Administrador WHERE Codigo LIKE $this->Codigo");
            if($query->num_rows() > 0){
                $aux = 'admin';
            }
        }
        return $aux;
    }
    
    public function imparte($codigo = '', $codigoAsignatura = ''){
        $aux = '';
        
        if($codigoAsignatura == ''){
            if($codigo != ''){
                $this->db->select('CodigoAsignatura');
                $this->db->from('ProfesorAsignatura');
                $this->db->where('CodigoProfesor', $codigo);
                $query = $this->db->get();

                $imp = $query->result();
                
                if(!empty($imp)){
                    $aux = $imp;
                }
            }
            else{
                $this->db->select('CodigoAsignatura');
                $this->db->from('ProfesorAsignatura');
                $this->db->where('CodigoProfesor', $this->codigo);
                $query = $this->db->get();

                $imp = $query->result();
                
                if(!empty($imp)){
                    $aux = $imp;
                }
            }
        }
        else{
            log_message('info', 'Entra en imparte');
            $aux = FALSE;
            if($codigo != ''){
                $data = array(
                     'CodigoProfesor' => $codigo,
                     'CodigoAsignatura' => $codigoAsignatura
                );
                if($this->db->insert('ProfesorAsignatura', $data)){
                    $aux = TRUE;
                    log_message('info', 'Inserta el profe asig');
                }
                 
            }
            
        }
        
        return $aux;
    }
    
    public function eliminarImparte($codigo){
        $this->db->delete('ProfesorAsignatura', array('CodigoProfesor'=> $codigo));
    }
    
    static function obtener($campo, $orden, $offset = '', $limite = ''){
        $orden = ($orden == 'desc') ? 'desc' : 'asc';
        $sort_columns = array('Email', 'DNI', 'Nombre', 'Apellido1', 'Apellido2', 'FechaNacimiento','NCC','FechaAlta', 'FechaUltimoAcceso', 'Texto');
        $campo = (in_array($campo, $sort_columns)) ? $campo : 'Nombre';

        self::$db->select('*');
        self::$db->from('Profesor');
        self::$db->limit($limite, $offset);
        self::$db->order_by($campo, $orden);
        $query = self::$db->get();

        $profesores = $query->result();
      
        return $profesores;
    }
    
    static function existe($codigo, $aux = ''){
        if($aux == ''){
            $query = self::$db->get_where("Profesor", array('Codigo'=>$codigo));
        }        
        else{
            $email = $codigo;
            $query = self::$db->get_where("Profesor", array('Email'=>$email));
        }
        
        if($query->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    static function numero(){
        return self::$db->count_all('Profesor');        
    }
    
    static function buscar($dato, $campo, $orden, $offset, $limite){
        
        self::$db->select('*');
        self::$db->like('Nombre', $dato);
        self::$db->or_like('Apellido1', $dato);
        self::$db->or_like('Apellido2', $dato);
        self::$db->or_like('CONCAT(Nombre, " ", Apellido1, " ", Apellido2)', $dato);
        self::$db->or_like('CONCAT(Nombre, " ", Apellido1)', $dato);
        self::$db->or_like('CONCAT(Apellido1, " ", Apellido2)', $dato);
        self::$db->limit($limite, $offset);
        self::$db->order_by($campo, $orden);
        
        $query = self::$db->get('Profesor');
        $profesores =  $query->result();
                     
        return $profesores;
    }
    
   
    static function busqueda_cantidad($dato){
        self::$db->select('*');
        self::$db->like('Nombre', $dato);
        self::$db->or_like('Apellido1', $dato);
        self::$db->or_like('Apellido2', $dato);
        self::$db->or_like('CONCAT(Nombre, " ", Apellido1, " ", Apellido2)', $dato);
        self::$db->or_like('CONCAT(Nombre, " ", Apellido1)', $dato);
        self::$db->or_like('CONCAT(Apellido1, " ", Apellido2)', $dato);
        self::$db->from('Profesor');
        return self::$db->count_all_results();
    }
    
    
}
