<?php
include_controller('app');
use appController as app;

if(isset($_POST['val'])){
	$yid = preg_replace('#[^0-9]#', '', $_POST['yid']);
	$val = preg_replace('#[^a-zA-Z0-9()]#', '', $_POST['val']);
	app::fetch_list($yid, $val);
}else{
	app::error();
}