<?php
include_controller('app');
use appController as app;

if(isset($_POST['yid'])){
	$yid = preg_replace('#[^0-9]#', '', $_POST['yid']);
	app::fetch_desc($yid);
}else{
	app::error();
}