<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
     
class Calendar_week {

        var $CI;
        var $lang;
        var $template           = '';
        var $start_day          = 'domingo';
        var $month_type         = 'long';
        var $day_type           = 'abr';
        var $week_days = Array();
        var $date = '';
        var $url                = '';

        function Calendar_week($config = array()){
                $this->CI =& get_instance();

                if ( ! in_array('calendar_lang'.EXT, $this->CI->lang->is_loaded, TRUE)) {
                        $this->CI->lang->load('calendar');
                }

                if (count($config) > 0) {
                        $this->initialize($config);
                }

                if ($this->date==null){
                        $this->date = date(mktime());
                 }

                $this->set_week();

                log_message('debug', "Calendar_week Class Initialized");
        }

  
        function initialize($config = array()) {
                foreach ($config as $key => $val) {
                        if (isset($this->$key)) {
                                $this->$key = $val;
                        }
                }
        }

        function set_range(){
                switch ($this->start_day){
                        case 'domingo':
                                return range(0,6);
                                break;
                            
                        case 'lunes':
                                return range(1,7);
                                break;
                            
                        case 'martes':
                                return range(2,8);
                                break;

                        case 'miércoles':
                                return range(3,9);
                                break;

                        case 'jueves':
                                return range(4,10);
                                break;

                        case 'viernes':
                                return range(5,11);
                                break;

                        case 'sábado':
                                return range(6,12);
                                break;                         
                }
                return range(0,6);
        }

        function set_week() {

           $week_days = $this->set_range();
           $week_day = date('w',$this->date);
           
           foreach($week_days as $key=>$day) {  
                if($day == $week_day) {                    
                    $week_days[$key] = $this->date;
                } 
                elseif($day < $week_day) {
                    $week_days[$key] = strtotime('-'.$week_day+$day.' day',$this->date);
                } 
                elseif($day > $week_day) {
                    $week_days[$key] = strtotime('+'.$day-$week_day.' day',$this->date);
                }
            }

            $this->week_days = $week_days;
        }

        function get_week(){
                return $this->week_days ;
        }

        function generate($data=''){
                $days = $this->get_day_names();
                $months = $this->get_month_name();

                $tmpHeader = '<td class="days_week"> Hora </td>';
                $tmpContent = '';

                for ($i=0;$i<count($this->week_days);$i++){
                    $tmpHeader .= '<td class="days_week">'.$days[date('w', $this->week_days[$i])].' '.date('d', $this->week_days[$i]).'</td>';
                    $month = $months[date('n', $this->week_days[$i])-1] ;
                }
                for($j=0; $j!= 14; $j++){
                    $hour = $j+9;
                    $tmpContent.='<tr> <td class="days_week">'.$hour.':00 </td>';                    
                    for ($z=0;$z<count($this->week_days);$z++){
                        $tmpContent .= '<td></td>';                        
                    }
                    $tmpContent .= '</tr>';
                }
               
                        
                
                $before = strtotime('-4 day',$this->week_days[0]);
                $after = strtotime('+1 day',$this->week_days[count($this->week_days)-1]);

                $template = '<table class="table table-condensed table-bordered">
                                <tr>
                                    <th colspan="3" class="prev"><a href="' . site_url($this->url . date('Y',$before).'/'.date('m',$before).'/'.date('d',$before)) . '"> << </a></th>
                                    <th class="cabecera">' . $month .'</th>
                                    <th colspan="4" class="post"><a href="' . site_url($this->url . date('Y',$after).'/'.date('m',$after).'/'.date('d',$after)) . '"> >> </a></th>
                                </tr>
                                <tr>                                    
                                    '.$tmpHeader.'                                    
                                </tr>
                                <tr>
                                    '.$tmpContent.'                                    
                                </tr>    ';

                return $template ;
        }      

        function get_month_name() {
                if ($this->month_type == 'short') {
                        $month_names = array('01' => 'cal_ene', '02' => 'cal_feb', '03' => 'cal_mar', '04' => 'cal_abr', '05' => 'cal_may', '06' => 'cal_jun', '07' => 'cal_jul', '08' => 'cal_ago', '09' => 'cal_sep', '10' => 'cal_oct', '11' => 'cal_nov', '12' => 'cal_dic');
                } else {
                        $month_names = array('01' => 'enero', '02' => 'febrero', '03' => 'marzo', '04' => 'abril', '05' => 'mayo', '06' => 'junio', '07' => 'julio', '08' => 'agosto', '09' => 'septiembre', '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre');
                }

                $months = array();
                foreach ($month_names as $val) {                       
                        $months[] = ($this->CI->lang->line($val) === FALSE) ? ucfirst($val) : $this->CI->lang->line($val);
                }

                return $months;
        }      

        function get_day_names($day_type = '')
        {
                if ($day_type != '')
                        $this->day_type = $day_type;

                if ($this->day_type == 'long') {
                        $day_names = array('domigo','lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado');
                } elseif ($this->day_type == 'short') {
                        $day_names = array('do','lu', 'mar', 'mie', 'jue', 'vie', 'sa');
                } else {
                        $day_names = array('d','l', 'm', 'x', 'j', 'v', 's');
                }

                $days = array();
                foreach ($day_names as $val) {                 
                        $days[] = ($this->CI->lang->line('cal_'.$val) === FALSE) ? ucfirst($val) : $this->CI->lang->line('cal_'.$val);
                }
                return $days;
        }              
}

?>
