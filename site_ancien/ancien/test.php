<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? if($_GET['lien']=='photos'){  ?>
	<title>Vacances en Guadeloupe - Nid Tropical - Vous propose un s�jour en Guadeloupe, plong�e en guadeloupe</title>
	<meta name="description" content="les vacances en Guadeloupe avec Nid Tropical, c'est possible. Venez d�couvrir une large gamme de location bungalows en Guadeloupe et les h�bergements en Guadeloupe. De plus, le bungalow Guadeloupe ">
	<meta name="keywords" content="Bungalows guadeloupe, Bungalow guadeloupe, S�jour guadeloupe, Vacances guadeloupe, Plong�e guadeloupe, H�bergement guadeloupe, Location bungalows guadeloupe, H�bergements guadeloupe, sejours guadeloupe, sejour en guadeloupe, vacances en guadeloupe, hebergement en guadeloupe, location en guadeloupe, g�te en guadeloupe, loisirs en guadeloupe, catamaran en guadeloupe, randonn�e en guadeloupe">
<? }else{  ?>
		<title>G�tes guadeloupe - Nid Tropical - A d�couvrir l'appartement guadeloupe etl'h�bergement antilles</title>
		<meta name="description" content="Les g�tes en Guadeloupe avec Nid Tropical, ce n'est plus un r�ve. Venez d�couvrir le g�te en Guadeloupe et effectuez la location en Guadeloupe. Possibilit� aussi d'h�bergement aux Antilles.">
		<meta name="keywords" content="Gites guadeloupe, G�tes guadeloupe, G�te guadeloupe, Gite guadeloupe, Location guadeloupe, Appartement guadeloupe, H�bergement antilles, sejour en guadeloupe, croisi�re en guadeloupe, location en guadeloupe">
<? }  ?>
</head>
<style>
body{background-color:#FFFFCC;}

#global{width:100%;height:100%;}
</style>
<body>
	<div id="global">
		<div id="centre" align="left">
			<div>
				<table>
					<tr>
						<td width="50px">
						<? include('drapeau.php');  ?>
						</td>					
						<td>
						<? include('ENTETE-2.htm');  ?>
						</td>
					</tr>
					<tr>
						<td width="50px" valign="top">
						<? include('NAVIG-2.htm');  ?>
						</td>
						<td>
							<? 	
								if($_GET['lien']=='gites-guadeloupe-tarifs'){
									include('TARIF.HTM');
								}elseif($_GET['lien']=='gite-guadeloupe-photos'){
									include('PHOTOS.HTM');  
								}elseif($_GET['lien']=='appartement-guadeloupe-liens'){
									include('PLAGE.htm');  
								}elseif($_GET['lien']=='gite-guadeloupe-plans'){
									include('PLAN.HTM');  
								}elseif($_GET['lien']=='location-guadeloupe-trajet'){
									include('TRAJET.HTM');  
								}elseif($_GET['lien']=='hebergement-antilles-details'){
									include('DETAILS.HTM');  
								}elseif($_GET['lien']=='gites-guadeloupe-appartement'){
									include('APPARTEMENT.HTM');  																																				
								}else{
									include('accueil-2.html'); 
								} 
							?>
						</td>						
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
