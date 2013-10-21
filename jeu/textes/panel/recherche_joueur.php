<?php
if(isset($_POST['pseudo_recherche']) AND isset($_POST['type']) AND isset($_POST['tri']) AND isset($_POST['ordre']))
{
	$pseudo = $_POST['pseudo_recherche'];
	$type = $_POST['type'];
	$champ = $_POST['champ'];
	if(is_numeric($type))
	{
		if($type == 2)
		{
			$sql_type = " ".$champ." LIKE '".$pseudo."%' ";
		}elseif($type == 3)
		{
			$sql_type = " ".$champ." LIKE '%".$pseudo."' ";
		}elseif($type == 4)
		{
			$sql_type = " ".$champ." = '".$pseudo."' ";
		}else{
			$sql_type = " ".$champ." LIKE '%".$pseudo."%' ";
		}
	}
	$sql = query("SELECT iduser , user , mail , ip , derniere_connexion FROM bt_users WHERE ".$sql_type." ORDER BY ".$_POST['tri']." ".$_POST['ordre']." ");
	$nbr_result = mysql_num_rows($sql);
	
	$template->assign_vars(array(
		'NBR_RESULAT' => $nbr_result,
		'RECHERCHE' => $pseudo
	));
	
	if($nbr_result != 0)
	{
		while($info = mysql_fetch_assoc($sql))
		{
			$date = data($info['derniere_connexion']);
		////////////////////////////
			$template->assign_block_vars('info' , array(
				'ID' => $info['iduser'],
				'PSEUDO' => ucwords($info['user']),
				'MAIL' => $info['mail'],
				'IP' => $info['ip'],
				'DER_VISITE' => $date
			));
		}
	}
	
	$template->set_filenames(array(
		'page' => 'textes/panel/recherche_joueur_resultat.tpl'
	));
}else{
	$template->set_filenames(array(
		'page' => 'textes/panel/recherche_joueur_form.tpl'
	));
}

$template->assign_var_from_handle('PAGE', 'page');
?>