<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura extends MY_Controller{
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('asignatura_model');
        $this->load->model('aula_model', 'Aula');
        $this->load->model('grupo_model', 'Grupo');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
    }
    
    private function _validarAsignatura(){
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required|xss_clean');
        $this->form_validation->set_rules('aula', 'Aula', 'trim|xss_clean');
        $this->form_validation->set_rules('texto', 'Texto', 'trim|required|min_length[6]|xss_clean');
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('min_length', '%s debe tener mínimo %s caracteres');
        $this->form_validation->set_message('xss_clean', ' %s no es válido');
        
        return $this->form_validation->run();
    }
    
    private function _validarBusqueda(){
        $this->form_validation->set_rules('buscador', 'Buscador', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s no puede estar vacio');
        $this->form_validation->set_message('xss_clean', ' %s no es una búsqueda válida');  
        
        return $this->form_validation->run();
    }
    
    public function registrar(){
        $this->permisos('admin');
        
        $this->pagina = 'registrar asignatura';
        $this->titulo = 'Registrar asigntura';
        $this->estilo = array('noticia','formulario','backend','jquery-te-1.3.3');
        $this->javascript = array('jquery-te-1.3.3.min','editor', 'aula'); 
        $this->menu = 'menu_asignatura';
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        
        $datos['backend'] = TRUE;
        $aulas = Aula_model::obtener();
        $datos['aulasAux'] = $aulas;
        $datos['aulas'] = array('0'=>'');
        foreach($aulas as $aula){
            $datos['aulas'][$aula->Codigo] = $aula->Nombre;
        }
        $datos['formulario'] = array(
            'nombre'=>array(
                    'label' => array('accesskey'=>'M', 'name'=>'No<u>m</u>bre'),
                    'input' => array('class'=>'nombre','name'=>'nombre','id'=>'nombre', 'maxlength'=>'40', 'size'=>'35',  'autofocus'=>'autofocus', 'value'=> $this->input->post('nombre')),
                    'requerido'=>TRUE
            ),
            
            'precio'=>array(
                    'label' => array('accesskey'=>'L', 'name'=>'Pr<u>e</u>cio'),
                    'input' => array('class'=>'precio','name'=>'precio','id'=>'precio', 'maxlength'=>'5', 'size'=>'5', 'value'=> $this->input->post('precio')),
                    'requerido'=>TRUE
            ),
            
            'aula'=>array(
                    'label' => array('accesskey'=>'A', 'name'=>'<u>A</u>ula'),
                    'input' => array('class'=>'aula','name'=>'aula','id'=>'aula'),
                    'requerido'=>FALSE
            ),
                       
            'texto'=>array(
                    'label' => array('accesskey'=>'D', 'name'=>'<u>D</u>escripción'),
                    'input' => array('class'=>'editor','name'=>'texto','id'=>'texto',  'type' => 'text', 'value'=> $this->input->post('texto')),
                    'requerido'=>TRUE
            )             
           
        );
        
        $datos['boton'] = array('name'=>'button','id'=>'boton_registro','value'=>'Enviar','class'=>'btn btn-primary');
        $datos['imagen'] = '';
       
        if($this->_validarAsignatura()){
            $asignatura = new Asignatura_model;
            if($asignatura->inicializar()){
                $datos['mensaje'] = 'Los datos de la asignatura se han registrado satisfactoriamente';
            }
            else{
                $datos['error'] = 'No se ha podido registrar la asignatura';
            }
        }
        
        
        $this->mostrar($datos);
        
    }
    
    public function editar($codigo){
        $this->permisos('admin');
        $this->pagina = 'registrar asignatura';
        $this->titulo = 'Editar asignatura';
        $this->estilo = array('noticia','formulario','backend','jquery-te-1.3.3');
        $this->javascript = array('jquery-te-1.3.3.min','editor', 'aula'); 
        $this->menu = 'menu_asignatura';
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
        
        $datos['codigo'] = $codigo;
        $datos['actualizar'] = TRUE;        
        $datos['backend'] = TRUE;
        
        $aulas = Aula_model::obtener();
        $datos['aulasAux'] = $aulas;
        $datos['aulas'] = array('0'=>'');
        foreach($aulas as $aula){
            $datos['aulas'][$aula->Codigo] = $aula->Nombre;
        }
        $datos['formulario'] = array(
            'nombre'=>array(
                    'label' => array('accesskey'=>'M', 'name'=>'No<u>m</u>bre'),
                    'input' => array('class'=>'nombre','name'=>'nombre','id'=>'nombre', 'maxlength'=>'40', 'size'=>'35',  'autofocus'=>'autofocus', 'value'=> $this->input->post('nombre')),
                    'requerido'=>TRUE
            ),
            
            'precio'=>array(
                    'label' => array('accesskey'=>'L', 'name'=>'Pr<u>e</u>cio'),
                    'input' => array('class'=>'precio','name'=>'precio','id'=>'precio', 'maxlength'=>'5', 'size'=>'5', 'value'=> $this->input->post('precio')),
                    'requerido'=>TRUE
            ),
            
            'aula'=>array(
                    'label' => array('accesskey'=>'A', 'name'=>'<u>A</u>ula'),
                    'input' => array('class'=>'aula','name'=>'aula','id'=>'aula'),
                    'requerido'=>FALSE
            ),
                       
            'texto'=>array(
                    'label' => array('accesskey'=>'D', 'name'=>'<u>D</u>escripción'),
                    'input' => array('class'=>'editor','name'=>'texto','id'=>'texto',  'type' => 'text', 'value'=> $this->input->post('texto')),
                    'requerido'=>TRUE
            )             
           
        );
        
        $datos['boton'] = array('name'=>'button','id'=>'boton_registro','value'=>'Enviar','class'=>'btn btn-primary');
        
        if(Asignatura_model::existe($codigo)){
            $asignatura = new Asignatura_model;
            $asignatura->datos($codigo);
            $datos['formulario']['nombre']['input']['value'] = $asignatura->nombre();
            $datos['formulario']['precio']['input']['value'] = $asignatura->precio();
            $datos['formulario']['texto']['input']['value'] = $asignatura->descripcion();
            $datos['formulario']['aula']['input']['value'] = $asignatura->aula();
            if($this->_validarAsignatura()){
                if($asignatura->actualizar($codigo)){
                    $datos['formulario']['nombre']['input']['value'] = $asignatura->nombre($codigo);
                    $datos['formulario']['precio']['input']['value'] = $asignatura->precio($codigo);
                    $datos['formulario']['texto']['input']['value'] = $asignatura->descripcion($codigo);
                    $datos['formulario']['aula']['input']['value'] = $asignatura->aula($codigo);
                    
                    $datos['mensaje'] = 'Los cambios se han realizado satisfactoriamente';
                }
                else{
                    $datos['error'] = 'No se han podido realizar los cambios indicados';
                }
            }

        }
        else{
            $datos['error'] = 'No existe la asignatura indicada.';
        }
        
        $this->mostrar($datos);
    }
    
    public function listar($campo = 'Nombre', $orden = 'asc', $limit='5', $offset = 0){
        $this->permisos('admin');                
        $this->pagina = 'asignaturas';               
        $this->menu = 'menu_asignatura';
        $this->titulo = $this->pagina;
        $this->estilo = array('backend','tablas');
        $this->javascript = array('marcar_checkbox', 'confirmacion');
        $datos['buscador'] = array('class' => 'search-query input-medium', 'type'=>'text','name'=>'buscador', 'placeholder' => "Buscar",'autofocus'=>'autofocus');
        $datos['boton'] = array('class'=>'btn', 'id'=>'buscador', 'name'=>'button', 'value'=>'Buscar');
        $datos['borrar']= array('class'=>'btn btn-danger confirm-toggle','id'=>'borrar', 'value'=>'Borrar selección','data-confirm'=>"¿Estás seguro?");
        $datos['backend'] = TRUE;
        
        $numero = Asignatura_model::numero();
        
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
                    'Precio' => 'Precio',
                                     
            );            
            
            $datos['asignaturas'] = Asignatura_model::obtener($campo, $orden, $offset, $limit);
            $aula = new Aula_model; 
            foreach($datos['asignaturas'] as &$aux){
                if($aux->CodigoAula != NULL){
                    $aux->Aula = $aula->nombre($aux->CodigoAula);
                }
                else{
                    $aux->Aula = 'No asignada';
                }
            }
                 
            $config = array();
            $config['base_url'] = base_url(). "admin/asignaturas/".$campo."/".$orden."/".$limit."/";
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
    
     public function informacion($codigo){ 
        if($this->uri->segment(1) == 'admin'){
            $this->permisos('admin');
            $this->pagina = 'asignatura';
            $this->menu = 'menu_asignatura';
            $this->titulo = $this->pagina;
            $this->estilo = array('backend','tablas');
            $this->javascript = array('campos','crearGrupo');
            $datos['backend'] = TRUE;
            
            $datos['semana'] = array(
                '1'=>'Lunes',
                '2'=>'Martes',
                '3'=>'Miércoles',
                '4'=>'Jueves',
                '5'=>'Viernes',
                '6'=>'Sábado',
                '7'=>'Domingo',
            );
            
            if(Asignatura_model::existe($codigo)){                
                $asignatura = new Asignatura_model;
                $datos['asignatura'] = $asignatura->datos($codigo);
                $datos['grupos'] = Grupo_model::obtener($codigo);
            }
            else{
                $datos['error'] = 'La asignatura indicada no existe';
            }
        } 
        else{ 
            $this->pagina = 'asignatura';
            $this->estilo = array('profesor','asignatura','general_paginas');
            $this->javascript = array(''); 

            if(Asignatura_model::existe($codigo)){
                $datos['existe'] = TRUE;
                $asignatura = new Asignatura_model;
                $datos['asignatura'] = $asignatura->datos($codigo);
                $this->titulo = $asignatura->Nombre;
            }        
            else{
                $datos['existe'] = FALSE;
            }
        }
        
        $this->mostrar($datos);
    }
    
    public function buscar($campo = 'Nombre', $orden = 'asc', $limit='5', $busqueda = '', $offset = 0){
        $this->permisos('admin');      
        $this->pagina = 'asignaturas';
        $this->titulo = 'buscar asignatura';
        $this->menu = 'menu_asignatura';
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
                    'Precio' => 'Precio',
                                     
            );            
        $datos['semana'] = array(
            '1'=>'Lunes',
            '2'=>'Martes',
            '3'=>'Miércoles',
            '4'=>'Jueves',
            '5'=>'Viernes',
            '6'=>'Sábado',
            '7'=>'Domingo',
        );            
        
        if($this->_validarBusqueda() == FALSE){
            if($busqueda != ''){ 
                $busqueda = urldecode($busqueda);
                $busq_cant = Asignatura_model::busqueda_cantidad($busqueda);
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
                $datos['asignaturas'] = Asignatura_model::buscar($busqueda, $campo, $orden, $offset, $limit);
                $aula = new Aula_model; 
                foreach($datos['asignaturas'] as &$aux){
                    if($aux->CodigoAula != NULL){
                        $aux->Aula = $aula->nombre($aux->CodigoAula);
                    }
                    else{
                        $aux->Aula = 'No asignada';
                    }
                }
                $datos['numero'] = $busq_cant;
                
                $config = array();
                $config['base_url'] = base_url(). "admin/asignaturas/buscar/".$campo."/".$orden."/".$limit."/".$busqueda."/";
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
            $busq_cant = Asignatura_model::busqueda_cantidad($busqueda);
            $opciones = $this->seleccion($busq_cant);
            
            $datos['opciones'] = $opciones;

            if($this->input->post('cantidad') != ''){
                if($opciones[$this->input->post('cantidad')] == 'Todo'){
                    $limit = Asignatura_model::numero();
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
            $datos['asignaturas'] = Asignatura_model::buscar($busqueda, $campo, $orden, $offset, $limit);
            $aula = new Aula_model; 
            foreach($datos['asignaturas'] as &$aux){
                if($aux->CodigoAula != NULL){
                    $aux->Aula = $aula->nombre($aux->CodigoAula);
                }
                else{
                    $aux->Aula = 'No asignada';
                }
            }
            $datos['numero'] = $busq_cant;
            
            $config = array();
            $config['base_url'] = base_url(). "admin/asignaturas/buscar/".$campo."/".$orden."/".$limit."/".$busqueda."/";
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
    
    public function borrar($codigo = ''){
        $asignatura = new Asignatura_model;       
         
        if($codigo != ''){   
            if(Asignatura_model::existe($codigo)){ 
                $asignatura->datos($codigo);
                $asignatura->eliminar($codigo);                  
            }
            redirect('admin/asignaturas'); 
        }
        else{
            if($this->input->post('checkbox') != ''){            
                $codigos = $this->input->post('checkbox');
                foreach($codigos as $codigo){
                    if(Asignatura_model::existe($codigo)){
                        $asignatura->datos($codigo);
                        $asignatura->eliminar($codigo);
                    }
                }               
            }            
            redirect('admin/asignaturas');                
        }
    }
}
