<?
	if( isset($_GET['destinataire']) ) {
		$destinataire = affich_text($_GET['destinataire']);
		$titre = 'RE//' ; 
	}
	$template->set_filenames(array(
		'msg' => 'textes/messagerie/envoyer_message.tpl'
	));
	$template->assign_vars(array(
		'TITRE' => $titre,
		'DESTINATAIRE' => $destinataire
	));
	$template->assign_var_from_handle('PAGE', 'msg');
?>
