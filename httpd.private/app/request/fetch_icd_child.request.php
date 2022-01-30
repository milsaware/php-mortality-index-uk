<?php
include_controller('icd10');
use icd10Controller as icd10;

if(isset($_POST['parent_id'])){
	$parent_id = preg_replace('#[^A-Za-z0-9]#', '', $_POST['parent_id']);
	icd10::fetch_child_list($parent_id);
}else{
	icd10::error();
}