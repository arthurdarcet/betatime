<?
	if(isset($_POST['theme'])) 
	{
		if(isset($_SESSION['iduser']))
		{
			query("UPDATE bt_users SET theme = '".$_POST['theme']."' WHERE iduser = '".$_SESSION['iduser']."' ");
		}
	$_SESSION['theme'] = $_POST['theme'];
	redirection('msg_info.php?class=option&id=5');
	}
	$result = query('SELECT nom_court , nom_long FROM bt_theme ORDER BY pref');
	while( $row = mysql_fetch_assoc($result) ) {
		$template->assign_block_vars('list_theme', array(
			'NOM_LONG'	=> stripslashes($row['nom_long']),
			'NOM_COURT'	=> $row['nom_court']
		));
	}
	
	$template->set_filenames(array(
		'select_theme' => 'textes/select_theme.tpl'
	));
	$template->assign_var_from_handle('THEME', 'select_theme');
?>