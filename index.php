<?php
define('PL_DIR',dirname(__FILE__).'/');

$config_file = PL_DIR.'/pl-config.php';

if(file_exists($config_file)){
	include $config_file;
} else {
	include PL_DIR.'inc/install.php';
}

include PL_DIR.'inc/main-config.php';

// Si aucune valeur, page de présentation.
if(!isset($_GET['width'])){
	include PL_DIR.'inc/home.php';
	exit();
}

// On recupere les valeurs depuis GET
$width = (isset($_GET['width']) && ctype_digit($_GET['width'])) ? $_GET['width'] : 100;
$height = (isset($_GET['height']) && ctype_digit($_GET['height'])) ? $_GET['height'] : $width;
$filename = 'cache/'.$width.'x'.$height.'.jpg';

// Si un cache existe et est demandé
if(file_exists(PL_DIR.$filename) && !isset($_GET['new'])){
	header('location:'.PL_URL.$filename);
	exit();
}

// On génère l'image demandée
include dirname(__FILE__).'/inc/image.php';