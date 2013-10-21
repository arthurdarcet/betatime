<?php
mysql_connect("localhost", "d7k_bt", "***********")
	or die('Problème de connection à la base de donnee<br /> erreur sql : '.mysql_error());
mysql_select_db("d7k_jeu")
	or die('Problème de selection de la base de donnée <br /> erreur sql : '.mysql_error());

/*foreach($_POST as $cle=>$valeur) {
$_POST[$cle] = mysql_real_escape_string($valeur);	// c'est deux boucle qui permettent de faire un addslashes de tous les POST
}													// et les GET tous seul voilou c pas beau lol

foreach($_GET as $cle=>$valeur) {
$_GET[$cle] = mysql_real_escape_string($valeur);
}*/

?>
