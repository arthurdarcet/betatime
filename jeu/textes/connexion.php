<?
	$template->set_filenames(array(
		'connexion' => 'textes/connexion.tpl'
	));
	$template->assign_vars(array(
			'PERTE_MDP' => '<a href="?page=mdp_perdu">Mot de passe perdu ?</a>'
	));
	$template->assign_var_from_handle('CONNEXION', 'connexion');
?>