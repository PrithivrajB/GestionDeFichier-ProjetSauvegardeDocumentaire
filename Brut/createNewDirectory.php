<!-- SCRIPT PRESENT DANS L'INDEX -->
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
               header('Location: ./index.php');
          }
     }
?>