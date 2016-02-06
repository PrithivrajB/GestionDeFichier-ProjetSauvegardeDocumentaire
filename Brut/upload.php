<!DOCTYPE html>
<html>

     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title></title>
          <link rel="stylesheet" href="">
     </head>

     <body>
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
     </body>
     
</html>


