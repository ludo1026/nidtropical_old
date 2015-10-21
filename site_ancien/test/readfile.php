<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
<title>Fichier</title>
<link rel="stylesheet" type="text/css" media="all" href="exemples.css" />
</head>
<body>
<?
set_magic_quotes_runtime(-1);
 
// nom du fichier

$fichier = $_POST['file'];
if(strlen($fichier) <= 0) {
$fichier = $_GET['file'];
}
?>

<a href="/test/listfiles.php?file=<? echo $dirname ?>">Retour</a>

<?
echo $fichier;

$content = $_POST['content'];
if(strlen($content) > 0) {
    while((strpos($content,' ')) == 0 ) {
    	echo strpos($content," ");
        $content = substr($content,1,strlen($content)-1);
    }
    $fp = fopen($fichier, 'w');
    fputs($fp, $content);
    fclose($fp);
}

  // on formate nos données
  // voir le tutorial sur les fonctions, si besoin
  // Raison : ne jamais faire confiance à des données transmises par un utilisateur
  function formate_machaine($chaine)
  {
    // on supprime les \n et les |
    $chaine = str_replace('\n', '', $chaine);
    $chaine = str_replace('|', '', $chaine);
    // on supprime les tags html et php
    $chaine = strip_tags($chaine);
    // on supprime les espaces superflus au début et à la fin
    $chaine = trim($chaine);
    // on coupe la chaine a 500 caracteres
    $chaine = substr($chaine, 0, 500);
    // renvoi nouvelle valeur
    return $chaine;
  }
  function formate_source($chaine)
  {
    // on remplace les < et >
    $chaine = str_replace('<', '&lt;', $chaine);
    $chaine = str_replace('>', '&gt;', $chaine);
    // renvoi nouvelle valeur
    return $chaine;
  }
?>
  <h1>Fichier : <? echo $fichier?></h1>
  <form method="post" action="/test/readfile.php">
  <input type="hidden" name="file" value="<? echo $fichier?>"/>
  <textarea style="width: 100%; height: 100%" rows="50" name="content"><?
  if(file_exists($fichier))
  {
    $fp = fopen($fichier, 'r'); // le fichier existe, on l'ouvre
    while (!feof($fp)) // On parcours le fichier
    {
    	$ligne = fgets($fp, 4096); // On se déplace d'une ligne 
    	// Teste si la ligne contient le début du corps
    	$ligne = str_replace('\n', '', $ligne);
        $ligne = str_replace('\\\\', '\\', $ligne);
        $ligne = str_replace('\\"', "\"", $ligne);
        echo $ligne;
    } 
    fclose($fp);
  }
  else{ // le fichier n'existe pas
    echo '<p>Fichier introuvable ! Lecture stoppée.</p>';
  }
  ?></textarea>
  <input type="button" onclick="this.form.submit()" value="Submit" />
  |
  <a href="/test/listfiles.php?file=<? echo $dirname ?>">Retour</a>
  </form>
  
<?
$dirname = substr($fichier,0,strrpos($fichier,"/"));
?>
  
</body>
</html> 
