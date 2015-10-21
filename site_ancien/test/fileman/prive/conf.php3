<?
//---------------------------------------------------------------------------------------------------
//							
//	WebJeff - FileManager v1.6
//	
//	Jean-François GAZET
//	http://www.webjeff.org
//	webmaster@webjeff.org	
//
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------------------------------------
//	VARIABLES A MODIFIER
//	(VARS TO MODIFY)
//-----------------------------------------------------------------------------------------------------------------------------------------

// URL DANS LEQUEL VOUS INSTALLEZ WebJeff-Filemanager (ne mettez pas de / à la fin)
// (URL WHERE WebJeff-Filemanager WILL BE INSTALLED, (do not left the trailing slash) */

$installurl="http://jeffgazet.free.fr/filemanager"; 
//$installurl="http://localhost/dev/filemanager";

// LANGUE PAR DEFAUT (DEFAULT LANGUAGE)
// French : fr
// English : en
// Poland : pl
// Slovak : sk
// Italian : it
// Deutch : de 
// Estonian : ee 
// Chinese : cn
// Lithuanian : lt
// Russian : rs
// Hungary : hun

$dft_langue="fr";

// AUTORISER LE CHANGEMENT DE LANGUE (ALLOW CHANGING LANGUAGE)
// Oui=1, Non=0;

$allow_change_lang=1;

// UNITE DE TAILLE DES FICHIER (octets "o", bytes "b")
// (Unit of file size, "o" or "b")

$size_unit="o";

// NOMBRE DE CARACTERES MAXIMUM POUR LES NOMS DE FICHIER
// (max number chars for file and directory names)

$max_caracteres=30;

// AFFICHAGE DES FICHIERS CACHES : oui=1, non=0 (UN FICHIER CACHE COMMENCE PAR UN POINT)
// (Show hidden files, yes=1, no=0)

$showhidden=1;

// PAGES D'ENTETE ET DE BAS DE PAGE
// (header and footer files )

$hautpage="include/haut.htm";
$baspage="include/bas.htm";

// Couleur de fond des lignes de tableaux
// (background color of table lines)

$tablecolor="#9999FF";

// Police des caractères (letters font)

$font="Verdana";

// Gestion d'utilisateur : OUI=1, NON=0
// SI VOUS METTEZ 0, TOUT LE MONDE AURA ACCES AU WEBJEFF-FILEMANAGER,
// INDIQUEZ DANS CE CAS, LE REPERTOIRE RACINE ($racine), L'URL DU REPERTOIRE RACINE ($url_racine) ET RETIREZ LES // (cf. FAQ)
// (Users management : YES = 1, NO=0)
// IF YOU SET 0, EVERYBODY WILL BE ABLE TO USE THIS SCRIPT WITHOUT LOGIN, 
// IN THAT CASE, SET THE ROOT PATH ($racine), THE URL OF THIS ROOT PATH ($url_racine) AND REMOVE THE // (see FAQ for more)

$users=1;
//$racine="/var/www/free.fr/1/j/e/f/f/jeffgazet/filemanager/demo";
//$url_racine="http://jeffgazet.free.fr/filemanager/demo";
?>