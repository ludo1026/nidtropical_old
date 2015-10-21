<?php
define('ROOT','../');
$dossierImages = ROOT.'img/images-slider/bungalow/';

include ("config.php");

// Connexion à la base de données MySQL
mysql_connec ();
    
if(isset($_GET['idSup']) && is_numeric($_GET['idSup'])){
   	//Suppression de l'image et de la ligne dans la bdd
	$result = mysql_query('SELECT img FROM slider_bungalow WHERE id="'.$_GET['idSup'].'"');
		
		//Supprimer l'image associée (ou pas si elle est utilisée dans un autre slide)
		$cur = mysql_fetch_assoc($result);
		$resultImageIdentique = mysql_query('SELECT COUNT(*) FROM slider_bungalow WHERE img="'.$cur['img'].'"');
		$count = mysql_fetch_assoc($resultImageIdentique);
		if($count['COUNT(*)']<=1)
			unlink($dossierImages.$cur['img']);
			
	//Supprime la ligne dans la bdd	
	mysql_query('DELETE FROM slider_bungalow WHERE id="'.$_GET['idSup'].'"');
	//Les slides qui suivent ont un identifiant décrémenté
	mysql_query('UPDATE slider_bungalow SET id=id-1 WHERE id>'.$_GET['idSup']);
}
if(isset($_GET['idChange1'])&& is_numeric($_GET['idChange1'])
	&& isset($_GET['idChange2'])&& is_numeric($_GET['idChange2'])){
		$result = mysql_query('SELECT id,titre,img FROM slider_bungalow WHERE id='.$_GET['idChange1'].' OR id='.$_GET['idChange2'].'');
		while($cur_item = mysql_fetch_assoc($result)){
			if($cur_item['id'] == $_GET['idChange1'])
				$id = $_GET['idChange2'];
			else
				$id = $_GET['idChange1'];
				
				mysql_query('UPDATE slider_bungalow SET titre = "'.$cur_item['titre'].'", img = "'.$cur_item['img'].'" WHERE id="'.$id.'"');
		}
	}
mysql_close();	
?>
