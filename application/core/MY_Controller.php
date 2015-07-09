<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller{
    var $pagina     = '';
    var $titulo     = '';
    var $estilo     = '';
    var $javascript = '';
    var $menu       = '';

    public function __construct() {
        parent:: __construct();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger "> '
        . '<button type="button" class="close" data-dismiss="alert">&times;'
        . '</button><h4>Error</h4>', '</div>'); 
        $this->load->model('profesor_model','Profesor');
        $this->load->model('asignatura_model','Asignatura');
        $this->load->library('session');
    }
    
    public function mostrar($datos = ''){
        $cabecera = array(
                        'titulo'    =>  $this->titulo,
                        'estilo'    =>  $this->estilo,
                        'javascript'=>  $this->javascript,
                        'nombre'    =>  $this->session->userdata('nombre') . ' ' . $this->session->userdata('apellidos'),
                        'usuario'   =>  $this->session->userdata('usuario'),
                    );
        $this->load->view('plantillas/cabecera_paginas.php', $cabecera);
        if(!isset($datos['backend'])){
            $num = Profesor_model::numero();
            $profesores = Profesor_model::obtener('Nombre', 'asc', 0, $num);
            
            $data['profesores'] = array();
            if(!empty($profesores)){            
                foreach($profesores as $profesor){
                    $data['profesores'][$profesor->Codigo] = $profesor->Nombre. ' '. $profesor->Apellido1.' '. $profesor->Apellido2;
                }
            }
            
            $num = Asignatura_model::numero();
            $asignaturas = Asignatura_model::obtener('Nombre', 'asc', 0, $num);
            $data['asignaturas'] = array();
            if(!empty($asignaturas)){
                foreach($asignaturas as $asignatura){
                    $data['asignaturas'][$asignatura->Codigo] = $asignatura->Nombre;
                }
            }

            $this->load->view('plantillas/header_paginas.php', $data);
            $this->load->view('paginas/'.$this->pagina, $datos);
            $this->load->view('plantillas/pie_paginas.php', $datos);
        }
        else{
            if($this->uri->segment('1') != 'login'){
                $data = '';
                if($this->uri->segment('2') != 'calendario'){
                    $preferencias = array(
                        'show_next_prev' => FALSE,
                        'start_day'    => 'monday',
                    );

                    $preferencias['template'] = '
                        {table_open}<table class="calendario table table-condensed table-bordered hidden-sm">{/table_open}

                        {heading_row_start}<tr>{/heading_row_start}


                        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}


                        {heading_row_end}</tr>{/heading_row_end}

                        {week_row_start}<tr>{/week_row_start}
                        {week_day_cell}<td >{week_day}</td>{/week_day_cell}
                        {week_row_end}</tr>{/week_row_end}

                        {cal_row_start}<tr>{/cal_row_start}
                        {cal_cell_start}<td>{/cal_cell_start}

                        {cal_cell_no_content}
                             <div >{day}</div>
                        {/cal_cell_no_content}

                        {cal_cell_no_content_today}
                             <div id="hoy">{day}</div>
                        {/cal_cell_no_content_today}

                        {cal_cell_blank}&nbsp;{/cal_cell_blank}

                        {cal_cell_end}</td>{/cal_cell_end}
                        {cal_row_end}</tr>{/cal_row_end}

                        {table_close}</table>{/table_close}
                    ';

                    $this->load->library('calendar', $preferencias);
                    $data['calendar'] = $this->calendar->generate();
                }
                
                if(is_array($this->javascript)){
                    array_push($this->javascript, 'confirmacion');                              
                    $cabecera['javascript'] = $this->javascript;
                }
                else{
                    $cabecera['javascript'] = array($this->javascript, 'confirmacion');
                }
                $this->load->view('plantillas/header_backend.php', $cabecera);
                $this->load->view('plantillas/menu_lateral_admin.php',$data);
                if($this->menu != ''){
                    $this->load->view('plantillas/'.$this->menu);
                }
            }
            $this->load->view('backend/'.$this->pagina, $datos);
        }
    }
    
    public function permisos($user){
        if($this->session->userdata('logged_in') == TRUE){ 
            if($user != $this->session->userdata('usuario')){ 
                if($this->session->userdata('usuario') == 'admin'){
                    redirect('admin/novedades'); 
                }
                if($this->session->userdata('usuario') == 'profesor'){
                    redirect('profesor/novedades');
                }
            }
        }
        else{
            redirect('login');
        }
    }
    
    public function seleccion($cantidad){
        $aux = 0;
        $opciones = array();
        while($cantidad > 5){
            $cantidad  = $cantidad - 5;
            $aux = $aux + 5;
            $opciones[] = $aux;
        }
        array_push($opciones, 'Todo');
        return $opciones;
    }
    
    public function base(){
        $base = base_url();
        $base = substr($base, 0, -1);
        return $base;
    }
    

}
