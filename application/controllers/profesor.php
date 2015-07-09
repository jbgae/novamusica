<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor extends MY_Controller{

    public function __construct() {
        parent:: __construct();        
        
        $this->load->library('pagination');
        $this->load->helper('file');
        $this->load->model('profesor_model','Profesor');
        $this->load->model('asignatura_model');
        $this->load->model('admin_model');
        $this->load->model('imagen_model');
        $this->load->model('captcha_model');  
        
        if($this->uri->segment(1) == 'admin'){
            $this->permisos('admin');
        }
    }    
    
    /*Reglas de validación del formulario de iniciar sesión*/
    private function _validarSesion(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|valid_email|xss_clean|callback_existeProfesor|callback_confirmarPassword|callback_numeroIntentos|callback_usuarioValidado');
        $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|min_length[6]|xss_clean');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|min_length[6]|xss_clean|callback_verificarCaptcha');
        $this->form_validation->set_message('existeUsuario', 'No existe ningún usuario con el email indicado.');
        $this->form_validation->set_message('usuarioValidado', 'El email introducido no esta validado.');
        $this->form_validation->set_message('numeroIntentos', 'La cuenta esta bloqueada temporalmente.');
        $this->form_validation->set_message('confirmarPassword', 'El email o la contraseña son incorrectas.');
        $this->form_validation->set_message('verificarCaptcha', 'El captcha introducido no es correcto.');
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('min_length', '%s debe tener mínimo %s caracteres');
        $this->form_validation->set_message('valid_email', '%s no es válido');
        $this->form_validation->set_message('xss_clean', ' %s no es válido');
        
        return $this->form_validation->run();
    }
    
    private function _validarRegistro(){
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('apellido1', 'Primer apellido', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('apellido2', 'Segundo apellido', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required||exact_length[9]|xss_clean');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de nacimiento', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|xss_clean|exact_length[9]');
        $this->form_validation->set_rules('ncc', 'NCC', 'trim|required|xss_clean|exact_length[24]');
        $this->form_validation->set_rules('texto', 'Texto', 'trim|required|xss_clean');
        if($this->uri->segment(3) == 'registrar'){
            $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|min_length[6]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Contraseña', 'trim|required|min_length[6]|xss_clean|matches[pass]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|valid_email|xss_clean|callback_noExisteProfesor');

        }
        else{
            $this->form_validation->set_rules('pass', 'Contraseña', 'trim|min_length[6]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Contraseña', 'trim|min_length[6]|xss_clean|matches[pass]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|valid_email|xss_clean');

        }
        
        $this->form_validation->set_message('existeUsuario', 'Existe un usuario con el email indicado.');
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('min_length', '%s debe tener mínimo %s caracteres');
        $this->form_validation->set_message('exact_length', '%s debe tener  %s caracteres');
        $this->form_validation->set_message('valid_email', '%s no es válido');
        $this->form_validation->set_message('xss_clean', ' %s no es válido');
        $this->form_validation->set_message('matches', ' Las contraseñas no coinciden');
        
        
        return $this->form_validation->run();
    }
    
    
    private function _validarEmail(){
        $this->form_validation->set_rules('asunto', 'Asunto', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('contenido', 'Contenido', 'trim|required|min_length[3]');
        
        $this->form_validation->set_message('required', 'El campo %s no puede estar vacio');
        $this->form_validation->set_message('min_legth', 'El campo %s debe tener mínmo 3 caracteres');
        $this->form_validation->set_message('xss_clean', 'El campo %s no es válido');
        
        return $this->form_validation->run();
    }
    
    
    private function _validarBusqueda(){
        $this->form_validation->set_rules('buscador', 'Buscador', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('xss_clean', ' %s no es una búsqueda válida');  
        
        return $this->form_validation->run();
    }
    
    public function iniciarSesion(){    
        $this->pagina = 'login';
        $this->titulo = 'Iniciar sesión';
        $this->estilo = 'login';
        $this->javascript = ''; 
        
        $datos['backend'] = TRUE;
        $datos['imagen'] = $this->captcha_model->crear_captcha();
        $datos['boton'] = array('name'=>'button', 'id'=>'boton_sesion', 'value'=>'Enviar', 'class'=>'btn btn-primary');
        $datos['formulario'] = array(
            'email'=>array(
                    'label' => array('accesskey'=>'E', 'name'=>'<u>E</u>mail'),
                    'input' => array('class'=>'email form-control','name'=>'email','id'=>'email', 'maxlength'=>'50', 'size'=>'20', 'value'=> $this->input->post('email'),'autofocus'=>'autofocus')
            ),
            'password'=>array(
                'label'=> array('accesskey'=>'D', 'name'=>'Passwor<u>d</u>'),
                'input'=>array( 'class'=>'password form-control', 'name'=>'pass','id'=>'pass', 'maxlength'=>'20', 'size'=>'20',  'autocomplete'=>'off')
            ),
            'captcha'=>array(
                'label'=> array('accesskey'=>'D', 'name'=>'Captc<u>h</u>a'),
                'input' => array( 'class'=>'captcha form-control', 'name'=>'captcha','id'=>'captcha', 'maxlength'=>'20', 'size'=>'20',  'autocomplete'=>'off')
            ),
        );      
           
               
        
        if($this->_validarSesion()){                 
            $profesor = new Profesor_model;
            $cod = $profesor->codigo($this->input->post('email'));
            $profesor->datos($cod);                             

            $ultimoAcceso = $profesor->fechaUltimoAcceso();
            $act = array(
                'NumeroIntentos' => 0,
                'FechaUltimoAcceso' => date('Y/m/d H:i:s')
            );
            $profesor->actualizar($cod, $act);

            $datosProfesor = array(
                'codigo'    => $cod,
                'nombre'    => $profesor->nombre(),
                'apellidos' => $profesor->apellido1() .' '. $profesor->apellido2(),
                'email'     => $profesor->email(),
                'usuario'   => $profesor->tipo(),
                'ultimoAcceso' => $ultimoAcceso,
                'logged_in' => TRUE
            );                

            $this->session->set_userdata($datosProfesor);

            if(Admin_model::existe($profesor->codigo($this->input->post('email')))){
                redirect("admin/novedades");
            }
            else{
                redirect("profesor/novedades");
            }
        }
        
              
        $this->mostrar($datos);
    }
    
    
    public function cerrarSesion(){
        $this->session->unset_userdata('ultimoAcceso');
        $this->session->unset_userdata('usuario');
        
        $this->session->sess_destroy();
        redirect('inicio');
    }
    
    
    public function informacion($codigo){
        $this->pagina = 'profesor';
        $this->estilo = array('profesor','general_paginas');
        $this->javascript = array(''); 
                
        if(Profesor_model::existe($codigo)){
            $datos['existe'] = TRUE;
            $profesor = new Profesor_model;
            $datos['profesor'] = $profesor->datos($codigo);
            if($profesor->codigoImagen() != NULL){
                $imagen = new Imagen_model;
                $datos['imagen'] = $imagen->ruta($profesor->codigoImagen());
            }
            $this->titulo = $profesor->Nombre .' '.$profesor->Apellido1.' '.$profesor->Apellido2;
        }        
        else{
            $datos['existe'] = FALSE;
        }
        
        $this->mostrar($datos);
    }
    
    
    public function listar($campo = 'Nombre', $orden = 'asc', $limit='5', $offset = 0){
        //$this->permisos('admin');
                
        $this->pagina = 'profesores';
               
        $this->menu = 'menu_profesor';
        $this->titulo = $this->pagina;
        $this->estilo = array('backend','tablas');
        $this->javascript = array('marcar_checkbox', 'confirmacion');
        $datos['buscador'] = array('class' => 'search-query input-medium', 'type'=>'text','name'=>'buscador', 'placeholder' => "Buscar",'autofocus'=>'autofocus');
        $datos['boton'] = array('class'=>'btn', 'id'=>'buscador', 'name'=>'button', 'value'=>'Buscar');
        $datos['borrar']= array('class'=>'btn btn-danger confirm-toggle','id'=>'borrar', 'value'=>'Borrar selección','data-confirm'=>"¿Estás seguro?");
        $datos['backend'] = TRUE;
        
        $numero = Profesor_model::numero();
        
        if($numero == 0){
           $this->registrar();
        }
        else{            
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
                    'Nombre' => 'Nombre',
                    'Email' => 'Email',
                    'DNI' => 'DNI',                    
                    'FechaNacimiento' => 'F. nacimiento',
                    'FechaAlta' => 'Alta',
                    'FechaUltimoAcceso' => 'Último acceso'                    
            );            
            
            $profesores = Profesor_model::obtener($campo, $orden, $offset, $limit);
            $profesorAux = new Profesor_model;
            $asig = new Asignatura_model;
            foreach($profesores as &$profesor){
                $aux = $profesorAux->imparte($profesor->Codigo);
                if(!empty($aux)){
                    $asignaturas = array();
                    foreach($aux as $codigo){
                        array_push($asignaturas, $asig->nombre($codigo->CodigoAsignatura));
                    }
                    $profesor->Imparte = $asignaturas;
                }
                else{
                    $profesor->Imparte = "";
                }
               
            }
            
           
            $datos['profesores'] = $profesores;
                 
            $config = array();
            $config['base_url'] = base_url(). "admin/profesores/".$campo."/".$orden."/".$limit."/";
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
        }            
    }
    
    
    public function registrar(){
        $this->pagina = 'registrar profesor';
        $this->titulo = 'Registrar profesor';
        $this->estilo = array('formulario','backend','jquery-te-1.3.3');
        $this->javascript = array('jquery-te-1.3.3.min','editor'); 
        $this->menu = 'menu_profesor';
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        
        $datos['backend'] = TRUE;
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
        
        $datos['formulario'] = array(
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
            
            'fechaNacimiento'=>array(
                    'label' => array('accesskey'=>'A', 'name'=>'Fech<u>a</u> de nacimiento'),
                    'input' => array('class'=>'fechaN','name'=>'fechaNacimiento','id'=>'fNacimiento', 'maxlength'=>'10', 'size'=>'15', 'placeholder'=>'mm-dd-aaaa', 'value'=> $this->input->post('fechaNacimiento')),
                    'requerido'=>TRUE
            ),
            
            'email'=>array(
                    'label' => array('accesskey'=>'E', 'name'=>'<u>E</u>mail'),
                    'input' => array('class'=>'email','name'=>'email','id'=>'email', 'maxlength'=>'50', 'size'=>'35', 'value'=> $this->input->post('email')),
                    'requerido'=>TRUE
            ),
            
            'dni'=>array(
                    'label' => array('accesskey'=>'D', 'name'=>'<u>D</u>NI'),
                    'input' => array('class'=>'dni','name'=>'dni','id'=>'dni', 'maxlength'=>'9', 'size'=>'9', 'value'=> $this->input->post('dni')),
                    'requerido'=>TRUE
            ),
            
            'telefono'=>array(
                    'label' => array('accesskey'=>'T', 'name'=>'<u>T</u>eléfono'),
                    'input' => array('class'=>'telefono','name'=>'telefono','id'=>'telefono', 'maxlength'=>'9', 'size'=>'9', 'value'=> $this->input->post('telefono')),
                    'requerido'=>TRUE
            ),
            
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
            ), 
            'asignaturas'=>array(
                'label'=> array('accesskey'=>'I', 'name'=>'<u>I</u>mparte'),
                'input'=>array( 'class'=>'asig', 'name'=>'asignaturas','id'=>'asig'),
                'requerido'=>FALSE
            ),
            'texto'=>array(
                    'label' => array('accesskey'=>'X', 'name'=>'Te<u>x</u>to'),
                    'input' => array('class'=>'editor','name'=>'texto','id'=>'texto', 'type' => 'text', 'value'=> $this->input->post('texto')),
                    'requerido'=> TRUE
            )     
        );
        
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
        
        
        $this->mostrar($datos);
    }    
    
    
    public function editar($codigo=''){ 
        $profesor = new Profesor_model;
        $this->pagina = 'registrar profesor';
        $this->menu = 'menu_profesor';
        $this->titulo = 'modificar profesor';
        $this->estilo = array('formulario','profesor','backend','jquery-te-1.3.3');
        $this->javascript = array('jquery-te-1.3.3.min','editor'); 
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        
        
        $datos['codigo'] = $codigo;
        $datos['actualizar'] = TRUE;        
        
        $datos['backend'] = TRUE;
        $asignaturas = '';
        
        
        $datos['formulario'] = array(
            'nombre'=>array(
                    'label' => array('accesskey'=>'M', 'name'=>'No<u>m</u>bre'),
                    'input' => array('class'=>'nombre','name'=>'nombre','id'=>'nombre', 'maxlength'=>'30', 'size'=>'35',  'autofocus'=>'autofocus', 'value'=>''),
                    'requerido'=>TRUE
            ),
            
            'apellido1'=>array(
                    'label' => array('accesskey'=>'L', 'name'=>'Primer ape<u>l</u>lido'),
                    'input' => array('class'=>'apellidoP','name'=>'apellido1','id'=>'primerApellido', 'maxlength'=>'60', 'size'=>'35', 'value'=> ''),
                    'requerido'=>TRUE
            ),
                       
            'apellido2'=>array(
                    'label' => array('accesskey'=>'G', 'name'=>'Se<u>g</u>undo apellido'),
                    'input' => array('class'=>'apellidoM','name'=>'apellido2','id'=>'segundoApellido', 'maxlength'=>'60', 'size'=>'35', 'value'=> ''),
                    'requerido'=>TRUE
            ),
            
            'fechaNacimiento'=>array(
                    'label' => array('accesskey'=>'A', 'name'=>'Fech<u>a</u> de nacimiento'),
                    'input' => array('class'=>'fechaN','name'=>'fechaNacimiento','id'=>'fNacimiento', 'maxlength'=>'10', 'size'=>'15', 'placeholder'=>'mm-dd-aaaa', 'value'=> ''),
                    'requerido'=>TRUE
            ),
            
            'email'=>array(
                    'label' => array('accesskey'=>'E', 'name'=>'<u>E</u>mail'),
                    'input' => array('class'=>'email','name'=>'email','id'=>'email', 'maxlength'=>'50', 'size'=>'35', 'value'=> ''),
                    'requerido'=>TRUE
            ),
            
            'dni'=>array(
                    'label' => array('accesskey'=>'D', 'name'=>'<u>D</u>NI'),
                    'input' => array('class'=>'dni','name'=>'dni','id'=>'dni', 'maxlength'=>'9', 'size'=>'9', 'value'=> ''),
                    'requerido'=>TRUE
            ),
            
            'telefono'=>array(
                    'label' => array('accesskey'=>'T', 'name'=>'<u>T</u>elefono'),
                    'input' => array('class'=>'telefono','name'=>'telefono','id'=>'telefono', 'maxlength'=>'9', 'size'=>'9', 'value'=> ''),
                    'requerido'=>TRUE
            ),
            
            'ncc'=>array(
                    'label' => array('accesskey'=>'N', 'name'=>'<u>N</u>CC'),
                    'input' => array('class'=>'ncc','name'=>'ncc','id'=>'ncc', 'maxlength'=>'24', 'size'=>'35', 'value'=> ''),
                    'requerido'=>TRUE
            ),
            
            'password'=>array(
                'label'=> array('accesskey'=>'D', 'name'=>'Passwor<u>d</u>'),
                'input'=>array( 'class'=>'password', 'name'=>'pass','id'=>'pass', 'maxlength'=>'20', 'size'=>'15',  'autocomplete'=>'off'),
                'requerido'=>FALSE
            ),
            
            'passconf'=>array(
                'label'=> array('accesskey'=>'F', 'name'=>'Con<u>f</u>irme el password'),
                'input'=>array( 'class'=>'passconf', 'name'=>'passconf','id'=>'passconf', 'maxlength'=>'20', 'size'=>'15',  'autocomplete'=>'off'),
                'requerido'=>FALSE
            ),
            'asignaturas'=>array(
                'label'=> array('accesskey'=>'I', 'name'=>'<u>I</u>mparte'),
                'input'=>array( 'class'=>'asig', 'name'=>'asignaturas','id'=>'asig'),
                'requerido'=>FALSE
            ),
            'texto'=>array(
                    'label' => array('accesskey'=>'X', 'name'=>'Te<u>x</u>to'),
                    'input' => array('class'=>'editor','name'=>'texto','id'=>'texto', 'type' => 'text', 'value'=> ''),
                    'requerido'=> TRUE
            )                     
           
        );
        
        $datos['boton'] = array('name'=>'button','id'=>'boton_registro','value'=>'Enviar','class'=>'btn btn-primary');
        
        
        if(Profesor_model::existe($codigo)){
            $profesor->datos($codigo);
            
            $asignaturas = Asignatura_model::obtener('Nombre', 'asc');
            $imparte = $profesor->imparte($codigo);
            $datos['check'] = array();
            foreach($asignaturas as $asignatura){
                $aux = array();
                $aux = array(
                    'name'        => "asignatura[$asignatura->Codigo]",
                    'id'          => $asignatura->Nombre,
                    'value'       => 'accept',
                    'checked'     => FALSE,
                );
                if(!empty($imparte)){                    
                    foreach($imparte as $imp){
                        if($imp->CodigoAsignatura == $asignatura->Codigo){
                            $aux['checked'] = TRUE;
                        }
                    }
                }
                array_push($datos['check'], $aux);

            }
            
            if($profesor->codigoImagen() != NULL){
                if(Imagen_model::existe($profesor->codigoImagen())){
                    $image = new Imagen_model;
                    $datos['imagen'] = $image->ruta($profesor->codigoImagen());
                }
            }
            
            $datos['formulario']['nombre']['input']['value'] = $profesor->nombre();
            $datos['formulario']['apellido1']['input']['value'] = $profesor->apellido1();
            $datos['formulario']['apellido2']['input']['value'] = $profesor->apellido2();
            $datos['formulario']['fechaNacimiento']['input']['value'] =  date("m-d-Y", strtotime($profesor->fechaNacimiento()));
            $datos['formulario']['dni']['input']['value'] = $profesor->dni();
            $datos['formulario']['telefono']['input']['value'] = $profesor->telefono();
            $datos['formulario']['ncc']['input']['value'] = $profesor->ncc();            
            $datos['formulario']['email']['input']['value'] = $profesor->email();
            $datos['formulario']['texto']['input']['value'] = $profesor->texto();

            
            $datos['boton'] = array( 'class'=> 'btn btn-primary', 'name'=>'button', 'id' => 'boton_profesor');
            $email = $profesor->email();
            
            if($this->_validarRegistro()){
                
                if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){
                    $imagenAux = $profesor->codigoImagen();
                    $imagen = new Imagen_model;
                    if($imagenAux != NULL){
                        $imagen->actualizar($imagenAux);
                        $datos['imagen'] = $imagen->ruta($imagenAux);
                    }
                    else{
                        $imagen->inicializar();
                        $codigoImagen = $imagen->codigo();
                        $data = array('CodigoImagen' => $codigoImagen);
                        if($profesor->actualizar($codigo, $data)){
                            $datos['imagen'] = $imagen->ruta($codigoImagen);
                        }
                    }
                }
             
                
                if($profesor->actualizar($codigo)){
                    $profesor->eliminarImparte($codigo);
                    if($this->input->post('asignatura') != ''){
                        foreach($this->input->post('asignatura') as $key => $asig){
                            $profesor->imparte($codigo, $key);

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
                    }
                   
                   $datos['formulario']['nombre']['input']['value'] = $profesor->nombre();
                   $datos['formulario']['apellido1']['input']['value'] = $profesor->apellido1();
                   $datos['formulario']['apellido2']['input']['value'] = $profesor->apellido2();
                   $datos['formulario']['fechaNacimiento']['input']['value'] =  date("m-d-Y", strtotime($profesor->fechaNacimiento()));
                   $datos['formulario']['dni']['input']['value'] = $profesor->dni();
                   $datos['formulario']['ncc']['input']['value'] = $profesor->ncc();            
                   $datos['formulario']['email']['input']['value'] = $profesor->email();
                   $datos['formulario']['texto']['input']['value'] = $profesor->texto();
                    
                   $datos['mensaje'] = 'El profesor ha sido actualizado satisfactoriamente';  
                }   
                else{
                    $datos['error'] = 'No se ha podido completar la actualización por favor inténtelo de nuevo más tarde';                        
                }    
            }
           
        }
        else{
            $datos['error'] = 'No existe el profesor indicado.';
        }
        
        
        $this->mostrar($datos);
    }
    
    public function buscar($campo = 'Nombre', $orden = 'asc', $limit='5', $busqueda = '', $offset = 0){
              
        $this->pagina = 'profesores';
        $this->titulo = 'buscar profesor';
        $this->menu = 'menu_profesor';
        $this->estilo = array('backend', 'tablas');
        $this->javascript=array('marcar_checkbox');
        
        
        $datos['busqueda'] = TRUE;
        $datos['backend'] = TRUE;
        
        if ($busqueda != '')
            $datos['buscador'] = array('class' => 'search-query input-medium', 'type'=>'text','name'=>'buscador', 'placeholder' => 'Buscar', 'value'=>urldecode($busqueda),'autofocus'=>'autofocus');
        else
            $datos['buscador'] = array('class' => 'search-query input-medium', 'type'=>'text','name'=>'buscador', 'placeholder' => 'Buscar', 'value'=>$this->input->post('buscador'),'autofocus'=>'autofocus');
        $datos['boton'] = array('class'=>'btn', 'id'=>'buscador', 'name'=>'button', 'value'=>'Buscar');
        $datos['borrar']= array('class'=>'btn btn-danger','id'=>'borrar', 'value'=>'Borrar selección','data-confirm'=>"¿Estás seguro?");
        $datos['fields'] = array(
                    'Nombre' => 'Nombre',
                    'Email' => 'Email',
                    'DNI' => 'DNI',                    
                    'FechaNacimiento' => 'F. nacimiento',
                    'FechaAlta' => 'Alta',
                    'FechaUltimoAcceso' => 'Último acceso'                    
            );
        
             
        
        if($this->_validarBusqueda() == FALSE){
            if($busqueda != ''){ 
                $busqueda = urldecode($busqueda);
                $busq_cant = Profesor_model::busqueda_cantidad($busqueda);
                $opciones = $this->seleccion($busq_cant);
                $datos['opciones'] = $opciones;
                if($this->input->post('cantidad') != ''){
                    if($opciones[$this->input->post('cantidad')] == 'Todo'){
                        $limit = $busq_cant;
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
                $datos['busq'] = $busqueda;
                $datos['profesores'] = Profesor_model::buscar($busqueda, $campo, $orden, $offset, $limit);
                $datos['numero'] = $busq_cant;
                
                $config = array();
                $config['base_url'] = base_url(). "admin/profesores/buscar/".$campo."/".$orden."/".$limit."/".$busqueda."/";
                $config['total_rows'] = $busq_cant;
                $config['per_page'] = $limit;
                $config['uri_segment'] = 8;
                $config['prev_link'] = 'anterior';
                $config['next_link'] = 'siguiente';
                $config['first_link'] = '<<';
                $config['last_link'] = '>>'; 
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="disabled"><a href="#">';
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
            }
            else{
                $datos['numero'] = 0;
                $datos['opciones'] = array(0);
                $datos['campo'] = $campo;
                $datos['orden'] = $orden;
                $datos['buscar'] = '';
                $datos['limit'] = 0;
                $datos['elementos'] = 0;
                $datos['busq']= '';
                $datos['vacio'] = TRUE;
            }
            $this->mostrar($datos);
        }
        
        else{
            $busqueda = $this->input->post('buscador');
            $busq_cant = Profesor_model::busqueda_cantidad($busqueda);
            $opciones = $this->seleccion($busq_cant);
            
            $datos['opciones'] = $opciones;

            if($this->input->post('cantidad') != ''){
                if($opciones[$this->input->post('cantidad')] == 'Todo'){
                    $limit = Profesor_model::numero();
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
            
            
            $datos['busq'] = $busqueda;
            $datos['profesores'] = Profesor_model::buscar($busqueda, $campo, $orden, $offset, $limit);
            $datos['numero'] = $busq_cant;
            
            $config = array();
            $config['base_url'] = base_url(). "admin/profesores/buscar/".$campo."/".$orden."/".$limit."/".$busqueda."/";
            $config['total_rows'] = $busq_cant;
            $config['per_page'] = $limit;
            $config['uri_segment'] = 7;
            $config['prev_link'] = 'anterior';
            $config['next_link'] = 'siguiente';
            $config['first_link'] = '<<';
            $config['last_link'] = '>>'; 
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="disabled"><a href="#">';
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
        }       

    }
    
    
    public function email($email){
        $this->pagina = 'email';
        $this->titulo = 'Enviar email';
        $this->estilo = array('formulario','profesor','noticia','backend','jquery-te-1.3.3');
        $this->javascript = array('editor', 'jquery-te-1.3.3.min');
        $this->menu = 'menu_profesor';
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        
        $email = urldecode($email);     
        $datos['email'] = $email;
        $datos['backend'] = TRUE;
       
        
        $datos['formulario'] = array(
            'asunto' => array('class'=>'input-xlarge', 'id'=> 'asunto' ,'name'=>'asunto', 'label' => 'Asunto', 'maxlength'=> '150', 'size'=>'50','type' => 'text', 'value' => $this->input->post('asunto'),'autofocus'=>'autofocus'),
            'contenido' => array('class' => 'editor', 'id' => 'contenido', 'name'=>'contenido', 'label' => 'contenido', 'value' => $this->input->post('contenido'))
        );
        
        $datos['boton'] = array( 'class'=> 'btn btn-primary', 'name'=>'button', 'id' => 'boton_noticia');
        
        
        
        if($this->_validarEmail()){
            $datosEmail = array(
                        'direccion' => 'barea@arquitectosdecadiz.com ',
                        'nombre'    => 'Barea Arquitectos',
                        'asunto'    => $this->input->post('asunto'),
                        'texto'     => $this->input->post('contenido'),
                        'destino' => $email
            );  
                
            $this->my_phpmailer->Enviar($datosEmail);
            $this->exito = 'El email se ha enviado satisfactoriamente';          
              
        }
        $this->mostrar($datos);
    }
    
/*    
    public function borrar($email = ''){
        
        if($email != ''){ 
            if(Usuario_model::existe(urldecode($email))){ 
                $usuario = new Usuario_model;
                $usuario->email(urldecode($email));
                $usuario->eliminar();
            }
        }
        else{  
            if($this->input->post('checkbox') != ''){            
                $emails = $this->input->post('checkbox');
                
                foreach($emails as $email){
                    if(Usuario_model::existe(urldecode($email))){
                        $usuario = new Usuario_model;
                        $usuario->email($email);
                        $usuario->eliminar();
                    }
                }
            }
        }
        
        if($this->uri->segment(2) == 'clientes'){
            redirect('admin/clientes');
        }
        elseif($this->uri->segment(2) == 'profesors'){
            redirect('admin/profesors');
        }     
    }
    
    
    public function formulario_registro(){
        $formulario_registro = array(           
            'nombre'=>array(
                    'label' => array('accesskey'=>'M', 'name'=>'No<u>m</u>bre'),
                    'input' => array('class'=>'nombre','name'=>'nombre','id'=>'nombre', 'maxlength'=>'60', 'size'=>'15',  'autofocus'=>'autofocus'),
                    'requerido'=>TRUE
            ),
            
            'apellidoPaterno'=>array(
                    'label' => array('accesskey'=>'L', 'name'=>'Primer ape<u>l</u>lido'),
                    'input' => array('class'=>'apellidoP','name'=>'primerApellido','id'=>'primerApellido', 'maxlength'=>'60', 'size'=>'15'),
                    'requerido'=>TRUE
            ),
                       
            'apellidoMaterno'=>array(
                    'label' => array('accesskey'=>'G', 'name'=>'Se<u>g</u>undo apellido'),
                    'input' => array('class'=>'apellidoM','name'=>'segundoApellido','id'=>'segundoApellido', 'maxlength'=>'60', 'size'=>'15'),
                    'requerido'=>TRUE
            ),
            
            'fechaNacimiento'=>array(
                    'label' => array('accesskey'=>'A', 'name'=>'Fech<u>a</u> de nacimiento'),
                    'input' => array('class'=>'fechaN','name'=>'fNacimiento','id'=>'fNacimiento', 'maxlength'=>'10', 'size'=>'15', 'placeholder'=>'mm/dd/aaaa'),
                    'requerido'=>TRUE
            ),
            
            'direccion'=>array(
                    'label' => array('accesskey'=>'', 'name'=>'Dirección'),
                    'input' => array('class'=>'direccion','name'=>'direccion','id'=>'direccion', 'maxlength'=>'60', 'size'=>'15'),
                    'requerido'=>FALSE
            ),
            
            'provincia'=>array(
                    'label' => array('accesskey'=>'', 'name'=>'Provincia'),
                    'input' => array('class'=>'provincia','name'=>'provincia','id'=>'provincia', 'maxlength'=>'60', 'size'=>'15'),
                    'requerido'=>FALSE
            ),
            
            'ciudad'=>array(
                    'label' => array('accesskey'=>'', 'name'=>'Ciudad'),
                    'input' => array('class'=>'ciudad','name'=>'ciudad','id'=>'ciudad', 'maxlength'=>'60', 'size'=>'15' ),
                    'requerido'=>FALSE
            ),
            
            'telefono'=>array(
                    'label' => array('accesskey'=>'', 'name'=>'Teléfono'),
                    'input' => array('class'=>'telefono','name'=>'telefono','id'=>'telefono', 'maxlength'=>'9', 'size'=>'10'),
                    'requerido'=>FALSE
            ),
            
            'email'=>array(
                    'label' => array('accesskey'=>'E', 'name'=>'<u>E</u>mail'),
                    'input' => array('class'=>'email','name'=>'email','id'=>'email', 'maxlength'=>'50', 'size'=>'15'),
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
            ),            
           
        );
        
        return $formulario_registro;
    }
    
    
    public function boton_registro(){
        $boton_registro = array(
            'name'=>'button', 
            'id'=>'boton_registro', 
            'value'=>'Enviar', 
            'class'=>'btn btn-primary',
            'data-confirm'=>'¿Desea continuar?'
        );
        
        return $boton_registro;
    }
    

    public function autorizacion(){        
        if ($this->session->userdata('usuario') == 'admin' || $this->session->userdata('usuario') == 'profesor'){
            $id = str_replace('@', '', $this->session->userdata('email'));
            $id = str_replace('.', '', $id);
            $presence_data = array('nombre' => $this->session->userdata('nombre'). ' '.$this->session->userdata('apellidos'), 'id'=>$id);
            echo $this->pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], $this->session->userdata('email'), $presence_data);
        }
        else{
          header('', true, 403);
          echo( "Acceso prohibido" );
        }  
    }
        
    
    public function sesion(){
         echo json_encode($this->session->userdata('email'));
    }
*/    
    

    
    /*Callbacks para validación de formulario de inicio de sesión */
    public function existeProfesor($email){ 
        $aux = FALSE;
        if(Profesor_model::existe($email, TRUE)){
            $aux = TRUE;
        }
        return $aux;
    }
    
    public function noExisteProfesor($email){ 
        return !$this->existeProfesor($email, TRUE);
    }
    
    
    public function profesorValidado($email){
        $aux = FALSE;
        $usuario =  new Profesor_model;
        if($usuario->validado($email))
            $aux = TRUE;
        return $aux;
    }
    
    
    public function numeroIntentos($email){
        $aux = FALSE;
        $profesor = new Profesor_model;
        $fecha_esp = str_replace("/", "-", $profesor->fechaUltimoIntento($email));
        $fecha1 =  strtotime($fecha_esp); 
        $fecha2 = strtotime(date('Y/m/d H:i:s'));
        $resultado = $fecha2 - $fecha1;
        
        $horas = $resultado / 60 / 60;
        
        if($profesor->numeroIntentos($email) <= 3){
            $aux =TRUE;
        }      
        else if($profesor->numeroIntentos($email) > 3 && $horas >= 2){
            $act = array('Email' => $email, 'NumeroIntentos' => 0);
            $profesor->actualizar($email, $act);
            $aux = TRUE;
        }      
                    
        return $aux;        
    }
    
    
    public function confirmarPassword($email){
        $aux = $this->existeProfesor($email);
        if($aux){
            $profesor = new Profesor_model;
            $cod = $profesor->codigo($email);
            $profesor->datos($cod);
            if(md5($this->input->post('pass')) != $profesor->pass()){
                $act = array(
                    'Email' => $email,
                    'NumeroIntentos' => $profesor->numeroIntentos() + 1, 
                    'FechaUltimoIntento' => date('Y/m/d H:i:s')
                );
                $profesor->actualizar($cod,$act);
                $aux = FALSE;    
            }     
        }
        return $aux;
    }
    
    
    public function verificarCaptcha($captcha){
        return $this->captcha_model->verificar_captcha($captcha);
    }
}

?>