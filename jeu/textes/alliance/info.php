<?
	if(isset($_GET['alli'])){$alli = $_GET['alli'];}elseif($_SESSION['alliance']!='Aucune'){$alli = $_SESSION['alliance'];}
	else{header('location: index.php?page=alliance');}
	$select = query("SELECT * FROM bt_alliance_list WHERE nom = '".$alli."' ");
	$donnees = mysql_fetch_assoc($select);
	
	$idalli = alli2id($alli);
	$s = query("SELECT COUNT(*) AS nbr_alli FROM bt_alliance_member WHERE alliance = '$idalli'");
	$d = mysql_fetch_assoc($s);
	if($alli == $_SESSION['alliance']){ $fichier = 'info_mon_alli.tpl';}
	else{ $fichier = 'info_son_alli.tpl';}
	$template->set_filenames(array(
		'page' => 'textes/alliance/'.$fichier
	));		
	
	if($_SESSION['iduser'] == $donnees['chef'] AND $d['nbr_alli'] > 1) {
			$template->assign_vars(array(
				'QUITER_DISSOUDRE'		=> '<form action="index.php?page=alliance&p2=quitter&chef=dissoudre" method="POST">
												<input type="submit" value="Dissoudre mon alliance" />
												<input type="hidden" name="alliance" value="'.$donnees['nom'].'" />
											</form>
											<form action="index.php?page=alliance&p2=quitter&chef=quitter" method="POST">
												<input type="submit" value="Quiter mon alliance" />
												<input type="hidden" name="alliance" value="'.$donnees['nom'].'" />
											</form>'
			));
	}elseif($_SESSION['iduser'] == $donnees['chef'] AND $d['nbr_alli'] == 1){
			$template->assign_vars(array(
				'QUITER_DISSOUDRE'		=> '<form action="index.php?page=alliance&p2=quitter&chef=dissoudre" method="POST">
												<input type="submit" value="Dissoudre mon alliance" />
												<input type="hidden" name="alliance" value="'.$donnees['nom'].'" />
											</form>'
			));
		
	}elseif($_SESSION['alliance'] == $alli){
			$template->assign_vars(array(
				'QUITER_DISSOUDRE'		=> '<form action="index.php?page=alliance&p2=quitter&chef=non" method="POST">
												<input type="submit" value="Quiter mon alliance" />
												<input type="hidden" name="alliance" value="'.$donnees['nom'].'" />
											</form>'
			));
	}
	$template->assign_vars(array(
		'NOM'		=> $donnees['nom'],
		'NBR_MEMBRE'=> $donnees['nbr_membre'],
		'CHEF'		=> id2user($donnees['chef']),
		'CREATEUR'	=> id2user($donnees['createur']),
		'CREATION'	=> date('d/m/Y',$info['date_creation']),
		'SITE'		=> $donnees['site'],
		'ID'		=> $donnees['id'],
		'IMG' 		=> $donnees['img']
	));
	
	$select2 = query("SELECT bt_users.iduser, user, grade, date_inscription, derniere_connexion FROM bt_alliance_member LEFT JOIN bt_users ON bt_alliance_member.iduser = bt_users.iduser WHERE bt_alliance_member.alliance = $idalli AND bt_alliance_member.accepte = 'true'");
	while( $d = mysql_fetch_assoc($select2) ) {
		$template->assign_block_vars('list_membre', array(
			'USER'			=> ucfirst($d['user']),
			'GRADE'			=> $d['grade'],
			'ANCIENNETE'	=> date('j \j\o\u\r\s',time() - $d['date_inscription']),
			'LAST_VISITE'	=> date('d-m-Y h\hi', $d['derniere_connexion'])
		));
	}
	$template->assign_var_from_handle('PAGE', 'page');
?>