<?
	$select = query("SELECT chef, exterieur FROM bt_alliance_member WHERE iduser = ".$_SESSION['iduser']);
	$donnees = mysql_fetch_assoc($select);
	if($donnees['chef'] != 'true' && $donnees['exterieur'] != 'true'){
		hack('Tentative d acces aux candiatures sans en avoir les droits');
	}
	include('scripts/alliances/candidature.php');
	$template->set_filenames(array(
		'page' => 'textes/alliance/candidature.tpl'
	));		
	$idalli = alli2id($_SESSION['alliance']);
	$select2 = query("SELECT bt_users.iduser AS iduser, user, grade, date_inscription, derniere_connexion FROM bt_alliance_member LEFT JOIN bt_users ON bt_alliance_member.iduser = bt_users.iduser WHERE bt_alliance_member.alliance = $idalli AND bt_alliance_member.accepte = 'false'");
	while( $d = mysql_fetch_assoc($select2) ) {
		$template->assign_block_vars('list_membre', array(
			'IDUSER'		=> $d['iduser'],
			'USER'			=> ucfirst($d['user']),
			'GRADE'			=> $d['grade'],
			'ANCIENNETE'	=> date('j \j\o\u\r\s',time() - $d['date_inscription']),
			'LAST_VISITE'	=> date('d-m-Y h\hi', $d['derniere_connexion'])
		));
	}
	$template->assign_var_from_handle('PAGE', 'page');
?>
