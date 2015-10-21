<?php
/**
 * Classe qui traite les images avec la librairie GD!
 * @author Amélioration de F.Rouault
 * 
 */
class SBImage {

	// Resize_Image
	// Redimensionne une image
	public static function resize($fileAdresse, $largeur_max, $hauteur_max, $respect_ratio, $fileSaveAdresse='', $jpeg_quality = '70') {
		
		if(empty($fileSaveAdresse)) {
			$fileSaveAdresse=$fileAdresse;
		}
		$image = SBImage::loadFromFile($fileAdresse);
		if($image == false) {
			// Retour avec erreur pour non rechargement de l'image
			return -1;
		}

		// Récupération des dimensions de l'image.
		$dim_x = imagesx($image);
		$dim_y = imagesy($image);

		// Calcul des nouvelles dimensions
		$coefficient_theorique = $largeur_max/$hauteur_max;
		$coefficient_reel = $dim_x/$dim_y;

		if(!$respect_ratio) {

			// Redimensionnement de l'image au ratio souhaité
			$crop = SBImage::crop($fileAdresse, $largeur_max, $hauteur_max);
			if($crop !== 0) {
				return (-5+$crop);
			}

			// Rechargement de l'image
			$image = SBImage::loadFromFile($fileAdresse);
			if($image == false) {
				// Retour avec erreur pour non rechargement de l'image
				return -6;
			}
			$dim_x = imagesx($image);
			$dim_y = imagesy($image);
		}

		if($coefficient_theorique >= $coefficient_reel) {
			// Si l'image est plus étirée en hauteur que la théorie.
			// On adapte sur la hauteur max
			$coefficient_adaptation = $hauteur_max/$dim_y;
		} else {
			// Si l'image est plus étirée en largeur que la théorie.
			// On adapte sur la largeur max
			$coefficient_adaptation = $largeur_max/$dim_x;
		}

		$ndim_x = $coefficient_adaptation*$dim_x;
		$ndim_y = $coefficient_adaptation*$dim_y;

		$result_image = SBImage::createTransparentImage($ndim_x, $ndim_y);
		if(!$result_image) {
			return -4;
		}

		// Redimensionnement
		if(imagecopyresampled($result_image, $image, 0, 0, 0, 0, $ndim_x, $ndim_y, $dim_x, $dim_y)) {
			// Enregistrement de la nouvelle image.
			if(SBImage::saveIntoFile($result_image, $fileSaveAdresse, $jpeg_quality)) {
				return true;
			}
			// Retour d'erreur pour défaut d'enregistrmeent.
			return -3;
		} else {
			// Retour d'erreur pour défaut de redimensionnement.
			return -2;
		}
	}

	// Crop_Image
	// Retaille une image à une proportion donnée
	public static function crop($fileAdresse, $largeur_max, $hauteur_max, $crop_center = SB_IMAGE_CROP_CENTER, $fileSaveAdresse = '', $jpeg_quality = '70') {

		if(empty($fileSaveAdresse)) {
			$fileSaveAdresse=$fileAdresse;
		}

		$image = SBImage::loadFromFile($fileAdresse);
		if($image == false) {
			// Retour avec erreur pour non rechargement de l'image
			return -1;
		}

		// Récupération des dimensions de l'image.
		$dim_x=imagesx($image);
		$dim_y=imagesy($image);

		$coefficient_theorique=$largeur_max/$hauteur_max;
		$coefficient_reel=$dim_x/$dim_y;

		// Récupération des dimensions d'origine
		$neo_dim_x = $dim_x;
		$neo_dim_y = $dim_y;

		// Initialisation des positions de départ du découpage.
		$start_x_src = 0;
		$start_y_src = 0;
		$start_x_des = 0;
		$start_y_des = 0;

		// Initialisation des dimensions de découpage
		$largeur_src = $dim_x;
		$largeur_des = $dim_x;
		$hauteur_src = $dim_y;
		$hauteur_des = $dim_y;

		// Si les proportions ne sont pas bonnes.
		if($coefficient_theorique != $coefficient_reel) {

			if($coefficient_reel < $coefficient_theorique) {
				// On souhaite obtenir une image moins large
				$neo_dim_x = $coefficient_theorique*$neo_dim_y;

				if($neo_dim_x > $dim_x) {
					if($crop_center) {
						$start_x_des = round(($neo_dim_x-$dim_x)/2);
					} else {
						$start_x_des = mt_rand(0, round($neo_dim_x-$dim_x));
					}
				} else {
					if($crop_center) {
						$start_x_src = round(($dim_x-$neo_dim_x)/2);
					} else {
						$start_x_src = mt_rand(0, round($dim_x-$neo_dim_x));
					}

					$largeur_src = $neo_dim_x;
				}
			} else {
				// On veut obtenir une image moins haut.
				$neo_dim_y = $neo_dim_x/$coefficient_theorique;

				if($neo_dim_y > $dim_y) {
					if($crop_center) {
						$start_y_des = round(($neo_dim_y-$dim_y)/2);
					} else {
						$start_y_des = mt_rand(0, round($neo_dim_y-$dim_y));
					}
				} else {
					if($crop_center) {
						$start_y_src = round(($dim_y-$neo_dim_y)/2);
					} else {
						$start_y_src = mt_rand(0, round($dim_y-$neo_dim_y));
					}
					$hauteur_src = $neo_dim_x;
				}
			}
		}

		// Création de l'image cible
		$result_image = SBImage::createTransparentImage($neo_dim_x, $neo_dim_y);
		if(!$result_image) {
			return -4;
		}
		// Redimensionnement
		if(imagecopyresampled($result_image, $image, $start_x_des, $start_y_des, $start_x_src, $start_y_src, $largeur_des, $hauteur_des, $largeur_src, $hauteur_src)) {
			// Enregistrement de la nouvelle image.
			if(SBImage::saveIntoFile($result_image, $fileSaveAdresse, $jpeg_quality)) {
				return 0;
			}
			// Retour d'erreur pour défaut d'enregistrmeent.
			return -3;
		} else {
			// Retour d'erreur pour défaut de redimensionnement.
			return -2;
		}
	}

