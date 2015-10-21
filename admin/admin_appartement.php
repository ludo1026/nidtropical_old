<?php
define('ROOT','../');
$dossierImages = ROOT.'img/images-slider/appartement/';
require('SBImage.php');

include ("config.php");

// Connexion à la base de données MySQL
mysql_connec ();

function verifieTypeMime($type){
			$typesacceptes = array('image/jpeg','image/jpg','image/png','image/gif','image/pjpeg');  
			if(in_array($type,$typesacceptes)) return true;
				else return false;
}

if(isset($_POST) && !empty($_POST)){
	
	if(
		!empty($_POST['slide'])&&
		!empty($_POST['titre'])){
				
		$import = false;	
		if(isset($_FILES['image'])){		
			if(verifieTypeMime($_FILES['image']['type'])){
				$import = true;
				$fichier = $dossierImages.$_FILES['image']['name'];
				copy($_FILES['image']['tmp_name'],$fichier);
				SBImage::resize($fichier,800,533,true);
						
			}
		}
		$requete = '';
		$reqFile = '';
		if($_POST['modif'] == "true"){
			if($import)
				$reqFile = ",img='".$_FILES["image"]["name"]."'";
				$requete .= "UPDATE slider_appartement SET titre='".addslashes($_POST['titre'])."'".$reqFile." WHERE id='".$_POST['slide']."'";
		}else{
			if($import)
				$reqFile = $_FILES["image"]["name"];
			$requete = "INSERT INTO slider_appartement(id,titre,img) 
					VALUES('".$_POST['slide']."',
							'".addslashes($_POST['titre'])."',
							'".$reqFile."'
							)";	
		}
		mysql_query($requete);
	}
}

?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Administration du slider de la page gite</title>
	<link rel="stylesheet" href="../css/slider.css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				$('.supprimer').live('click',function(){
					var idSup = $(this).parent().find('legend').html() * 1;
					var form =  $(this).parent().parent();
					
					$.get("ajax_appartement.php",{idSup: idSup},
										function(data){
											form.fadeOut('fast',function(){
												form.remove();
											});
											for(var i=idSup; i<(Number(form.nextAll().size())+idSup);i++){
												$('#formulaires form:eq('+i+')').find('legend').text(i);
												$('#formulaires form:eq('+i+')').find('#idslide').val(i);
											}
										}
					);
				});
				$('.positionplus').live('click',function(){
					var position = $(this).parent().find('legend').html();
					var form =  $(this).parent().parent();
					if (form.is(':last-child')) {
						alert('Ce slide est déjà en dernière position, vous ne pouvez pas le déplacer !');
						return false;
					}
					position++;
					var positionplus = position;
					position--;
					var positionmoins = position;
					
					$(form.next()).after(form);
						form.find('legend').text(positionplus);
						form.find('#idslide').val(positionplus);
						$(form.prev()).find('legend').text(positionmoins);
						$(form.prev()).find('#idslide').val(positionmoins);
					
					$.get("ajax_appartement.php",{idChange1: positionplus,
									  idChange2:positionmoins
									  });
				});
				$('.positionmoins').live('click',function(){
					var position = $(this).parent().find('legend').html();
					var form =  $(this).parent().parent();
					if (form.is(':first-child')) {
						alert('Ce slide est déjà en première position, vous ne pouvez pas le déplacer !');
						return false;
					}
					position--;
					var positionmoins = position;
					position++;
					var positionplus = position;
					
					form.insertBefore(form.prev());
						form.find('legend').text(positionmoins);
						form.find('#idslide').val(positionmoins);
						$(form.next()).find('legend').text(positionplus);
						$(form.next()).find('#idslide').val(positionplus);
					
					$.get("ajax_appartement.php",{idChange1: positionplus,
									  idChange2:positionmoins
									  });
				});
			});
			function ajouteSlideVide(){
					var numeroSlide = $('#formulaires form').length+1;
					$("#formulaires form:last").clone().appendTo('#formulaires').hide().fadeIn();
					
					//Réinitialise les valeurs du formulaire
					$('#formulaires form:last legend').html(numeroSlide);
					$('#formulaires form:last input').val('');
					$('#formulaires form:last textarea').val('');
					$('#formulaires form:last img').remove();
					$('#formulaires form:last #idslide').val(numeroSlide);
					$('#formulaires form:last #modif').val('false');
					$('#formulaires form:last button').text('Ajouter');
					
			}
			
	</script>
</head>	
<body class="admin">
	<div id="pageContainer">
		<h1>Administration du slider de la page appartement</h1>
		<a href="javascript:ajouteSlideVide()" class="ajoutSlide">Ajouter un slide</a>
		<div id="formulaires">
			<?php
				$requete = "SELECT id,titre,img FROM slider_appartement ORDER BY id";
				$result = mysql_query($requete);
				if(mysql_num_rows($result)){
					while($cur_item = mysql_fetch_assoc($result)){
						echo '<form method="post" enctype="multipart/form-data">
								<fieldset>
									<legend>'.$cur_item['id'].'</legend>
									<input type="hidden" name="slide" id="idslide" value="'.$cur_item['id'].'" />
									<input type="hidden" name="modif" id="modif" value="true" />
									<label>Titre</label><input type="text" name="titre" value="'.htmlspecialchars($cur_item['titre']).'"/>
									<label>Image</label><input type="file" name="image" />
									<img class="miniature" src="'.htmlspecialchars($dossierImages.$cur_item['img']).'" alt="image du slide" />
									<button type="submit">Modifier</button>
									<a class="positionmoins" href="javascript:void(0)">Déplacer le slide vers la gauche</a>
									<a class="positionplus" href="javascript:void(0)" >Déplacer le slide vers la droite</a>
									<a class="supprimer" href="javascript:void(0)">Supprimer</a>
								</fieldset>
						</form>';	
					}
						
				} else{
					echo '<form method="post" enctype="multipart/form-data">
								<fieldset>
									<legend>1</legend>
									<input type="hidden" name="slide" id="idslide" value="1" />
									<label>Titre</label><input type="text" name="titre" value=""/>
									<label>Image</label><input type="file" name="image" />
									<button type="submit">Ajouter</button>
									<a class="supprimer" href="javascript:void(0)">Supprimer</a>
								</fieldset>
						</form>';
				}
				mysql_close();
				?>
		</div>
	</div>
</body>
</html>