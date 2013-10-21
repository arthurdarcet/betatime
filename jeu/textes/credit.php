<?
if(isset($_GET['nom'])) {
include('textes/credit/'.$_GET['nom'].'.php');

}else{

	$template->set_filenames(array(
		'credits' => 'textes/credits.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'credits');
}
?>