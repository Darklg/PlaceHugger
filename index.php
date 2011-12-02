<?php
$config_file = dirname(__FILE__).'/config.php';
if(file_exists($config_file))
	include $config_file;
else {
	define('TPL_DIR',dirname(__FILE__).'/');
	include TPL_DIR.'inc/install.php';
}


// Si aucune valeur, page de présentation.
if(!isset($_GET['width'])){
	echo '<div><img src="'.PL_URL.'300/200" alt="" /><br /><input type="text" value="'.PL_URL.'300/200" style="width:300px;" /></div>';
	exit();
}

// On recupere les valeurs depuis GET
$width = (isset($_GET['width']) && ctype_digit($_GET['width'])) ? $_GET['width'] : 100;
$height = (isset($_GET['height']) && ctype_digit($_GET['height'])) ? $_GET['height'] : $width;
$filename = 'cache/'.$width.'-'.$height.'.jpg';

// Si un cache existe et est demandé
if(file_exists(PL_DIR.$filename) && !isset($_GET['new'])){
	header('location:'.PL_URL.$filename);
	exit();
}

// On génère l'image de base
$image = imagecreatetruecolor($width, $height);

// On genere l'image temporaire
$images_temp = glob(PL_DIR.'images/*.jpg');

if(empty($images_temp)){
	exit('Aucune image pour travailler.');
}
$img_temp = $images_temp[rand(0, count($images_temp)-1)];
$image_temp = imagecreatefromjpeg($img_temp); 


// On redimensionne l'image temporaire
$image_temp_x = imagesx($image_temp);
$image_temp_y = imagesy($image_temp);

$rapport_image_temp = $image_temp_x / $image_temp_y;
$rapport_base = $width / $height;

$width_redim = $width;
$height_redim = $height;

$dst_x = 0;
$dst_y = 0;

if($rapport_image_temp > $rapport_base){
	$height_redim = $height;
	$width_redim = $rapport_image_temp*$height;
	$dst_x = ($width-$width_redim)/2;
}
else if($rapport_image_temp < $rapport_base){
	$width_redim = $width;
	$height_redim = $width / $rapport_image_temp;
	$dst_y = ($height-$height_redim)/2;
}
imagecopyresampled($image, $image_temp, $dst_x, $dst_y, 0, 0, $width_redim, $height_redim, $image_temp_x, $image_temp_y);

// Le fichier est au format JPG
header ("Content-type: image/jpg");

// On genere l'image finale
imagejpeg($image,PL_DIR.$filename);
imagejpeg($image);

