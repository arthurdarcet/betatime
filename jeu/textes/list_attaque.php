<?
	if($_SESSION['grade'] == 1){ redirection('msg_info.php?class=divers&id=1' , 'php'); exit; }
	$fichier = 'textes/list_attaque.tpl';
	$template->set_filenames(array(
		'page' => $fichier
	));
	
	// On met dans une variable le nombre de messages qu'on veut par page
	$nombreDeMessagesParPage = 20; // Essayez de changer ce nombre pour voir :o)

	// On récupère le nombre total de messages
	$retour = mysql_query('SELECT COUNT(*) AS nb_users FROM bt_users');
	$donnees = mysql_fetch_array($retour);
	$totalDesMessages = $donnees['nb_users'];
	
	$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
	
	if(isset($_GET['ordre'])) { $ordre = addslashes($_GET['ordre']);}
	else  {$ordre = 'user'; }

	if(!empty($_GET['asc'])) { addslashes($asc = $_GET['asc']);}
	else {$asc = 'ASC'; }
	if($asc != 'ASC' AND $asc != 'DESC'){hack('Tentative d\'inclusion sql. Modification du code HTML');}

	$liste_des_pages = 'Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++)
	{
		$liste_des_pages .= '<a href="index.php?page=list_attaque&ordre='.$ordre.'&p=' . $i . '">' . $i . '</a> ';
	}
	
	if (isset($_GET['p'])){ $page = $_GET['p'];}
	else {$page = 1; }
	
	// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;

	$select = query('SELECT * FROM bt_users WHERE iduser != "'.$_SESSION['iduser'].'" AND grade >= 2 ORDER BY '.$ordre.' '.$asc.' LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
	
	if($ordre == 'user'){$user_asc = 'DESC';}
	elseif($ordre == 'grade'){$grade_asc = 'DESC';}
	elseif($ordre == 'terrain'){$terrain_asc = 'DESC';}
	elseif($ordre == 'alliance'){$alli_asc = 'DESC';}
	elseif($ordre == 'victoire'){$vic_asc = 'DESC';}
	elseif($ordre == 'defaite'){$def_asc = 'DESC';}
	else { hack('Tentative de modification du ORDER BY de la list_attaque. Modification du code HTML');}

	$template->assign_vars(array(
		'PAGES'			=> $liste_des_pages,
		'PAGE'			=> $_GET['p'],
		'USER_ASC' 		=> $user_asc,
		'GRADE_ASC'		=> $grade_asc,
		'TERRAIN_ASC'	=> $terrain_asc,
		'ALLI_ASC'		=> $alli_asc,
		'VIC_ASC'		=> $vic_asc,
		'DEF_ASC'		=> $def_asc
	));
	while($donnees = mysql_fetch_assoc($select)) {
		$id_def = $donnees['iduser'];
		// 1 jour = 86400 secondes
		$tps = time() - 86400;
		$q = query("SELECT COUNT(*) AS nb_att FROM bt_attaques_effectuees WHERE id_attaquant = ".$_SESSION['iduser']." AND id_defenseur = '".$id_def."' AND timestamp > '".$tps."' ");
		$t = mysql_fetch_assoc($q);
		if($t['nb_att'] != 0){$bouton = ' disabled = \'disabled\' ';}else{$bouton = '';}
		$template->assign_block_vars('attaque', array(
			'NOM'		=> $donnees['user'],
			'GRADE'		=> $donnees['grade'],
			'TERRAIN' 	=> $donnees['terrain'],
			'ALLIANCE' 	=> $donnees['alliance'],
			'ID'		=> $donnees['iduser'],
			'VIC'		=> $donnees['victoire'],
			'DEF'		=> $donnees['defaite'],
			'BOUTON'	=> $bouton
		));
	}
	$template->assign_var_from_handle('PAGE', 'page');
	 ?>