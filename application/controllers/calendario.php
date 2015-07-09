<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendario extends MY_Controller{
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('asignatura_model');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
    }
    
    public function calendarioMes($year = '', $month=''){
        $this->pagina = 'calendario';
        //$this->menu = 'menu_calendario';
        $this->titulo = 'Calendario';
        $this->estilo = array('backend','calendario');
        $this->javascript = 'tooltip';      
        
        $datos['backend'] =TRUE;
        
        if($this->uri->segment(1) == 'admin'){
            $this->permisos('admin');
                    
            $preferencias = array(
                'show_next_prev' => TRUE,
                'next_prev_url'=> base_url()."admin/calendario",
                'start_day'    => 'monday',
            );
        }
        else{
            $this->permisos('profesor');            
            
            $preferencias = array(
                'show_next_prev' => TRUE,
                'next_prev_url'=> base_url()."profesor/calendario/$proyecto",
                'start_day'    => 'monday',
            );
        } 
        
        $preferencias['template'] = '
               {table_open}<table class="table table-condensed table-bordered">{/table_open}

               {heading_row_start}<tr>{/heading_row_start}

               {heading_previous_cell}<th class="prev"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
               {heading_title_cell}<th class="cabecera" colspan="{colspan}">{heading}</th>{/heading_title_cell}
               {heading_next_cell}<th class="post"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

               {heading_row_end}</tr>{/heading_row_end}

               {week_row_start}<tr>{/week_row_start}
               {week_day_cell}<td class="days_week">{week_day}</td>{/week_day_cell}
               {week_row_end}</tr>{/week_row_end}

               {cal_row_start}<tr>{/cal_row_start}
               {cal_cell_start}<td>{/cal_cell_start}

               {cal_cell_content}
                    <div class="days">{day}</div>
                    {content}
               {/cal_cell_content}

               {cal_cell_content_today}
                    <div class="days" id="today">{day}</div>
                    <div>{content}</div>
               {/cal_cell_content_today}

               {cal_cell_no_content}
                    <div class="days">{day}</div>
               {/cal_cell_no_content}

               {cal_cell_no_content_today}
                    <div class="days" id="today">{day}</div>
               {/cal_cell_no_content_today}

               {cal_cell_blank}&nbsp;{/cal_cell_blank}

               {cal_cell_end}</td>{/cal_cell_end}
               {cal_row_end}</tr>{/cal_row_end}

               {table_close}</table>{/table_close}
        ';

        $this->load->library('calendar', $preferencias);
        $datos['calendario'] = $this->calendar->generate($year, $month);
        
        
        $this->mostrar($datos);
    }
    
    public function calendarioSemana($year = '', $month = '', $day = ''){
        $this->pagina = 'semana';
        $this->carpeta = 'empleado';
        //$this->menu = 'menu_calendario';
        $this->titulo = 'Calendario';
        $this->estilo = array('backend','calendario');
        $this->javascript = 'tooltip';
        
             
        $datos['backend'] =TRUE;
        
        if($year == '') {
            $year = date('Y');
        }        
        if($month == '') {
            $month = date('m');
        }        
        if($day == '') {
            $day = date('d');        
        }
        
        $calendarPreference = array (
            'start_day'    => 'lunes',
            'month_type'   => 'abr',
            'day_type'     => 'long',
            'date'     => date(mktime(0, 0, 0, $month, $day, $year)),
            'url' => 'admin/calendario/semana/',
        ); 

        $this->load->library('calendar_week', $calendarPreference);

        
        $this->mostrar($datos);
    }
    
    public function calendarioDia($year="", $month="", $day=""){
        $this->pagina = "dia";
        $this->carpeta = 'empleado';
        //$this->menu = 'menu_calendario';
        $this->titulo = 'Calendario';
        $this->estilo = array('backend','calendario');
        $this->javascript = 'tooltip';
        
        $datos['backend'] = TRUE;
        
         if($year == '') {
            $year = date('Y');
        }        
        if($month == '') {
            $month = date('m');
        }        
        if($day == '') {
            $day = date('d');        
        }
        
        if($this->uri->segment(1) == 'admin'){
            $datos['user'] = "admin";
        }
        else{
            $datos['user'] = "profesor";
        }
        
        $arrayMeses = array('','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $arrayDias = array( 'Domingo', 'Lunes', 'Martes','Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $fecha = $year.'-'.$month.'-'.$day;        



        $mes = date('m', strtotime($fecha));
        if($mes < 10)
            $mes = $mes % 10;
        $fecha = $arrayDias[date('w',strtotime($fecha))].", ".date('d',strtotime($fecha))." de ".$arrayMeses[$mes]." de ".date('Y',strtotime($fecha));            
        $datos['fecha'] = $fecha;
        $fecha = $month.'/'.$day.'/'.$year;
        $datos['yearAdd'] = date('Y', strtotime($fecha ."+1 day" ));
        $datos['yearLess'] = date('Y', strtotime($fecha . "-1 day"));
        $datos['monthAdd'] = date('m', strtotime($fecha . "+1 day"));
        $datos['monthLess'] = date('m', strtotime($fecha . "-1 day"));
        $datos['dayAdd'] = date('d', strtotime($fecha . "+1 day"));
        $datos['dayLess'] = date('d', strtotime($fecha . "-1 day"));
        
        
        $this->mostrar($datos);
    }
}

?>