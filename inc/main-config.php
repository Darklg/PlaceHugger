<?php

if(!defined('PL_SITENAME')){
	define('PL_SITENAME','PlaceHugger');
}


// On récupère les images utilisables
$images_temp = glob(PL_DIR.'images/*.jpg');
if(empty($images_temp)){
	exit('Ajoutez des images dans images/ pour continuer ;)');
}
