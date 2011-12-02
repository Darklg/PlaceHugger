<?php
$chemin_site = '';
$chemin_site_tmp = explode('/',$_SERVER['PHP_SELF']);
if(count($chemin_site_tmp) > 2){
	array_shift($chemin_site_tmp);
	array_pop($chemin_site_tmp);
	$chemin_site = implode('/',$chemin_site_tmp).'/';
	$ndd = $_SERVER['SERVER_NAME'];
}

// Creation du fichier de config
file_put_contents($config_file,"<?php\n".
"define('PL_DIR', '".TPL_DIR."');\n".
"define('PL_URL', 'http://".$ndd.'/'.$chemin_site."');\n");

// Re-Creation du htaccess
file_put_contents('.htaccess',"
Options +FollowSymlinks
RewriteEngine on
RewriteRule ^([0-9]+)$   /".$chemin_site."index.php?width=$1&height=$1 [L]
RewriteRule ^([0-9]+)/([0-9]+)$   /".$chemin_site."index.php?width=$1&height=$2 [L]
RewriteRule ^([0-9]+)/([0-9]+)/new$   /".$chemin_site."index.php?width=$1&height=$2&new [L]");

// Création du dossier cache
@mkdir(TPL_DIR.'cache/');
@chmod(TPL_DIR.'cache/',0755);

// Création du dossier images
@mkdir(TPL_DIR.'images/');
@chmod(TPL_DIR.'images/',0755);

// Reload après install.
echo '<script>location.reload(true);</script>';
die;