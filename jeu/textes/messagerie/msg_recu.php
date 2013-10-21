<?
	$user = $_SESSION['iduser'];
	$requete = query("SELECT 
bt_messagerie.id , 
bt_messagerie.date , 
bt_users.user AS expediteur
FROM bt_messagerie 
LEFT JOIN bt_users ON bt_users.iduser = bt_messagerie.expediteur 
WHERE bt_messagerie.destinataire = '".$user."' AND bt_messagerie.statut != 'del' ORDER BY bt_messagerie.date DESC");
	$donnees2 = mysql_num_rows($requete);
	
	if($donnees2 == 0) {
		$template->assign_vars(array(
			'NO_MSG' => '<p><strong>Vous ne possedez aucun message dans votre boîte.</strong></p>'
		));
	}
	while($donnees = mysql_fetch_assoc($requete)) {
		$template->assign_block_vars('mess', array(
			'ID'		=> $donnees['id'],
			'DATE'		=> date('d/m/Y à H\hi', $donnees['date']),
			'EXPEDITEUR'=> $donnees['expediteur']
		));
	}
	$template->set_filenames(array(
		'page' => 'textes/messagerie/msg_recu.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'page');
?>
