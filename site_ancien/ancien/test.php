<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? if($_GET['lien']=='photos'){  ?>
	<title>Vacances en Guadeloupe - Nid Tropical - Vous propose un séjour en Guadeloupe, plongée en guadeloupe</title>
	<meta name="description" content="les vacances en Guadeloupe avec Nid Tropical, c'est possible. Venez découvrir une large gamme de location bungalows en Guadeloupe et les hébergements en Guadeloupe. De plus, le bungalow Guadeloupe ">
	<meta name="keywords" content="Bungalows guadeloupe, Bungalow guadeloupe, Séjour guadeloupe, Vacances guadeloupe, Plongée guadeloupe, Hébergement guadeloupe, Location bungalows guadeloupe, Hébergements guadeloupe, sejours guadeloupe, sejour en guadeloupe, vacances en guadeloupe, hebergement en guadeloupe, location en guadeloupe, gîte en guadeloupe, loisirs en guadeloupe, catamaran en guadeloupe, randonnée en guadeloupe">
<? }else{  ?>
		<title>Gîtes guadeloupe - Nid Tropical - A découvrir l'appartement guadeloupe etl'hébergement antilles</title>
		<meta name="description" content="Les gîtes en Guadeloupe avec Nid Tropical, ce n'est plus un rêve. Venez découvrir le gîte en Guadeloupe et effectuez la location en Guadeloupe. Possibilité aussi d'hébergement aux Antilles.">
		<meta name="keywords" content="Gites guadeloupe, Gîtes guadeloupe, Gîte guadeloupe, Gite guadeloupe, Location guadeloupe, Appartement guadeloupe, Hébergement antilles, sejour en guadeloupe, croisière en guadeloupe, location en guadeloupe">
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
