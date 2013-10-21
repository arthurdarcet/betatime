<?
	include('conf/config.php');
	include('textes/alliance/poser_candidature.php');
	// On met dans une variable le nombre de messages qu'on veut par page
	$nombreDeMessagesParPage = 20; // Essayez de changer ce nombre pour voir :o)

	// On récupère le nombre total de messages
	$retour = mysql_query('SELECT COUNT(*) AS nb_users FROM bt_alliance_list');
	$donnees = mysql_fetch_array($retour);
	$totalDesMessages = $donnees['nb_users'];
	
	$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
	
	if(isset($_GET['ordre'])) { $ordre = addslashes($_GET['ordre']);}
	else  {$ordre = 'nom'; }

	if(!empty($_GET['asc'])) { addslashes($asc = $_GET['asc']);}
	else {$asc = 'ASC'; }
	if($asc != 'ASC' AND $asc != 'DESC'){hack('Tentative d\'inclusion sql. Modification du code HTML');}

	$liste_des_pages = 'Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++){
		$liste_des_pages .= '<a href="index.php?page=alliance&p2=liste_alliance&ordre='.$ordre.'&p=' . $i . '">' . $i . '</a> ';
	}
	
	if (isset($_GET['p'])){ $page = $_GET['p'];}
	else {$page = 1; }

	
	// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
	
	$select = query('SELECT * FROM bt_alliance_list ORDER BY '.$ordre.' LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
	$template->set_filenames(array(
		'page' => 'textes/alliance/list_alli.tpl'
	));
	
		// on vérifie qu'ilk n'a pas poser de candidature

	if($_SESSION['grade'] >= 5){$crea_alli = '<p>Note : Si vous désirez créer votre alliance, rendez-vous <a href="index.php?page=alliance&p2=creation">ici</a></p>'; }
	$template->assign_vars(array(
		'PAGES'				=> $liste_des_pages,
		'PAGE'				=> $page,
		'CREATION_ALLI'		=> $crea_alli,
		'NOM_ASC' 			=> $user_asc,
		'TYPE_ASC'			=> $grade_asc,
		'CHEF_ASC'			=> $terrain_asc,
		'NBR_MEMBRE_ASC'	=> $alli_asc,
		));

	while($donnees = mysql_fetch_assoc($select)) {
	if($_SESSION['alliance'] == 'Aucune'){
		$s = query("SELECT COUNT(*) AS nbr FROM bt_alliance_member WHERE iduser = ".$_SESSION['iduser']);
		$d = mysql_fetch_assoc($s);
		if($d['nbr'] == 0){
			$tmp = '<form action="?page=alliance" name="candidature_'.$donnes['id'].'" method="POST">
						<input type="submit" value="Rejoindre" />
						<input type="hidden" name="id_alli" value="'.$donnees['id'].'" />
					</form>';
		}
	}
		$template->assign_block_vars('list_alli', array(
			'NOM'				=> $donnees['nom'],
			'TYPE'				=> $donnees['type'],
			'CHEF'				=> ucwords(id2user($donnees['chef'])),
			'NBR_MEMBRE'		=> $donnees['nbr_membre'],
			'NBR_MAX_MEMBRE'	=> $donnees['nbr_max_membre'],
			'REJOINDRE' 		=> $tmp
		));
	}
	$template->assign_var_from_handle('PAGE', 'page');
?>
