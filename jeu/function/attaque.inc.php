<?php
	function force($iduser , $position)
	{
		$force = 0;//initialise la variable
		if($position == 'attaque')
		{
			$sql = query("SELECT 
bt_clone_user.nbr , 
info_unit.niv_attaque AS attaque 
FROM bt_clone_user
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id 
WHERE bt_clone_user.iduser = '".$iduser."' AND bt_clone_user.nbr != 0");
			while($info = mysql_fetch_assoc($sql))
			{
				$force += $info['nbr'] * $info['attaque'] ;
			}
		}elseif($position == 'defense')
		{
			$sql = query("SELECT 
bt_clone_user.nbr , 
info_unit.niv_defense AS defense  
FROM bt_clone_user
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id 
WHERE bt_clone_user.iduser = '".$iduser."' AND bt_clone_user.nbr != 0");
			while($info = mysql_fetch_assoc($sql))
			{
				$force += $info['nbr'] * $info['defense'] ;
			}
			//Pour la d�fense on ajoute les tourelles
			$sql2 = query("SELECT 
bt_bat_user.nbr , 
info_bat.attaque AS attaque , 
info_bat.defense AS defense 
FROM bt_bat_user
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id 
WHERE bt_bat_user.iduser = '".$iduser."' AND bt_bat_user.nbr != 0 AND bt_bat_user.class = 2 ");
			
			while($info_def = mysql_fetch_assoc($sql2))
			{
				$force += $info_def['nbr'] * (($info_def['attaque']*2)+($info_def['defense']*2));
			}
		}
		return $force;
	}
	
	function attaquer($attaquant , $defenseur)
	{
		if(is_numeric($attaquant) AND is_numeric($defenseur))
		{
			//Ici on fera les verif comme quoi les 2 sont g1 et qu'il peuvent s'attaquer
			if($attaquant == $defenseur)
			{
				hack('Auto-attaque => modification du code html');
			}else{
				$force_attaquant = force($attaquant, 'attaque');
				$force_defenseur = force($defenseur, 'defense');
				if($force_attaquant == 0) 
				{
					alert("Vous n'avez pas d'unit�, vous ne pouvez donc pas attaquer");
					echo '<script language="JavaScript">
					window.location="index.php?page=list_attaque";
					</script>';
				}else{
					if ($force_attaquant == $force_defenseur ) { $force_defenseur += 1; }
					if ($force_attaquant > $force_defenseur) 
					{
						//Si l'attaquant a gagn� : le d�fenseur a donc perdu ses tourelles et ses unit�s en d�fenses ; l'attaquant lui perd l'equivalent de la force qu'il a eu besoin pour detruire les unit�s et tourelles adverses + de fa�on al�atoire quelques batiments selon la force restante de l'attaquant
						$restant = $force_attaquant - $force_defenseur;
						$perte = $force_attaquant - $restant ;
						$gagnant = $attaquant;
						$perdant = $defenseur;
					}else{
						//Si le d�fenseur a gagn� : l'attaquant a perdu toutes ces unit�s envoy� au combat ; le d�fenseur perd l'�quivalent de la force en unit� qu'il a eu besoin pour d�truire les unit�s adverses
						$restant = $force_defenseur - $force_attaquant;
						$gagnant = $defenseur;
						$perdant = $attaquant;
					}
					//On initialise quelque variables
					$TextRapportUnitesDefenseurDetruite = false;
					$TextRapportTourellesDefenseurDetruite = false;
					$TextRapportBatimentsDefenseurDetruits = false;
					$TextRapportUnitesAttaquantDetruits = false;
					$affich_ress = false ;
					///////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////L'attaquant a gagn� : 1 ) Pertes des unit�s et tourelles du d�fenseur//////////////////////////////
					///////////////2 ) Perte de quelques batiments du d�fenseur selon la force restante de l'atatquant ////////////////
					//////////////3 ) + perte pour l'attaquant de l'equivalent de la force /////////////////////////////////////////
					if($gagnant == $attaquant)
					{
						$sql = query("SELECT 
bt_clone_user.nbr , 
info_unit.nom_unit AS nom_unit
FROM bt_clone_user 
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id 
WHERE iduser = '".$perdant."' AND nbr != 0");
						while($data_unit_defenseur = mysql_fetch_assoc($sql)) {
							$unit_perdues_perdant .= '<li>'.$data_unit_perdant['nbr'].' '.$data_unit_perdant['nom_unit'].'</li>';
							$TextRapportUnitesDefenseurDetruite = true;
						}
						query("UPDATE bt_clone_user SET nbr = 0 WHERE iduser = '".$perdant."' AND nbr != 0");
						//////Maintenant les tourelles
						$sql2 = query("SELECT 
	bt_bat_user.nbr , 
	info_bat.nom 
	FROM bt_bat_user 
	LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id 
	WHERE bt_bat_user.iduser = '".$perdant."' AND bt_bat_user.class = 2 AND bt_bat_user.nbr != 0");
							while($data_tourelle = mysql_fetch_assoc($sql2))
							{
								$text_debut_tourelle = 'Les Tours de d�fense suivantes : ';
								$text_tourelles .= '<li>'.$data_tourelle['nbr'].' '.$data_tourelle['nom'].'</li>';
								$TextRapportTourellesDefenseurDetruite = true;
							}
						query("UPDATE bt_bat_user SET nbr = 0 WHERE iduser = '".$perdant."' AND class = 'def'");
						//PARTIE 2 : Certains bat du d�fenseur sont d�truits : Les bat qui ont le moins de defense d'abord. 
						$sql3 = query("SELECT 
bt_bat_user.idbat , 
bt_bat_user.nbr , 
info_bat.defense , 
info_bat.nom 
FROM bt_bat_user 
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
WHERE bt_bat_user.iduser = '".$perdant."' AND bt_bat_user.destructible = 0 AND bt_bat_user.nbr != 0 ORDER BY info_bat.defense ASC");
						while($data = mysql_fetch_assoc($sql3) AND $restant > 50) 
						{
							///////////////// Voila la formule de destruction des bat
							// 1. On trie els bat par ordre decroissant
							// 2. On d�truit un nbr un peu aleatoire des batiments du premier type
							// 3. On update la force de lataquant restante pour detruire les autre batiments
							// et on recommence, sachant qu'il reste plus de force pour s'attaquer au derniers batiments
							// Les ateliers de frappe seront rarement touch� mais je met une limite a 2 ateliers detruits
							//2. 
							//By guigui : Il ne faut pas que ca detruise environplus de 20% du nombre de bat
							$nbr_restant = round($data['nbr'] * ($data['defense'] * 3) / mt_rand(1 , $restant) ,0);
							$nbr_detruit = $data['nbr'] - $nbr_restant;
							//10% de ce nbr 
							$pourcentage = round($data['nbr'] * 0.13 , 0);
								if($nbr_detruit > $pourcentage){$nbr_detruit = $pourcentage;}
							// On v�rifie qu'on trucide pas trop d'atelier (pas plus de 2) 
									if($data['idbat'] == 1 AND $nbr_detruit >2) { $nbr_detruit = 2; $nbr_restant = $data['nbr'] - $nbr_detruit; } 
							//3. 
							$restant -= ($nbr_detruit * $data['defense']) * 20;

							query("UPDATE bt_bat_user SET nbr = '".$nbr_restant."' WHERE iduser = '".$perdant."' AND idbat = '".$data['idbat']."'");
							
							if($nbr_detruit > 0)
							{
								$ListBatimentsPerdusDefenseur .= '<li>'.$nbr_detruit.' '.$data['nom'].'</li>';
								$TextRapportBatimentsDefenseurDetruits = true;
							}
						}
						//PARTIE 3 : l'attaquant perds des unit�s : equivalent de la force du defenseur
						if($perte > 0)
						{
							$sql4 = query("SELECT 
bt_clone_user.nbr , 
bt_clone_user.idunit , 
info_unit.niv_defense AS defense , 
info_unit.nom_unit AS nom_unit 
FROM bt_clone_user 
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id 
WHERE bt_clone_user.iduser = '".$gagnant."' AND bt_clone_user.nbr != 0 ORDER BY info_unit.niv_defense ASC");
							while($data_destruction_unit_attaquant = mysql_fetch_assoc($sql4) AND $perte > 10)
							{
								//On d�truit des unit� selon la force qu'il ont eu besoin pour detruire  les defense adverses
								//Pas plus de 75% des unit�s sont detruites
								$nbr_restant = round($data_destruction_unit_attaquant['nbr'] * ($data_destruction_unit_attaquant['defense'] * 3) / mt_rand(1 , $perte) ,0);
								$nbr_detruit = $data_destruction_unit_attaquant['nbr'] - $nbr_restant;
								//75% de ce nbr 
								$pourcentage = round($data_destruction_unit_attaquant['nbr'] * 0.75 , 0);
									if($nbr_detruit > $pourcentage){$nbr_detruit = $pourcentage;}
									
								$perte -= ($nbr_detruit * $data['defense']) * 10;

								if ($nbr_restante < 0) {$nbr_restante = 0; }else
								{
									query("UPDATE bt_clone_user SET nbr = '".$nbr_restante."' WHERE iduser = '".$gagnant."' AND idunit = '".$data_destruction_unit_attaquant['idunit']."' ");
									if($nbr_detruit > 0)
									{
										$unit_perdues_gagnant .= '<li>'.$nbr_detruit.' '.$data_destruction_unit_attaquant['nom_unit'].'</li>'; 
										$TextRapportUnitesAttaquantDetruits = true;
									}
								}
							}
							//////////////////////////////////
							//VOL DE RESSOURCES///////////
							///////////////////////////////////
								$perte_ressource = 1/(8*$perte);
								$stockable = array(true, true, true, true, false, false , true, false);
								$ress= array('uranium', 'H2', 'eau', 'beta', 'elec' ,  'nourriture', 'O2', 'pillule');
								$rev = array('uranium' => 0, 'H2' => 1, 'eau' => 2, 'beta' => 3, 'elec' => 4, 'nourriture' => 5, 'O2' => 6, 'pillule' => 7);
								$restante = array(0,0,0,0,0,0,0,0);
								$volee = array(0,0,0,0,0,0,0,0);
								$sel = query('SELECT * FROM bt_ressources WHERE iduser = '.$perdant);
								$ressources = mysql_fetch_assoc($sel);
								
								for($i=0;$i<sizeof($ress);$i++) {
									if ($stockable[$i] AND $ressources[$ress[$i]] > 0) {
										$volee = $ressources[$ress[$i]] * $perte_ressource * rand(0.7,1.2);
										if($volee < 1000){ $volee = 0;} // on retire les vol minable pour que ca soit plus propre
										$restante[$i] = $ressources[$ress[$i]] - $volee;
										$volee[$i] = $volee;
										if($volee > 500)
										{
											$vol_ressource .= '<li><img alt="'.ucwords($ressources[$i]).'" src="templates/'.$_SESSION['theme'].'/images/ressources/'.$ressources[$i].'.gif" /> '.number_format($volee,2,'.',' ').'</li>'; 
											$affich_ress = true;
										}
									}
								}
								
								query("UPDATE bt_ressources SET uranium = ".$restante[0].
															", eau = ".$restante[2].
															", H2 = ".$restante[1].
															", O2 = ".$restante[6].
															", pillule = ".$restante[7].
															", beta = ".$restante[3].
															" WHERE iduser = ".$perdant);
								
								query("UPDATE bt_ressources SET uranium = uranium + ".$volee[0].
																", eau = eau + ".$volee[2].
																", H2 = H2 + ".$volee[1].
																", O2 = O2 + ".$volee[6].
																", pillule = pillule + ".$volee[7].
																", beta = beta + ".$volee[3].
																" WHERE iduser = ".$gagnant);
						}
					}elseif($gagnant == $defenseur)
					{
						//Dans ce cas l� tu c�t� de l'attaquant, toutes ces unit�s sont detruites, il ne vole aucune ressources et pour le d�fenseur certaines tourelles et certaines unit�s sont detruites.
						/////////////////////////////////////////////
						///ATTAQUANT : UNITES DETRUITES//////////////
						/////////////////////////////////////////////
						$sql6 = query("SELECT 
										bt_clone_user.nbr , 
										info_unit.nom_unit 
										FROM bt_clone_user
										LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id 
										WHERE bt_clone_user.iduser = '".$attaquant."' AND bt_clone_user.nbr != '0' ");
						while($data_unite_attaquant_detruites = mysql_fetch_assoc($sql6))
						{
							$unit_perdues_gagnant .= '<li>'.$data_unite_attaquant_detruites['nbr'].' '.$data_unite_attaquant_detruites['nom_unit'].'</li>';
							$TextRapportUnitesAttaquantDetruits = true;
						}
						query("UPDATE bt_clone_user SET nbr = '0' WHERE nbr != '0' ANd iduser = '".$attaquant."' ");
						///////////////////////////////////////////////////////////////
						/////Ataquant detruit d'abord unit�s pui apres les tourelles///
						////On verifie si les unit�s ont ete detruites/////////////////
						///////////////////////////////////////////////////////////////
						//On cherche la force des tourelles et a part des unit� du defenseur
					}
						
						////////////////////////////////////////////////////////////////////////
						////////////////////////RAPPORT D'aTTAQUE//////////////////////////////
						//////////////////////////////////////////////////////////////////////////
						$user_att = id2user($attaquant);
						$user_def = id2user($defenseur);
						$user_att = ucwords($user_att);
						$user_def = ucwords($user_def);
						//////////////////////////////////////////
						///LES PHRASES AVANT LE RAPPORT/////////
						//////////////////////////////////////////
						
						$text_victoire_attaquant = '<p>Attaque envers '.$user_def.'</p>
							<p>Vous avez fait le bon choix en attaquant, les d�fenses de votre adversaire n\'ont pas resit� !</p>';
						$text_defaite_attaquant = '<p>Attaque envers '.$user_def.'</p>
													<p>Votre arm�e s\'est fait repouss�e, vous avez perdu le combat !</p>';
								
						$text_victoire_defenseur = '<p>Attaque de '.$user_att.'</p>
													<p>Votre d�fense a r�sist�, l\'offensive de votre adversaire est un echec !</p>';
						$text_defaite_defenseur = '<p>Attaque de '.$user_att.'</p>
													<p>Votre d�fense n\'a pas resist� � l\'offensive de votre adversaire, vous avez perdu le combat</p>"';
						
						if($gagnant == $attaquant)
						{
							$debut_attaquant = $text_victoire_attaquant;
							$debut_defenseur = $text_defaite_defenseur;
						}else{
							$debut_attaquant = $text_defaite_attaquant;
							$debut_defenseur = $text_victoire_defenseur;
						}
						///////////////////////////////
						//REDACTION DU RAPPORT//////
						///////////////////////////////
						if($TextRapportUnitesAttaquantDetruits == true OR $TextRapportUnitesDefenseurDetruite == true) {$affich_unit = true; }
						if($TextRapportTourellesDefenseurDetruite == true OR $TextRapportBatimentsDefenseurDetruits == true) {$affich_bat = true; }
						
						if($affich_unit == true OR $affich_bat == true OR $affich_ress == true)
						{
							$rapport_attaquant = '<p>'.$debut_attaquant.'<br><br></p>
								<table width="95%">
									<tr>
										<th width = "40%"><p>Attaquant : <b>'.$user_att.'</b></p></th>
										<th width = "40%"><p>D�fenseur : <b>'.$user_def.'</b></p></th>
									</tr>';
									
									if($affich_unit)
									{
										$rapport_attaquant .= '<tr>
											<td><p>Vous avez perdu ces unit�s : <ul>'.$unit_perdues_gagnant.'</ul></p></td>
											<td><p>Vous avez d�truit ces unit�s : <ul>'.$unit_perdues_defenseur.'</ul></p></td>
										</tr>';
									}
									
									if($TextRapportTourellesDefenseurDetruite == true OR $affich_ress == true)
									{
										$rapport_attaquant .= '<tr>
											<td><p>Vous avez vol� les ressources suivantes :</p><ul>'.$vol_ressource.'</ul></td>
											<td>Vous avez d�truits les tourelles suivantes : 
											<ul>'.$text_tourelles.'</ul></td>
										</tr>';
									}
									
									if($TextRapportBatimentsDefenseurDetruits)
									{
										$rapport_attaquant .= '
										<tr>
											<td></td>
											<td><p>Ainsi que les batiments suivants :<ul>'.$ListBatimentsPerdusDefenseur.'</ul></p></td>
										</tr>';
									}
									$rapport_attaquant .= '</table>';
							/////////////////////////////////////////////
							///RAPPORT DEFENSEUR/////////////////////
							///////////////////////////////////////////
							$rapport_defenseur = '<p>'.$debut_defenseur.'<br><br></p>
								<table width="95%">
									<tr>
										<th width = "40%"><p>Attaquant : <b>'.$user_att.'</b></p></th>
										<th width = "40%"><p>D�fenseur : <b>'.$user_def.'</b></p></th>
									</tr>';
									
									if($affich_unit)
									{
										$rapport_defenseur .= '<tr>
											<td><p>Vos tourelles ont extermin� ces unit�s : <ul>'.$unit_perdues_gagnant.'</ul></p></td>
											<td><p>Vous avez perdu ces unit�s : <ul>'.$unit_perdues_defenseur.'</ul></p></td>
										</tr>';
									}
									
									if($TextRapportTourellesDefenseurDetruite == true OR $affich_ress == true)
									{
										$rapport_defenseur .= '<tr>
											<td><p>Vous vous �tes fait voler les ressources suivantes :</p><ul>'.$vol_ressource.'</ul></td>
											<td>Les unit�s adverses ont vos tourelles suivantes : 
											<ul>'.$text_tourelles.'</ul></td>
										</tr>';
									}
									
									if($TextRapportBatimentsDefenseurDetruits)
									{
										$rapport_defenseur .= '
										<tr>
											<td></td>
											<td><p>Ainsi que les batiments suivants :<ul>'.$ListBatimentsPerdusDefenseur.'</ul></p></td>
										</tr>';
									}
									$rapport_defenseur .= '</table>';
						}else{
							$rapport_attaquant = $debut_attaquant.'<p>Mais votre arm�e n\'�tait pas assez puissante pour faire des d�g�ts ou voler des ressources.';
							$rapport_defenseur = $debut_defenseur.'<p>Mais, heuresement, l\'arm� adverse n\'�tait pas assez puissante pour faire des d�gats ou voler des ressources';
						}
						
						///////////////////////////////////////////////////////////////////////////////
						/////////////////ON ENTRE DES DONNEES DANS LA BASE DE DONNEE////////////
						//////////////////////////////////////////////////////////////////////////////
						query("UPDATE bt_users SET victoire = victoire +1 WHERE iduser = $gagnant");
						query("UPDATE bt_users SET defaite = defaite +1 WHERE iduser = $perdant");
						query("INSERT INTO bt_attaques_effectuees VALUES('', $attaquant, $defenseur, $gagnant, ".time().")");
						$insert_id = mysql_insert_id();
						query("INSERT INTO bt_alerte_historique VALUES ('' , ".$attaquant." , 'histo' , 'rapport' , ".$insert_id." , '".mysql_real_escape_string($rapport_attaquant)."' , ".time()." , 'oui' ) , 
																	('' , ".$defenseur." , 'annonce' , 'rapport' , ".$insert_id." , '".mysql_real_escape_string($rapport_defenseur)."' , ".time()." , 'non' ) ");
				}
			}
		}else{
			hack(1, 'Les IDs ne sont pas des nombre => Modif du code html');
		} 
		return $rapport_attaquant ;
	}
?>