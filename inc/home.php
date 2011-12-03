<!DOCTYPE HTML>
<html lang="fr-FR">
    <head>
	<meta charset="UTF-8" />
	<title><?php echo PL_SITENAME; ?></title>
    </head>
    <body>
		<h1><?php echo PL_SITENAME; ?></h1>
		<p>Génération simple d'images "placeholder"</p>
		<table>
		    <tbody>
	        	<tr>
		            <td>
						<img src="<?php echo PL_URL; ?>200" alt="" /><br />
						<input type="text" value="<?php echo PL_URL; ?>200" style="width:195px;" />
		            </td>
		            <td>
						<img src="<?php echo PL_URL; ?>300/200" alt="" /><br />
						<input type="text" value="<?php echo PL_URL; ?>300/200" style="width:295px;" />
		            </td>
		        </tr>
		    </tbody>
		</table>
    </body>
</html>