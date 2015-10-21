<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Merci d\'indiquer votre nom'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	if(trim($_POST['contactPhone']) === '') {
		$phoneError =  'Merci d\'indiquer votre téléphone'; 
		$hasError = true;
	} else {
		$phone = trim($_POST['contactPhone']);
	}

	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Merci d\'indiquer votre adresse email';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'Merci d\'indiquer un email valide';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'Merci d\'écrire un message';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError) && ($_POST["no_email"] == "")) {
		
		$emailTo = 'gite@nidtropical.com';
		$subject = 'Message depuis formulaire du site';
		$sendCopy = trim($_POST['sendCopy']);
		$headers = 'Content-type: text/plain; charset=utf-8' . "\r\n";
		$headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n"; 
		$headers .= 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		$body = 'Cet email a été envoyé depuis le site nidtropical.com par '.$name."\r\n";
		$body .= 'Téléphone : '.$phone."\n\n";
		$body .= 'Email : '.$email."\r\n";
		$body .= '***************************'."\r\n";
		$body .= $comments."\r\n";
		$body .= '***************************'."\r\n";


		mail($emailTo, $subject, $body, $headers);

        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Contactez Nid Tropical  - Nid Tropical</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<!--[if lt IE 9]> 
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
	<![endif]-->
	<link rel="stylesheet" href="css/main.css">
</head>

<body class="partenaires">

<div>

	<!-- En-tête de la page : Début-->
	<div itemscope itemtype="http://schema.org/LocalBusiness" class="container">
			
		<div class="langue"><a href="http://www.en.nidtropical.com/" title="Version anglaise du site"><img src="images/header/drapeau-anglais.gif" width="69" height="35" alt="Drapeau anglais"></a></div>
			
		<header class="logo" role="banner">
			<img src="images/header/logo_nidtropical.gif" alt="Nid Tropical, location gite et bungalow à Bouillante en Guadeloupe" width="450" height="174">
			<h1>
				<span itemprop="name">Le nid tropical : </span>
				<span itemprop="description"> Location bungalows, gites, appartement en guadeloupe - bouillante </span>			
			</h1>
			<div class="addresse">
				<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<span itemprop="streetAddress">Morne TARARE </span>- <span itemprop="postalCode">97125</span>
					<span itemprop="addressLocality">BOUILLANTE</span>
					<span itemprop="addressCountry"> - Guadeloupe</span>
				</address>	
				<div>
					Tél./Fax : <span itemprop="telephone" content="+590590987205">05 90 98 72 05</span> - Mobile : <span itemprop="telephone" content="+590690406348">06 90 40 63 48</span>
				</div>
			</div>
		</header>
			
		<div class="courrier">
			<div><a href="mailto:gite@nidtropical.com" itemprop="email">gite@nidtropical.com</a></div>
			<h2>Contact Nid Tropical</h2>
		</div>
	</div>
	<!-- En-tête de la page : Fin-->

	<!-- Centre de la page : Début-->
	<div class="container">

		<div class="section">
	
			<!-- Menu de la page : Début -->
			<nav class="menu" role="navigation">
				<ul>
					<li>
						<a href="/">Accueil</a>
					</li>
					<li>
						<a href="gite.html">Gîte</a>
					</li>
					<li>
						<a href="bungalow.html">Bungalow</a>
					</li>
					<li>
						<a href="appartement.html">Appartement</a>
					</li>
					<li>
						<a href="tarifs.html">Tarifs</a>
					</li>
					<li>
						<a href="situation.html">Situation</a>
					</li>
					<li>
						<a href="plongee-malendure.html">Activités</a>
					</li>
					<li>
						<a href="partenaires.html">Partenaires</a>
					</li>
					<li>
						<a href="contact.php">Contact</a>
					</li>
				</ul>
			</nav>	
			<!-- Menu de la page : Fin -->
		
		</div>	
			
		<!-- Coeur de la page : Début-->
		<main class="main"  role="main">
		
			<article role="article">
	
				<h1>Vous souhaitez plus de renseignements sur l'un de nos hébergements pour votre séjour à Bouillante en Guadeloupe... contactez-nous !</h1>
				
				<p>Vous désirez louer l'un de nos gites, bungalows ou l'appartement pour vos vacances aux antilles, laissez nous un message, nous vous répondrons très vite.</p>

				<aside role="complementary">
					
	        <?php if(isset($emailSent) && $emailSent == true) { ?>
                <p><span class="message">Merci. Votre formulaire a bien été envoyé !</span></p>
            <?php } else { ?>
            
			<p>Tous les champs sont obligatoires.</p>
		
			<?php if(isset($hasError) || isset($captchaError) ) { ?>
                <p><span class="message">Erreur de soumission du formulaire</span></p>
            <?php } ?>
				
			<form id="contact-us" action="contact.php" method="post">
				
				<div class="formblock">
					<label for="contactName">Nom</label>
					<input type="text" name="contactName" id="contactName" value="<?php if (isset ($_POST['contactName'])) echo htmlspecialchars ($_POST['contactName'], ENT_QUOTES); ?>" class="txt requiredField" required placeholder="Votre nom" />
						<?php if($nameError != '') { ?>
							<span class="error"><?php echo $nameError;?></span> 
						<?php } ?>
				</div>
				
				<div class="formblock">
					<label for="contactPhone">Téléphone</label>
					<input type="text" name="contactPhone" id="contactPhone" value="<?php if(isset($_POST['contactPhone'])) echo htmlspecialchars ($_POST['contactPhone'], ENT_QUOTES);?>" class="txt requiredField" required placeholder="Votre téléphone" />
						<?php if($phoneError != '') { ?>
							<span class="error"><?php echo $phoneError;?></span> 
						<?php } ?>
				</div>
                        
				<div class="formblock">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" value="<?php if(isset($_POST['email']))  echo htmlspecialchars ($_POST['email'], ENT_QUOTES);?>" class="txt requiredField email" required placeholder="Votre email" />
						<?php if($emailError != '') { ?>
							<span class="error"><?php echo $emailError;?></span>
						<?php } ?>
				</div>
				
				<div class="formblock2">
				<label for="no_email">N'entrez rien dans ce champ</label>
				<input type="email" name="no_email" id="no_email"   />
				</div>  
				                      
				<div class="formblock">
					<label for="commentsText">Message</label>
					 <textarea name="comments" id="commentsText" class="txtarea requiredField" required placeholder="Votre message"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo htmlspecialchars ($_POST['comments'], ENT_QUOTES); } } ?></textarea>
						<?php if($commentError != '') { ?>
							<span class="error"><?php echo $commentError;?></span> 
						<?php } ?>
				</div>
				
				<div class="formblocksubmit">
					<button name="submit" type="submit" class="subbutton">Envoyez</button>
					<input type="hidden" name="submitted" id="submitted" value="true" />
				</div>
			</form>			
				
			<?php } ?>
				
				</aside>
				
			
			</article>
			
		</main>
		<!-- Coeur de la page : Fin-->
		
	</div>
	<!-- Centre de la page : Fin-->

	<!-- Footer : Début-->
	<footer class="container footer" role="contentinfo">
		  
			<div itemscope itemtype="http://schema.org/LocalBusiness" class="container">
				<span itemprop="name">SCI Gîte bungalow LE NID TROPICAL</span>
				<span itemprop="description"> - <strong>Hébergement / Location gites et bungalows créoles pour séjour en Guadeloupe</strong></span>
				<br />					
				<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<span itemprop="streetAddress">Morne TARARE </span>- <span itemprop="postalCode">97125</span>
					<span itemprop="addressLocality">BOUILLANTE </span>-
					<span itemprop="addressCountry"> Guadeloupe </span>-
				</address>	
				Tél./Fax : <span itemprop="telephone" content="+590590987205">05 90 98 72 05</span> - Mobile : <span itemprop="telephone" content="+590690406348">06 90 40 63 48</span>
				 - <a href="mailto:gite@nidtropical.com" itemprop="email">gite@nidtropical.com</a>
			</div>
	</footer>
	<!-- Footer : Fin-->

</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24336933-1', 'nidtropical.com');
  ga('send', 'pageview');

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$('form#contact-us').submit(function() {
			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">Merci d\'indiquer votre '+labelText+'</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Merci d\'indiquer un '+labelText+' valide</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contact-us').slideUp("fast", function() {				   
						$(this).before('<p><span class="message">Merci. Votre formulaire a bien été envoyé !</span></p>');
					});
				});
			}
			
			return false;	
		});
	});
	//-->!]]>
</script>


</body>
</html>