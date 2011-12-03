<?php

if(!defined('PL_SITENAME')){
	define('PL_SITENAME','PlaceHugger');
}

if(!defined('PL_DEBUG')){
	define('PL_DEBUG',FALSE);
}

// Modes d'appel de l'image
$modes = array(
	'default' => array(),
	'new' => array(),
	'dim' => array(),
);

// On récupère les images utilisables
$images_temp = glob(PL_DIR.'images/*.jpg');
if(empty($images_temp)){
	exit('Ajoutez des images dans images/ pour continuer ;)');
}
