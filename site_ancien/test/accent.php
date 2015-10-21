<html>
<body>

<p><strong>Changer les accents</strong></p>

<?

function randomAccent($mot_accent, $mot_actuel) {
	$mot_nouveau = '';
	for($i=0; $i < strlen($mot_accent); $i++) {
		$lettre_accent = $mot_accent[$i];
		$lettre_actuel = $mot_actuel[$i];
		if( $lettre_accent == 'â'
		 || $lettre_accent == 'ä'
		 || $lettre_accent == 'à') {
			if($lettre_actuel == 'a') {
				$mot_nouveau .= $lettre_accent;
			} else {
				$mot_nouveau .= 'a';
			}
		}
		else
		if( $lettre_accent == 'è'
		 || $lettre_accent == 'é'
		 || $lettre_accent == 'ë'
		 || $lettre_accent == 'ê') {
			if($lettre_actuel == 'e') {
				$mot_nouveau .= $lettre_accent;
			} else {
				$mot_nouveau .= 'e';
			}
		}
		else
		if( $lettre_accent == 'î'
		 || $lettre_accent == 'ï') {
			if($lettre_actuel == 'i') {
				$mot_nouveau .= $lettre_accent;
			} else {
				$mot_nouveau .= 'i';
			}
		}
		else
		if( $lettre_accent == 'ö'
		 || $lettre_accent == 'ô') {
			if($lettre_actuel == 'o') {
				$mot_nouveau .= $lettre_accent;
			} else {
				$mot_nouveau .= 'o';
			}
		}
		else
		if( $lettre_accent == 'ù'
		 || $lettre_accent == 'u'
		 || $lettre_accent == 'ü') {
			if($lettre_actuel == 'u') {
				$mot_nouveau .= $lettre_accent;
			} else {
				$mot_nouveau .= 'u';
			}
		}
		else {
			$mot_nouveau .= $lettre_actuel;
		}
	}
	return $mot_nouveau;
}

function supprimerAccent($mot_accent) {
	$mot_nouveau = '';
	for($i=0; $i < strlen($mot_accent); $i++) {
		$lettre_accent = $mot_accent[$i];
		if( $lettre_accent == 'â'
		 || $lettre_accent == 'ä'
		 || $lettre_accent == 'à') {
			$mot_nouveau .= 'a';
		}
		else
		if( $lettre_accent == 'è'
		 || $lettre_accent == 'é'
		 || $lettre_accent == 'ë'
		 || $lettre_accent == 'ê') {
			$mot_nouveau .= 'e';
		}
		else
		if( $lettre_accent == 'î'
		 || $lettre_accent == 'ï') {
			$mot_nouveau .= 'i';
		}
		else
		if( $lettre_accent == 'ö'
		 || $lettre_accent == 'ô') {
			$mot_nouveau .= 'o';
		}
		else
		if( $lettre_accent == 'ù'
		 || $lettre_accent == 'u'
		 || $lettre_accent == 'ü') {
			$mot_nouveau .= 'u';
		}
		else {
			$mot_nouveau .= $lettre_accent;
		}
	}
	return $mot_nouveau;
}

function changerAccent($mot, $mot_reference) {
	$mot_sans_accent = supprimerAccent($mot);	
	$mot_reference_sans_accent = supprimerAccent($mot_reference);
	if($mot_sans_accent == $mot_reference_sans_accent) {
		return randomAccent($mot, $mot_reference);
	} else {
		return $mot;
	}
}

?>

<?
echo(supprimerAccent('totö'));
?>

</body>
</html>
