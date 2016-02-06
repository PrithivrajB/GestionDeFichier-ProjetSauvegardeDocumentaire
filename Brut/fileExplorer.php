<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Thot - My Storage</title>
		<link rel="stylesheet" href="">
	</head>

	<body>

		<!-- DIV EXPLORATEUR DE FICHIER -->
		<div> 
 			<p>Fichier présent dans le dossier</p> 
 			<?php
				if(!isset($_GET['directory'])) //Pas de dossier en parametre alors ouverture du dossier uploads
				{
					$directory = './uploads';
					openDirectory($directory);
     			}
     			else
     			{
     				$directory = $_GET['directory'];
     				openDirectory($directory);
     			}

     			function openDirectory($directory){
     				echo '<ul>';
     				if($dossier = opendir($directory))
					{
						if(dirname($directory)!='.'){
							echo '<a href="fileExplorer.php?directory='.dirname($directory). '">RETOUR</a>';
						}
						while(false !== ($fichier = readdir($dossier)))
						{
							if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && is_dir($directory.'/'.$fichier)) /*Si $fichier correspond à un dossier...*/
							{
								$directoryPath = $directory.'/'.$fichier;
								echo '<li>[DOSSIER]<a href="fileExplorer.php?directory='.$directoryPath. '">' . $fichier . '</a></li>';
							}
							elseif ($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && is_file($directory.'/'.$fichier)) /*Si $fichier correspond à un fichier...*/
							{
								echo '<li>[FICHIER]<a href="'.$directory.'/' . $fichier . '">' . $fichier . '</a></li>';
							}	 
						}
						echo '</ul><br />';
	 					closedir($dossier);
	 				}
					else
	     				echo 'Le dossier n\' a pas pu être ouvert';
     			}
			?>
		</div>

	</body>

</html>




<?php
	/*--------------------------------------LA BASE - DEBUT---------------------------------*/ 
	// http://php.net/manual/fr/function.scandir.php
	// https://openclassrooms.com/courses/lister-le-contenu-d-un-dossier-avec-php
	// http://www.finalclap.com/faq/197-php-liste-fichier-dossier-recursif

	/*echo '<ul>';
	if($dossier = opendir('./uploads'))
	{
		$dossierNom = "uploads";
		while(false !== ($fichier = readdir($dossier)))
		{
			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
			{
				echo '<li><a href="./'.$dossierNom.'/' . $fichier . '">' . $fichier . '</a></li>';
			} 
			 
		}
		echo '</ul><br />';
			closedir($dossier);
		}
	else
			echo 'Le dossier n\' a pas pu être ouvert';*/
	/*--------------------------------------LA BASE - FIN ---------------------------------*/ 

	/*-----------------------------FONCTIONEMENT IS_DIR()------------------------------*/
	/*if(is_dir($dossierNom.'/'.$fichier))
	{
		echo '<li><a href="./'.$dossierNom.'/' . $fichier . '">' . $fichier . '</a></li>';
	}*/
?>