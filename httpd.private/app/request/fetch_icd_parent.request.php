<?php
include_controller('icd10');
use icd10Controller as icd10;

if(isset($_POST['chapter'])){
	$chapter = preg_replace('#[^A-Z]#', '', $_POST['chapter']);
	icd10::fetch_parent_list($chapter);
}else{
	icd10::error();
}