<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
<title>Fichier</title>
<link rel="stylesheet" type="text/css" media="all" href="exemples.css" />
</head>
<body>
<?
set_magic_quotes_runtime(0);
 
// nom du fichier
$fichier = $_POST['file'];

$content = $_POST['content'];
?>

<h1>Fichier : <? echo $fichier; ?></h1>

<textarea style="width: 100%; height: 100%" rows="10" name="content">
<? echo $content; ?>
</textarea>

<?
$fp = fopen($fichier, 'w');
fputs($fp, $content);
fclose($fp);
?>

<a href="/test/readfile.php?file=<? echo $fichier ?>">Retour</a>

</body>
</html>