<?
include("../conf/config.php");
$select = query("SELECT mail FROM users");
$num = mysql_num_rows($select);
$mess = "Cher joueur de Beta Times,
suite � des probl�mes dans notre base de donn�e nous avons �t� oblig� de suprimmer tous les utilisateurs inscrit.

Vous pouvez d�s maintenant vous reinscrire sur www.betatimes.info

Cordialement, l'�quipe d'administration de Beta Times.";

while ( $data = mysql_fetch_array($select) ) {
mail($mess, "R�inscription sur Beta Times", $data['mail']);
$compte++;
}

echo $compte.' messages sur '.$num.' ont �t� envoy�';
echo '<br />';
$cent = $compte * 100 / $num;
echo 'soit '.$cent.' %';
?> 