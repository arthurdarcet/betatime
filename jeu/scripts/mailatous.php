<?
include("../conf/config.php");
$select = query("SELECT mail FROM users");
$num = mysql_num_rows($select);
$mess = "Cher joueur de Beta Times,
suite à des problèmes dans notre base de donnée nous avons été obligé de suprimmer tous les utilisateurs inscrit.

Vous pouvez dès maintenant vous reinscrire sur www.betatimes.info

Cordialement, l'équipe d'administration de Beta Times.";

while ( $data = mysql_fetch_array($select) ) {
mail($mess, "Réinscription sur Beta Times", $data['mail']);
$compte++;
}

echo $compte.' messages sur '.$num.' ont été envoyé';
echo '<br />';
$cent = $compte * 100 / $num;
echo 'soit '.$cent.' %';
?> 