<?php
// Connexion � la base de donn�es MySQL
function mysql_connec ()
{
	/*mysql_connect ("localhost", "root", "") or exit ("Impossible de se connecter � la base de donn�es MySQL.");
	mysql_select_db ("nidtropical") or exit ("Impossible de se connecter � la base de donn�es MySQL.");*/
	mysql_connect ("db546706130.db.1and1.com", "dbo546706130", "nidtropical") or exit ("Impossible de se connecter � la base de donn�es MySQL.");
	mysql_select_db ("db546706130") or exit ("Impossible de se connecter � la base de donn�es MySQL."); 
}
?>