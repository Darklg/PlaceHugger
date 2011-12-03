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

// Le fichier est au format JPG
header ("Content-type: image/jpg");

// On genere l'image finale ( si un fichier aleatoire n'est pas demandé )
if($mode != 'new'){
	imagejpeg($image,PL_DIR.$filename);
}

// On affiche l'image finale
imagejpeg($image);

