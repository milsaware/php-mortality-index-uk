<?php
include_model('icd10');
use icd10Model as icd10;
class icd10Controller {

	public static function index(){
		$metadata['meta']['title'] = SITENAME;
		$metadata['meta']['description'] = SITENAME;

		$data['chapters'] = icd10::fetch_chapters();

		$footdata['copyright'] = '&#169; '.date('Y').' '.SITENAME;

		view::build('head', $metadata).
		view::build('icd10', $data).
		view::build('foot', $footdata);
	}
	
	public static function fetch_parent_list($chapter){
		$data['parent_options'] = icd10::fetch_parent_list($chapter);
		view::build('request'.DS.'fetch_parent_list', $data);
	}
	
	public static function fetch_child_list($parent_id){
		$data['child_options'] = icd10::fetch_child_list($parent_id);
		view::build('request'.DS.'fetch_child_list', $data);
	}

}