<?php
$config_file = dirname(__FILE__).'/pl-config.php';
if(file_exists($config_file)){
	include $config_file;
} else {
	define('TPL_DIR',dirname(__FILE__).'/');
	include TPL_DIR.'inc/install.php';
}

include dirname(__FILE__).'/inc/main-config.php';

// Si aucune valeur, page de présentation.
if(!isset($_GET['width'])){
	include dirname(__FILE__).'/inc/home.php';
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