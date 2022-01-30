<?php
include_model('app');
use appModel as app;
class appController {

	public static function index(){
		$metadata['meta']['title'] = SITENAME;
		$metadata['meta']['description'] = SITENAME;

		$data['mortality_type'] = app::fetch_desc(1);

		$footdata['copyright'] = '&#169; '.date('Y').' '.SITENAME;

		view::build('head', $metadata).
		view::build('side_nav', $data).
		view::build('app', $data).
		view::build('foot', $footdata);
	}

	public static function fetch_list($yid, $mtype){
		$data['mtype'] = app::fetch_list($yid, $mtype);
		$data['years'] = app::fetch_years($yid, $mtype);
		view::build('request'.DS.'fetch_list', $data);
	}

	public static function fetch_desc($yid){
		$data['mortality_type'] = app::fetch_desc($yid);
		view::build('request'.DS.'fetch_desc', $data);
	}
	
	public static function error(){
		$metadata['meta']['title'] = SITENAME.' - Page not found';
		$metadata['meta']['description'] = SITENAME.' - Page not found';

		$data['content'] = 'Page not found';

		$footdata['copyright'] = '&#169; '.date('Y').' '.SITENAME;

		view::build('head', $metadata).
		view::build('error', $data).
		view::build('foot', $footdata);
	}

}