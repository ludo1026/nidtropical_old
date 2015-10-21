<?php
 
if(isset($_FILES['photo']))
{
  // params
  unset($erreur);
  $extensions_ok = array('html', 'png', 'gif', 'jpg', 'jpeg');
  $taille_max = 500000;
  $dest_dossier = '.';
  // utilisez également des slashes sous windows : $dest_dossier  = 'd:/damien/photos/';
  // vérifications
  if( !in_array( substr(strrchr($_FILES['photo']['name'], '.'), 1), $extensions_ok ) )
  {
    $erreur = 'Veuillez sélectionner un fichier de type png, gif ou jpg !';  
  }
  elseif( file_exists($_FILES['photo']['tmp_name']) 
          and filesize($_FILES['photo']['tmp_name']) > $taille_max)
  {
    $erreur = 'Votre fichier doit faire moins de 500Ko !';
  }
  // copie du fichier
  if(!isset($erreur))
  {
    $dest_fichier = basename($_FILES['photo']['name']);
    // formatage nom fichier
    // enlever les accents
    $dest_fichier = strtr($dest_fichier, 
    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    // remplacer les caracteres autres que lettres, chiffres et point par _
    $dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
    // copie du fichier
    move_uploaded_file($_FILES['photo']['tmp_name'], $dest_dossier . $dest_fichier);
  }
}
 
?>
<html>
<body>
<!-- Erreur ? -->
<?php 
if(isset($erreur)){
  echo '<p>', $erreur ,'</p>';
}
?>
<!-- Formulaire -->
<!-- Attention, ne de ne pas oublier le  enctype="multipart/form-data" -->
<form method="POST" action="upload.php" enctype="multipart/form-data">
<!-- Limiter la taille des fichiers à 500Ko -->
<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> 
<fieldset>
<legend>Envoi de fichiers</legend>
<!-- champs d'envoi de fichier, de type file -->
<p><label for="photo">Photo :</label><input type="file" name="photo" /></p>
<!-- bouton d'envoi -->
<p><input type="submit" name="envoi" value="Envoyer les fichiers" /></p>
</legend>
</fieldset>
</form>
</body>
</html> 