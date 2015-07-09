<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumno extends MY_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('alumno_model', 'Alumno');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
    }
    
    
    public function registrar(){
        $this->permisos('admin');
        $this->pagina = 'registrar alumno';               
        $this->menu = 'menu_alumnos';
        $this->titulo = $this->pagina;
        $this->estilo = array('backend','tablas', 'formulario');
        $this->javascript = array('marcar_checkbox', 'confirmacion', 'domiciliacion');
        
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        
        $datos['backend'] = TRUE;
        $datos['formulario'] = array(
            'matricula' => array(
                    'label' => array('accesskey'=>'U', 'name'=>' Nº Matríc<u>u</u>la'),
                    'input' => array('class'=>'matricula','name'=>'matricula','id'=>'matricula', 'maxlength'=>'30', 'size'=>'35',  'autofocus'=>'autofocus', 'value'=> $this->input->post('matricula')),
                    'requerido'=>TRUE
            ),            
            'nombre'=>array(
                    'label' => array('accesskey'=>'M', 'name'=>'No<u>m</u>bre'),
                    'input' => array('class'=>'nombre','name'=>'nombre','id'=>'nombre', 'maxlength'=>'30', 'size'=>'35',  'autofocus'=>'autofocus', 'value'=> $this->input->post('nombre')),
                    'requerido'=>TRUE
            ),
            
            'apellido1'=>array(
                    'label' => array('accesskey'=>'L', 'name'=>'Primer ape<u>l</u>lido'),
                    'input' => array('class'=>'apellidoP','name'=>'apellido1','id'=>'primerApellido', 'maxlength'=>'60', 'size'=>'35', 'value'=> $this->input->post('apellido1')),
                    'requerido'=>TRUE
            ),
                       
            'apellido2'=>array(
                    'label' => array('accesskey'=>'G', 'name'=>'Se<u>g</u>undo apellido'),
                    'input' => array('class'=>'apellidoM','name'=>'apellido2','id'=>'segundoApellido', 'maxlength'=>'60', 'size'=>'35', 'value'=> $this->input->post('apellido2')),
                    'requerido'=>TRUE
            ),
            'dni'=>array(
                    'label' => array('accesskey'=>'D', 'name'=>'<u>D</u>NI'),
                    'input' => array('class'=>'dni','name'=>'dni','id'=>'dni', 'maxlength'=>'9', 'size'=>'9', 'value'=> $this->input->post('dni')),
                    'requerido'=>FALSE
            ),'email'=>array(
                    'label' => array('accesskey'=>'E', 'name'=>'<u>E</u>mail'),
                    'input' => array('class'=>'email','name'=>'email','id'=>'email', 'maxlength'=>'50', 'size'=>'35', 'value'=> $this->input->post('email')),
                    'requerido'=>TRUE
            ),
            'direccion'=>array(
                'label'=>array('accesskey'=>'O', 'name'=>'Direcci<u>ó</u>n'),
                'input'=>array('class'=>'direccion', 'name'=>'direccion', 'id'=> 'direccion', 'maxlength'=>'120', 'size'=>'35', 'value'=>$this->input->post('direccion')),
                'requerido'=>TRUE
            ),            
            'fechaNacimiento'=>array(
                    'label' => array('accesskey'=>'A', 'name'=>'Fech<u>a</u> de nacimiento'),
                    'input' => array('class'=>'fechaN','name'=>'fechaNacimiento','id'=>'fNacimiento', 'maxlength'=>'10', 'size'=>'15', 'placeholder'=>'mm-dd-aaaa', 'value'=> $this->input->post('fechaNacimiento')),
                    'requerido'=>TRUE
            ),
            
            
            
            
            
            'telefono'=>array(
                    'label' => array('accesskey'=>'T', 'name'=>'<u>T</u>elefono'),
                    'input' => array('class'=>'telefono','name'=>'telefono','id'=>'telefono', 'maxlength'=>'9', 'size'=>'9', 'value'=> $this->input->post('telefono')),
                    'requerido'=>TRUE
            ),
            /*
            'ncc'=>array(
                    'label' => array('accesskey'=>'N', 'name'=>'<u>N</u>CC'),
                    'input' => array('class'=>'ncc','name'=>'ncc','id'=>'ncc', 'maxlength'=>'24', 'size'=>'35', 'value'=> $this->input->post('ncc')),
                    'requerido'=>TRUE
            ),
            
            'password'=>array(
                'label'=> array('accesskey'=>'D', 'name'=>'Passwor<u>d</u>'),
                'input'=>array( 'class'=>'password', 'name'=>'pass','id'=>'pass', 'maxlength'=>'20', 'size'=>'15',  'autocomplete'=>'off'),
                'requerido'=>TRUE
            ),
            
            'passconf'=>array(
                'label'=> array('accesskey'=>'F', 'name'=>'Con<u>f</u>irme el password'),
                'input'=>array( 'class'=>'passconf', 'name'=>'passconf','id'=>'passconf', 'maxlength'=>'20', 'size'=>'15',  'autocomplete'=>'off'),
                'requerido'=>TRUE
            ),*/ 
            'asignaturas'=>array(
                'label'=> array('accesskey'=>'E', 'name'=>'<u>E</u>studia'),
                'input'=>array( 'class'=>'asig', 'name'=>'asignaturas','id'=>'asig'),
                'requerido'=>FALSE
            )    
        );
        
        
        $asignaturas = Asignatura_model::obtener('Nombre', 'asc');
        $datos['check'] = array();
        foreach($asignaturas as $asignatura){
            $aux = array();
            $aux = array(
                'name'        => "asignatura[$asignatura->Codigo]",
                'id'          => $asignatura->Nombre,
                'value'       => 'accept',
                'checked'     => FALSE,
            );
            array_push($datos['check'], $aux);            
        }
        $datos['boton'] = array('name'=>'button','id'=>'boton_registro','value'=>'Enviar','class'=>'btn btn-primary');
        $datos['imagen'] = '';
        
        
        
        /*$datos['check'] = array();
        foreach($asignaturas as $asignatura){
            $aux = array();
            $aux = array(
                'name'        => "asignatura[$asignatura->Codigo]",
                'id'          => $asignatura->Nombre,
                'value'       => 'accept',
                'checked'     => FALSE,
            );
            array_push($datos['check'], $aux);
            
        }
        
        
        
        $datos['boton'] = array('name'=>'button','id'=>'boton_registro','value'=>'Enviar','class'=>'btn btn-primary');
        $datos['imagen'] = '';
       
        if($this->_validarRegistro()){
            $profesor = new Profesor_model;
            $codigoImagen = '';
            $imagen = new Imagen_model;
            if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){
                if($imagen->inicializar()){
                    $codigoImagen = $imagen->codigo();
                }
            }
            if($profesor->inicializar($codigoImagen)){
                
                $codigoProfesor = $profesor->codigo($this->input->post('email'));
                foreach($this->input->post('asignatura') as $key => $asig){
                    $profesor->imparte($codigoProfesor, $key);
                    
                    $asignaturas = Asignatura_model::obtener('Nombre', 'asc');
                    $datos['check'] = array();
                    
                    foreach($asignaturas as $asignatura){
                        $aux = array();
                        $check = FALSE;
                        if($asignatura->Codigo == $key){
                            $check = TRUE;
                        }
                        $aux = array(
                            'name'        => "asignatura[$asignatura->Codigo]",
                            'id'          => $asignatura->Nombre,
                            'value'       => 'accept',
                            'checked'     => $check,
                        );
                        array_push($datos['check'], $aux);

                    }
                }
                
                $datos['mensaje'] = 'Los datos del profesor se han registrado satisfactoriamente';
            }
            else{
                $datos['error'] = 'No se ha podido registrar el profesor';
            }
        }
        
        */
        $this->mostrar($datos);
    }
    
    public function listar($campo = 'Nombre', $orden = 'asc', $limit='15', $offset = 0){
        $this->permisos('admin');                
        $this->pagina = 'alumnos';               
        $this->menu = 'menu_alumnos';
        $this->titulo = $this->pagina;
        $this->estilo = array('backend','tablas');
        $this->javascript = array('marcar_checkbox', 'confirmacion');
        $datos['buscador'] = array('class' => 'search-query input-medium', 'type'=>'text','name'=>'buscador', 'placeholder' => "Buscar",'autofocus'=>'autofocus');
        $datos['boton'] = array('class'=>'btn', 'id'=>'buscador', 'name'=>'button', 'value'=>'Buscar');
        $datos['borrar']= array('class'=>'btn btn-danger confirm-toggle','id'=>'borrar', 'value'=>'Borrar selección','data-confirm'=>"¿Estás seguro?");
        $datos['backend'] = TRUE;
        
        $numero = Alumno_model::numero();
        
        /*if($numero == 0){
           $this->registrar();
        }
        else{*/            
            $datos['numero'] = $numero; 
            $opciones = $this->seleccion($numero);
            $datos['opciones'] = $opciones;

            if($this->input->post('cantidad') != ''){
                if($opciones[$this->input->post('cantidad')] == 'Todo'){
                    $limit = $numero;
                }    
                else{
                    $limit = $opciones[$this->input->post('cantidad')];      
                }
            }    
            
            $datos['elementos'] = $limit;
            
            if($this->input->post('cantidad') != ''){
                $datos['limit']= $this->input->post('cantidad');
            }
            else{
                $aux = 0;
                if($limit % 5 != 0)
                    $aux = 1;
                $datos['limit'] = floor($limit / 5) - 1 + $aux;
            }
            
            $datos['fields'] = array(
                    'Expediente' => 'Nº Expediente',
                    'Nombre' => 'Nombre',
                    'Email' => 'Email',
                    'Telefono' => 'Teléfono',
                    'Estado' => 'Estado',
                                     
            );            
            
                             
            $config = array();
            $config['base_url'] = base_url(). "admin/alumno/".$campo."/".$orden."/".$limit."/";
            $config['total_rows'] =$numero;
            $config['per_page'] = $limit;
            $config['uri_segment'] = 6;
            $config['prev_link'] = 'anterior';
            $config['next_link'] = 'siguiente';
            $config['first_link'] = '<<';
            $config['last_link'] = '>>'; 
            $config['num_tag_open'] = '<li class="disable">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $datos['links'] = $this->pagination->create_links();

            $datos['campo'] = $campo;
            $datos['orden'] = $orden;

            $this->mostrar($datos);
        //}            
    }
}
