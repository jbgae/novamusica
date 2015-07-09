<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo_model extends CI_Model{
    
    var $Nombre             = '';
    var $CodigoAsignatura   = '';
        
    private static $db;
    
    public function __construct() {
        parent::__construct(); 
        self::$db = &get_instance()->db;
        $this->load->database();
    }
    
    public function inicializar(){
        $aux = FALSE;
         
        $this->Nombre = $this->input->post('NombreGrupo');
        $this->CodigoAsignatura = $_POST['cod'];

        if($this->db->insert('Grupo', $this)){
            $aux = TRUE;
            $cod = $this->codigo();
        }
        
        
        if($aux){
            if(is_array($this->input->post('diaSemana'))){
                log_message('info', 'Es un array');
                
                $diaSemana  = $this->input->post('diaSemana');
                
                $horaInicio = $this->input->post('HoraInicio');
                $horaFin    = $this->input->post('HoraFin');
                
                                
                for($i = 0; $i != count($this->input->post('diaSemana')) && $aux ; $i++){
                    
                    $data = array(
                        'CodigoGrupo'   => $cod,
                        'Dia'           => $diaSemana[$i],
                        'HoraInicio'    => $horaInicio[$i],
                        'HoraFin'       => $horaFin[$i] 
                    );

                    if($this->db->insert('DiasGrupo', $data)){
                        $aux = TRUE;
                    }
                    else{
                        $aux = FALSE;
                    }
                } 
            }
            else{
                
                $data = array(
                    'CodigoGrupo'   => $this->codigo(),
                    'Dia'           => $this->input->post('diaSemana'),
                    'HoraInicio'    => $horaInicio[$i],
                    'HoraFin'       => $horaFin[$i] 
                );
                
                if($this->db->insert('DiasGrupo', $data)){
                    $aux = TRUE;
                }
                else{
                    $aux = FALSE;
                }
            }
        }
        
        return $aux;
        
    }
    
    public function codigo(){
        return $this->db->insert_id();
    }
    
    static function obtener($codigoAsignatura){
        $query = self::$db->get_where('Grupo', array('CodigoAsignatura'=> $codigoAsignatura));
                
        $grupos = $query->result();

        return $grupos;
    }
}
