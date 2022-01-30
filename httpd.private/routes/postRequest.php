<?php
if(isset($_GET['action'])){
	include_once('../httpd.private/system/bootstrap.php');
	$action = $_GET['action'];
	
	$whitelist = array(
		'fetch_desc',
		'fetch_icd_child',
		'fetch_icd_parent',
		'fetch_list'
	);

	if(in_array($action, $whitelist)){	
		require(APP.'request'.DS.$action.'.request.php');
	}
}
