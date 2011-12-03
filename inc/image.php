<?php

// On génère l'image de base
$image = imagecreatetruecolor($width, $height);

// On recupere une image temporaire au hasard
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


// Si on est en mode dimensions : on ajoute les dimensions en dur dans l'image
if($mode == 'dim'){
	$hauteur_dim = 15;
	$calque_dim = imagecreatetruecolor($width, $hauteur_dim);
	$blanc = imagecolorallocate($calque_dim, 255, 255, 255);
	$noir = imagecolorallocate($calque_dim, 0, 0, 0);
	ImageFilledRectangle ($calque_dim, 0, 0, $width, $hauteur_dim, $noir);	
	imagestring($calque_dim, 2, 2, 0, $width.'x'.$height, $blanc);
	imagecopymerge($image, $calque_dim, 0, 0, 0, 0, $width, $hauteur_dim, 70);
}

// Le fichier est au format JPG
header ("Content-type: image/jpg");

// On genere l'image finale ( si un fichier aleatoire n'est pas demandé )
if($mode != 'new'){
	imagejpeg($image,PL_DIR.$filename,85);
}

// On affiche l'image finale
imagejpeg($image,NULL,85);

