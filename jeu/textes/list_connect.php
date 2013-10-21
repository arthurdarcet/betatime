<?
	$now = time();
	$times = $now - 300;
	$sql1 = query("SELECT 
bt_users.user AS session 
FROM bt_connectes 
LEFT JOIN bt_users ON bt_connectes.session = bt_users.iduser 
WHERE session != 0 AND timestamp > '".$times."' ");
while($donnees = mysql_fetch_assoc($sql1))
{
	$template->assign_block_vars('list',array(
			'PSEUDO' => ucwords($donnees['session'])
	));
}
///////////stat
$monfichier2 = fopen('compteur_total.txt', 'r+');
$num = fgets($monfichier2);
//record
$monfichier = fopen("record_compteur.txt", "r+");
$ligne = fgets($monfichier);

	$template->assign_vars(array(
			'NBR' => $num, 
			'RECORD' => $ligne
	));
fclose($monfichier2);
fclose($monfichier);
	$template->set_filenames(array(
		'page' => 'textes/list_connect.tpl'
	));
	
	$template->assign_var_from_handle('PAGE', 'page');
?>