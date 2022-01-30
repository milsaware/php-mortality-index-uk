<?php
use routesController as route;
$route = preg_replace('#[^a-z0-9_]#', '', $_GET['route']);
$whitelist = array(
		'findings',
		'home',
		'icd10'
	);

if(in_array($route, $whitelist)){
	route::get('home', 'app@index');
	route::get('icd10', 'icd10@index');
}

else{
	$data['meta']['title'] = SITENAME.' - page not found';
	$data['meta']['description'] = '';
		
	$data['content'] = 'Page not found';

	$data['copyright'] = '&#169; '.date('Y').' '.SITENAME;
	route::error($data);
}