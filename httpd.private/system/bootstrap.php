<?php
$lang = array();
define("SKIN", "original");
define("SITENAME", "PHP Mortality Index UK");
define("BASEURL", "/");
define("IMGURL", BASEURL."assets/images/");
define("DS", DIRECTORY_SEPARATOR);
define("RT", getcwd() . DS);
$root = (strpos(RT, DS.'httpd.www'.DS) !== false)? substr(RT, 0, strpos(RT, DS.'httpd.www')) : RT;
define("ROOT", $root.DS);
define("PUROOT", ROOT."httpd.www".DS);
define("PROOT", ROOT."httpd.private".DS);
define("APP", PROOT."app".DS);
define("VIEWS", APP."views".DS);
define("SYS", PROOT."system".DS);
define("CONTROLLER", APP."controllers".DS);
define("MODEL", APP."models".DS);
define("SYSCONT", SYS."controllers".DS);

require(APP.'locale'.DS.'en'.DS.'front.php');
require(SYSCONT.'appController.php');
require(SYSCONT.'routesController.php');
require(SYSCONT.'viewController.php');

include_once(SYS.'functions.php');
include_once($_GET['route'] != 'postRequest')? '../httpd.private/routes/web.php' : '../httpd.private/routes/'.$_GET['route'].'.php';