<?
	$grade = $_SESSION['grade'];

	$query = query("SELECT id , nom  FROM info_bat WHERE level_min <= '".$grade."' AND type = 'prod'");
	while ($result = mysql_fetch_assoc($query) ) {
		$template->assign_block_vars('eco', array(
			'ID'	=> $result['id'],
			'NOM'	=> $result['nom']
		));
	}
	$query = query("SELECT  id , nom  FROM info_bat WHERE level_min <= '$grade' AND type = 'def'");
	while ($result = mysql_fetch_assoc($query) ) {
		$template->assign_block_vars('def', array(
			'ID'	=> $result['id'],
			'NOM'	=> $result['nom']
		));
	}
	if($_SESSION['grade'] >= 2)
	{
		$query = query("SELECT  id , nom  FROM info_bat WHERE level_min <= '$grade' AND type = 'prototype'");
		while ($result = mysql_fetch_assoc($query) ) {
			$template->assign_block_vars('proto', array(
				'ID'	=> $result['id'],
				'NOM'	=> $result['nom']
			));
		}
		$query = query("SELECT  id , nom  FROM info_bat WHERE level_min <= '$grade' AND type = 'clone'");
		while ($result = mysql_fetch_assoc($query) ) {
			$template->assign_block_vars('clone', array(
				'ID'	=> $result['id'],
				'NOM'	=> $result['nom']
			));
		}
		
		$query = query("SELECT  id , nom  FROM info_bat WHERE level_min <= '$grade' AND type = 'stockage'");
		while ($result = mysql_fetch_assoc($query) ) {
			$template->assign_block_vars('stock', array(
				'ID'	=> $result['id'],
				'NOM'	=> $result['nom']
			));
		}
	}
	$template->set_filenames(array(
		'menu_gauche' => 'menu_gauche.tpl'
	));
	if ($_SESSION['level'] == 2) {
		$template->set_filenames(array(
			'menu_admin_at' => 'menu/menu_admin_at.tpl'
		));		
		$template->assign_var_from_handle('ADMIN', 'menu_admin_at');
	};
	if ($_SESSION['level'] == 5) {
		$template->set_filenames(array(
			'menu_admin' => 'menu/menu_admin.tpl'
		));		
		$template->assign_var_from_handle('ADMIN', 'menu_admin');
	};
	$select = query("SELECT chef FROM bt_alliance_member WHERE iduser = ".$_SESSION['iduser']);
	$donnees = mysql_fetch_assoc($select);
	if($donnees['chef'] == 'true'){
		$template->set_filenames(array(
			'menu_alli' => 'menu/menu_alli_chef.tpl'
		));
	}elseif ($_SESSION['alliance'] != 'Aucune' ) {
		$template->set_filenames(array(
			'menu_alli' => 'menu/menu_alli_oui.tpl'
		));
	}elseif($_SESSION['grade'] >= 5){
		$template->set_filenames(array(
			'menu_alli' => 'menu/menu_alli_non_g5.tpl'
		));
	}else{
		$template->set_filenames(array(
			'menu_alli' => 'menu/menu_alli_non_pasg5.tpl'
		));
	}

	if($grade == 1){
		$template->set_filenames(array(
			'constructions' => 'menu/menu_construction_g1.tpl'
		));
	}else{
		$template->set_filenames(array(
			'constructions' => 'menu/menu_construction_pasg1.tpl'
		));
	}
	$template->assign_var_from_handle('CONSTRUCTIONS', 'constructions');
	$template->assign_var_from_handle('ALLI', 'menu_alli');
	///
	$template->assign_var_from_handle('MENU', 'menu_gauche');
?>