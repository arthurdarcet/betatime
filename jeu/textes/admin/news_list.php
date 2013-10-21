<?php
$sql = query("SELECT * FROM bt_news ORDER BY timestamp DESC");
while($info = mysql_fetch_assoc($sql))
{
		$template->assign_block_vars('news',array(
			'TITRE' =>  affich_text($info['titre']),
			'CREATEUR' => $info['pseudo'],
			'CONTENU' => affich_text($info['contenu']),
			'ID' => $info['id']
		));
}
	$template->set_filenames(array(
		'page' => 'textes/admin/news_list.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'page');
?>