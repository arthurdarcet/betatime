<?
include('conf/config.php');
	if(!isset($_POST['id'])) { hack("L\'id dans l\'url a été supprimé !"); }
	$template->set_filenames(array(
		'page' => 'textes/rapport_attaque.tpl'
	));
	$template->assign_vars(array(
		'RAPPORT' => attaquer($_SESSION['iduser'], $_POST['id'])
	));
	$template->assign_var_from_handle('PAGE', 'page');
?>