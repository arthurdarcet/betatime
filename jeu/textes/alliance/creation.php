<?
	include("scripts/alliances/creation.php");

	if($_SESSION['grade'] < 5){ hack('Tentative de creation d une alliance sous le grade 5 => recherche de faille'); }
	$total_mbr = ceil($_SESSION['grade'] * 2.5) ;

	$template->assign_vars(array(
				'MBR_MAX'	=> $total_mbr
	));

	$template->set_filenames(array(
		'page' => 'textes/alliance/creation.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'page');
?>