<?
	$requete = query("SELECT * FROM bt_messagerie WHERE destinataire = '".$_SESSION['iduser']."' AND statut = 'non lu' ");
	$donnees = mysql_num_rows($requete);

	if($donnees != '0') 
	{
		if($donnees == '1' ) 
		{ $not_lu = '1 message non lu'; }
		else
		{ $not_lu = $donnees.' messages non lus' ; }

		
		$template->set_filenames(array(
				'messagerie' => 'scripts/messagerie.tpl'
		));

		$template->assign_vars(array(
				'PHRASE' => $not_lu
		));

		$template->assign_var_from_handle('MESSAGERIE', 'messagerie');
	}
?>