<?php
// script modifié par Guigui le 15/08/06

// ETAPE 1 : on vérifie si l'IP se trouve déjà dans la table
$ip = ip();
$now = time();
$times = $now - 300 ;
$sql = query("SELECT * FROM bt_connectes WHERE ip = '".$ip."' AND timestamp > '".$times."' ");
$num = mysql_num_rows($sql);

if(isset($_SESSION['user']))
{$iduser = $_SESSION['iduser']; }
else{ $iduser = 0 ; }

if ($num == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
{
    query("INSERT INTO bt_connectes VALUES( '' , '".$iduser."','".$ip."', '".$now."')");
	//total de visites : 
	$monfichier = fopen('compteur_total.txt', 'r+');

	$pages_vues = fgets($monfichier);
	$pages_vues++;
	fseek($monfichier, 0);
	fputs($monfichier, $pages_vues);

	fclose($monfichier);
}
else // L'ip se trouve déjà dans la table, on met juste à jour le timestamp
{
	$info = mysql_fetch_assoc($sql);
    query("UPDATE bt_connectes SET timestamp = '".$now."' , session = '".$iduser."' WHERE ip = '".$ip."' AND id = '".$info['id']."' ");
}

// -------
// ETAPE 2 : on compte le nombre d'ip stockées dans la table. C'est le nombre de visiteurs connectés
$sql1 = query("SELECT * FROM bt_connectes WHERE session = 0 AND timestamp > '".$times."' ");
$nbr_invite = mysql_num_rows($sql1);

$sql2 = query("SELECT * FROM bt_connectes WHERE session != 0 AND timestamp > '".$times."' ");
$nbr_en_ligne = mysql_num_rows($sql2);

$total = $nbr_en_ligne + $nbr_invite;
//TPL
$template->set_filenames(array(
		'connecte' => 'scripts/connecte.tpl'
));

$template->assign_vars(array(
		'TOTAL' => $total,
		'EN_LIGNE' => $nbr_en_ligne,
		'INVITE' => $nbr_invite
));
///pour le record de visiteurs en meme temps
$monfichier = fopen("record_compteur.txt", "r+");

$ligne = fgets($monfichier);

if($ligne < $total) {
fseek($monfichier, 0); 
fputs($monfichier, $total);
}

fclose($monfichier);

$template->assign_var_from_handle('CONNECTE', 'connecte');
?>