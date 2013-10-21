<?php
//pour enegistrer les actions frauduleuses
//By Guigui le 10/09/06
function hack($gravite, $motif=0) {
require ("conf/config.php");

$ip = ip();
$agent = $_SERVER['HTTP_USER_AGENT'];
$adresse = $_SERVER['REQUEST_URI'];
if ( isset ($_SESSION['iduser'])) {$user = $_SESSION['iduser'];}
else{$user = 0;}

mysql_query("INSERT INTO hack VALUES('', '$user', '$ip', '$agent', '$adresse','$motif' , '".time()."', '$gravite', '')");

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Hackage du site</title>
</head>
<body>
<p style=\'color:#FF0000; \'>Motif : '.stripslashes($motif).'</p>
<p style=\'color:#FF0000; \'>Vous venez d\'effectuer une action non conforme qui a été assimilée à une tentative de hackage des informations sur vous ont donc été stockées.<br />
Si vous êtes tombé(e) naturelement sur cette page, prévenez nos équipes en leur envoyant un mail à l\'aide de ce <a href="mailto:postmaster@betatimes.info?subject=Hack : user: '.$user.', ip: '.$ip.', timestamp: '.$date.', adresse: '.$adresse.'">lien</a> ( merci de ne pas modifier le sujet )</p>
</body>
</html>';
 exit; 
}

?>
