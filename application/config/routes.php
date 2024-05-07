<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages/view';
$route['fo'] = 'fopages/view';
$route['(:any)'] = 'pages/view/$1';
$route['fo/(:any)'] = 'fopages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
  