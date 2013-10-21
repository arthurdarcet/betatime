<?
		$alli = $_SESSION['alliance'];
		$idalli = alli2id($alli);
		if($alli == 'Aucune'){hack($alli.'<br>Tentative de quitter une alliance sans en avoir => modification des adresses');}
		$chef = $_GET['chef'];
		if($_GET['chef'] == 'non'){
			$text = '<p>Etes vous certain de vouloir quitter cette alliance ?</p>
						<div align="right">
							<a href="index.php?page=alliance&p2=quitter&chef=non&valid=oui"><input type="button" value="Valider" /></a>
							<a href="index.php"><input type="button" value="Annuler" /></a>
						</div>';
		}elseif($chef == 'dissoudre' or $chef == 'quitter'){
			$select = query("SELECT chef FROM bt_alliance_list WHERE id = ".$idalli."");
			$donnees = mysql_fetch_assoc($select);
			if($_SESSION['iduser'] != $donnees['chef']){
				hack('Tentative de dissolution d une alliance sans etre chef => modification d un GET'); }
			if($chef == 'dissoudre'){
				$text = '<p>Etes vous certain de vouloir dissoudre cette alliance ?</p>
						<p>Si vous désirez plutôt passer le commandement de votre alliance à un de vos membres, choisissez Annuler puis le bouton Quitter mon alliance</p>
						<div align="right">
							<a href="index.php?page=alliance&p2=quitter&chef=dissoudre&valid=oui"><input type="button" value="Valider" /></a>
							<a href="index.php"><input type="button" value="Annuler" /></a>
						</div>';
			}elseif($chef  == 'quitter') {
				$s = query("SELECT COUNT(*) AS nbr_alli FROM bt_alliance_member WHERE alliance = $idalli");
				$d = mysql_fetch_assoc($s);

				if($d['nbr_alli'] == 1){ hack('Tentative de quitter une alliance en étant chef mais sans la dissoudre et en étant seul => modif d un GET'); }
				$select = query("SELECT iduser FROM bt_alliance_member WHERE alliance = ".$idalli."' AND iduser != ".$_SESSION['iduser']);
				while($donnees = mysql_fetch_assoc($select)){
					$liste_membres .= '<option value="'.$donnees['iduser'].'" name="'.$donnees['user'].'" />';
				}

				$text = '<p>Etes vous certain de vouloir quitter votre alliance ?</p>
						<p>Si oui Choisissez quelqu\'un pour exercer vos fonctions de chef et cliquez sur Valider</p>
						<div align="right">
							<form method="POST" action="index.php?page=alliance&p2=quitter&chef=quitter&valid=oui">
								<select name="new_chef">'.$liste_membres.'</select>
								<input type="submit" value="Valider" />
							</form>
							<a href="index.php"><input type="button" value="Annuler" /></a>
						</div>';
			}
		}else{ hack('Recherche de faille : Modification du GET chef dans les alliances'); }
		
		
	//////////////// On fait d'abord toutes les verif puis on passe a la partie valid ou non //////////////
	if($_GET['valid'] != 'oui' AND $_SESSION['alliance'] != 'Aucune'){
		$template->set_filenames(array(
			'page' => 'textes/vide.tpl'
		));		
		if($chef == 'dissoudre'){$titre = 'Dissoudre votre alliance ?';}
		else{$titre = 'Quitter votre alliance ?'; }
		$template->assign_vars(array(
			'TITRE'		=> $titre,
			'MESS'		=> $text
		));
		$template->assign_var_from_handle('PAGE', 'page');
	}elseif($_GET['valid'] == 'oui' AND $_SESSION['alliance'] != 'Aucune'){
		if(!isset($_POST['new_chef']) and $chef == 'quitter'){
			header('location: index.php?page=alliance&p2=quitter&chef=quitter&valid=non'); }
		if($chef == 'quitter' or $chef == 'non' or $chef == 'dissoudre'){
			query("UPDATE bt_users SET alliance = 0 WHERE iduser = '".$_SESSION['iduser']."'");
			query("DELETE FROM bt_alliance_member WHERE iduser = '".$_SESSION['iduser']."'");
			query("UPDATE bt_alliance_list SET nbr_membre = nbr_membre - 1 WHERE nom = '".$_SESSION['alliance']."'");
		}
		if($chef == 'quitter'){
			$select = query("SELECT iduser FROM bt_alliance_member WHERE alliance = ".$idalli);
			while($data = mysql_fetch_assoc($select)){
				query("INSERT INTO bt_alerte_historique VALUES ('' , '".
					$data['iduser']."' , 'annonce' , 'alliance_chef_remplace' , 0 , '".
					$_POST['new_chef']."' , '".time()."' , 'non' )");
			}
			query("UPDATE bt_alliance_list SET chef = 'true' WHERE iduser = ".$_POST['new_chef']);
		}elseif($chef == 'dissoudre'){
			$select = query("SELECT iduser FROM bt_alliance_member WHERE alliance = ".$idalli);
			while($data = mysql_fetch_assoc($select)){
				query("INSERT INTO bt_alerte_historique VALUES ('' , '".
					$data['iduser']."' , 'annonce' , 'alliance_dissoute' , 0 , '' , '".time()."' , 'non' )");
			}
			query("DELETE FROM bt_alliance_list WHERE nom = '".$_SESSION['alliance']."'");
			query("DELETE FROM bt_alliance_member WHERE alliance = '".$_SESSION['alliance']."'");
		}
		header('location: index.php?page=alliance&popup=Vous avez bien quitté votre alliance');
	}
?>