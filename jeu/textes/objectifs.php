<?
$grade = $_SESSION['grade'];

$grade_vise = $grade + 1 ;

if($grade_vise > 11 )
{
$template->assign_block_vars('g11',array(
	'PHRASE' =>  'Vous avez déjà atteint le grade le plus élévé'
));
}else{
$sql = query("SELECT nom FROM info_grade WHERE grade = '".$grade_vise."' ");
$infograde = mysql_fetch_assoc($sql);
$phrase = 'Voici les differentes conditions que vous devez posseder pour atteindre le grade de '.$infograde['nom'].'('.$grade_vise.') : ';
$template->assign_vars(array(
	'PHRASE' =>  $phrase
	));
$sql2 = query("SELECT * FROM bt_grade WHERE grade = '".$grade_vise."' ");
	while($grade_condition = mysql_fetch_assoc($sql2))
	{
		$template->assign_block_vars('condition',array(
		'PHRASE2' =>  '- '.$grade_condition['phrase']
		));
	}	
}
//////////////////////////////////passe en templates
$template-> set_filenames(array(
	'page' => 'textes/objectifs.tpl'
));
$template->assign_var_from_handle('PAGE', 'page');
?>