	// Create Miniature
	// Crée une miniature à une echelle donnée
	public static function createTransparentImage($largeur, $hauteur) {

		$image = imagecreatetruecolor($largeur, $hauteur);
		if($image !== false) {
			$couleur = imagecolorallocatealpha($image, 255, 255, 255, 0);
			if($couleur !== false) {
				if(imagefilledrectangle($image, 0, 0, $largeur, $hauteur, $couleur)) {
					return $image;
				}
			}
		}

		return false;
	}

	// Create Miniature
	// Crée une miniature à une echelle donnée
	public static function createMiniature($fileAdresse, $largeur_max, $longueur_max, $fileSaveAdresse='') {

		if(empty($fileSaveAdresse)) {
			$fileSaveAdresse=$fileAdresse;
		}

		$crop = SBImage::Crop($fileAdresse, $largeur_max, $longueur_max, SB_IMAGE_CROP_RANDOM, $fileSaveAdresse);

		if(!$crop) {
			$resize = SBImage::resize($fileSaveAdresse, $largeur_max, $longueur_max, SB_IMAGE_RESIZE__KEEP_RATIO);

			if(!$resize) {
				return 0;
			}
		}

		return 1;
	}

	public static function loadFromFile($p_file_adresse) {
		// Récupération de l'extension du fichier.
		$extension = strtolower(pathinfo($p_file_adresse, PATHINFO_EXTENSION));
		// Chargement de l'image
		if($extension == 'jpeg' OR $extension == 'jpg') {
			return imagecreatefromjpeg($p_file_adresse);
		}
		if($extension == 'png') {
			return imagecreatefrompng($p_file_adresse);
		}
		if($extension == 'gif') {
			return imagecreatefromgif($p_file_adresse);
		}
		// Retour avec erreur pour non rechargement de l'image
		return false;
	}

	public static function saveIntoFile($p_result_image, $p_file_adresse, $jpeg_quality = 70) {
		// Récupération de l'extension du fichier.
		$extension = strtolower(pathinfo($p_file_adresse, PATHINFO_EXTENSION));
		if($extension=='jpeg' OR $extension=='jpg') {
			if(imagejpeg($p_result_image, $p_file_adresse, $jpeg_quality)) {
				return true;
			}
		} else if($extension=='png') {
			if(imagepng($p_result_image, $p_file_adresse, min(9, round($jpeg_quality/10)))) {
				return true;
			}
		} else if($extension=='gif') {
			if(imagegif($p_result_image, $p_file_adresse)) {
				return true;
			}
		}

		// Retour avec erreur pour non rechargement de l'image
		return false;
	}
	
	
	/**
	 * Pivote une image
	 * @return true si l'image a bien été modifiée
	 * @param object $fileAdresse
	 * @param object $angle
	 * @param object $fileSaveAdresse[optional]
	 * @param object $jpeg_quality[optional]
	 */
	public static function rotation($fileAdresse, $angle, $fileSaveAdresse='', $jpeg_quality = '70') {
		if(empty($fileSaveAdresse)) {
			$fileSaveAdresse=$fileAdresse;
		}
		$image = SBImage::loadFromFile($fileAdresse);
		if($image == false) {
			// Retour avec erreur pour non rechargement de l'image
			return false;
		}
		$back = imagecolorallocate($image, 0, 0, 0); 			
		$imgrot=imagerotate($image, $angle, $back);
		SBImage::saveIntoFile($imgrot, $fileSaveAdresse, $jpeg_quality);
		return true;
	}
	
	
	
	
	/**
	 * Passe une image en niveau de gris
	 * @return true si l'image a bien été modifiée
	 * @param object $fileAdresse
	 * @param object $largeur
	 * @param object $hauteur
	 * @param object $fileSaveAdresse[optional]
	 * @param object $jpeg_quality[optional]
	 */
	public static function desaturation($fileAdresse, $largeur, $hauteur, $fileSaveAdresse='', $jpeg_quality = '70') {
		if(empty($fileSaveAdresse)) {
			$fileSaveAdresse=$fileAdresse;
		}
		$image = SBImage::loadFromFile($fileAdresse);
		if($image == false) {
			// Retour avec erreur pour non rechargement de l'image
			return false;
		}
	
		imagecopymergegray($image,$image,0,0,0,0, $largeur, $hauteur, 0);
		SBImage::saveIntoFile($image, $fileSaveAdresse, $jpeg_quality);
		return true;
	}
	
}
?>