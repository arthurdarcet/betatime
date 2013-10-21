<?
	include('scripts/inscription.php');
	$template->set_filenames(array(
		'inscription' => 'textes/inscription.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'inscription');
?>