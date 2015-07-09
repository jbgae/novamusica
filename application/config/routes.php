<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['admin/aula/registrar'] = 'aula/registrar';
$route['admin/aula/eliminar/(:num)'] = 'aula/eliminar/$1';
$route['admin/asignatura/borrar/(:num)'] = 'asignatura/borrar/$1';
$route['admin/calendario/dia/(:num)/(:num)/(:num)'] = 'calendario/calendarioDia/$1/$2/$3';
$route['admin/calendario/dia'] = 'calendario/calendarioDia';
$route['admin/calendario/semana/(:num)/(:num)/(:num)'] = 'calendario/calendarioSemana/$1/$2/$3';
$route['admin/calendario/semana'] = 'calendario/calendarioSemana';
$route['admin/calendario/(:num)/(:num)'] = 'calendario/calendarioMes/$1/$2/$3';
$route['admin/calendario/(:num)'] = 'calendario/calendarioMes/$1';
$route['admin/calendario'] = 'calendario/calendarioMes';

$route['admin/cerrar'] = 'profesor/cerrarSesion';
$route['admin/alumno/registrar'] = 'alumno/registrar';
$route['admin/alumno/(:any)/(:any)/(:num)/(:num)'] = 'alumno/listar/$1/$2/$3/$4';
$route['admin/alumno/(:any)/(:any)'] = 'alumno/listar/$1/$2';
$route['admin/alumno'] = 'alumno/listar';
$route['admin/asignatura/informacion/(:num)'] = 'asignatura/informacion/$1';
$route['admin/asignatura/registrar'] = 'asignatura/registrar';
$route['admin/asignatura/editar/(:num)'] = 'asignatura/editar/$1';
$route['admin/asignaturas/(:any)/(:any)/(:num)/(:num)'] = 'asignatura/listar/$1/$2/$3/$4';
$route['admin/asignaturas/(:any)/(:any)'] = 'asignatura/listar/$1/$2';
$route['admin/asignaturas/buscar/(:num)/(:num)'] = 'asignatura/buscar/$1/$2';
$route['admin/asignaturas/buscar'] = 'asignatura/buscar';
$route['admin/asignaturas'] = 'asignatura/listar';
$route['admin/grupo/registrar'] = 'grupo/registrar';
$route['admin/noticias/borrar/(:num)'] =  'noticias/borrar/$1';
$route['admin/noticias/borrar'] = 'noticias/borrar';
$route['admin/noticias/buscar/(:num)'] = 'noticias/buscar/$1';
$route['admin/noticias/buscar'] = 'noticias/buscar';
$route['admin/noticias/crear'] = 'noticias/registrar';
$route['admin/noticias/editar/(:num)'] = 'noticias/modificar/$1';
$route['admin/noticias/(:any)/(:any)/(:num)/(:num)'] = 'noticias/listar/$1/$2/$3/$4';
$route['admin/noticias/(:any)/(:any)'] = 'noticias/listar/$1/$2';
$route['admin/noticias'] = 'noticias/listar';

$route['admin/profesor/registrar'] = 'profesor/registrar';
$route['admin/profesor/editar/(:num)'] = 'profesor/editar/$1';
$route['admin/profesor/enviar/(:any)'] = 'profesor/email/$1';
$route['admin/profesores/(:any)/(:any)/(:num)/(:num)'] = 'profesor/listar/$1/$2/$3/$4';
$route['admin/profesores/(:any)/(:any)'] = 'profesor/listar/$1/$2';
$route['admin/profesores/buscar/(:num)/(:num)'] = 'profesor/buscar/$1/$2';
$route['admin/profesores/buscar'] = 'profesor/buscar';
$route['admin/profesores'] = 'profesor/listar';

$route['clase/(:num)'] = "asignatura/informacion/$1";

$route['contacto'] = "paginas/contacto";
$route['default_controller'] = "paginas/inicio";
$route['inicio'] = "paginas/inicio";
$route['noticias'] = "noticias/listar";
$route['noticia/(:num)'] = "noticias/noticia/$1";
$route['politica'] = "paginas/politica";

$route['profesor/(:num)'] = 'profesor/informacion/$1';


$route['login'] = "profesor/iniciarSesion";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */