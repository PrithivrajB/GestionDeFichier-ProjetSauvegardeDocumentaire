<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Thot - My Storage</title>
		<link rel="stylesheet" href="">
	</head>

	<body>

		<!-- FORMULAIRE UPLOAD FICHIER -->
		<div>
			<form method="POST" action="upload.php" enctype="multipart/form-data">	
		     	Fichier: <input type="file" name="fileToUpload">
		     	<input type="submit" name="sendFile" value="Envoyer le fichier">
			</form> 
			<?php
               if(isset($_FILES['fileToUpload']))
               { 
                    $dossier = 'uploads/';
                    $fichier = basename($_FILES['fileToUpload']['name']);
                    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                    {
                         echo 'Upload effectué avec succès !';
                         header('Location: ./index.php');
                    }
                    else //Sinon (la fonction renvoie FALSE).
                    {
                         echo 'Echec de l\'upload !';
                    }
               }

          ?>
		</div>

		<br>
		<!-- FORMULAIRE CREER UN NOUVEAU DOSSIER -->

		<div>
			<form method="POST" action="index.php">
				Creer un nouveau dossier: <input type="text" name="directoryName" required="required">
				<input type="submit" name="sendDirectoryName" value="Créer le dossier">
			</form>
			<?php
			     if(isset($_POST['directoryName']))
			     { 
			          $dir = './uploads';
			          $dirToCreate = $dir.'/'.$_POST['directoryName'];
			          if(!is_dir($dirToCreate)) 
			          { 
			               mkdir($dirToCreate); 
			               header('Location: ./index.php');
			          } 
			          else // Si le dossier existe déjà --> Envoi de la valeur true a la page index pour afficher message d'erreur 
			          {
			?>
			               <form method="post" action="index.php"><input type="text" value="TRUE" name="error"/></form>
			<?php
			               header('Location: ./index.php?FolderNameError=FALSE');
			          }
			     }
			?>
			<?php

				if (isset($_GET['FolderNameError']) && $_GET['FolderNameError']=='FALSE')
				{
					echo '<font color="red"><i>Ce dossier existe déjà</i></font>';
				}
			?>
		</div>

		<!-- DIV EXPLORATEUR DE FICHIER -->
		<div> 
 			<p>Fichier présent dans le dossier</p> 

 			<!-- PHP - EXPLORATEUR DOSSIER - DEBUT -->
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
							echo '<a href="index.php?directory='.dirname($directory). '">[RETOUR]'.basename(dirname($directory)).'</a>'; // basename retourne le nom du dossier courant  -- dirname retourne le chemein du dossier parent du dossier courant 
						}
						while(false !== ($fichier = readdir($dossier)))
						{
							if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && is_dir($directory.'/'.$fichier)) /*Si $fichier correspond à un dossier...*/
							{
								$directoryPath = $directory.'/'.$fichier;
								echo '<li>[DOSSIER]<a href="index.php?directory='.$directoryPath. '">' . $fichier . '</a></li>';
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
			<!-- PHP EXPLORER DOSSIER - FIN -->
		</div>
	</body>

</html>
