<?
	include("function/bat.inc.php");
	include('scripts/bat_unit/vendre_clone.php');
	include('scripts/bat_unit/achat_bat.php');
	include('scripts/bat_unit/vente.php');
	include('scripts/bat_unit/achat_proto.php');
	include('scripts/bat_unit/achat_clone.php');
	$id = $_GET['id'];
	$class = $_GET['class'];

if($class == 'bat') {

	$sql = query("SELECT
bt_bat_user.nbr , 	
info_bat.type AS type , 
info_bat.nom AS nom , 
info_bat.nom_pluriel AS nom_pluriel , 
info_bat.nom_court AS nom_court , 
info_bat.prix AS prix , 
info_bat.comment AS comment , 
info_bat.conso1_type AS conso1_type , 
info_bat.conso1_nbr AS conso1_nbr , 
info_bat.conso2_type AS conso2_type , 
info_bat.conso2_nbr AS conso2_nbr , 
info_bat.prod1_type AS prod1_type , 
info_bat.prod1_nbr AS prod1_nbr , 
info_bat.prod2_type AS prod2_type , 
info_bat.prod2_nbr AS prod2_nbr , 
info_bat.capacite AS capacite , 
info_bat.attaque AS attaque , 
info_bat.type_unit AS type_unit , 
CEIL(info_bat.defense) AS defense 
FROM bt_bat_user 
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
WHERE bt_bat_user.idbat = '".$_GET['id']."' AND bt_bat_user.iduser = '".$_SESSION['iduser']."' 
");

	$infos = mysql_fetch_assoc($sql);
	
	if ($infos['nom'] == '' ) { hack("ID de l\'URL n\'existe pour aucun batiment !"); };
	
	////pour le prix de l'atelie de frappe/////
		if($id == 1) {
			$prix = prix_atelier($infos['nbr']);
		}else{
			$prix = $infos['prix'];
		}
	//pour les atlier de frappe, pas plu de 15 au g1 ...
	$grade = $_SESSION['grade'];
	$total_atelier = $grade * 15 ;
	
		if($id == 1 AND $infos['nbr'] >= $total_atelier)
		{
			$template->assign_vars(array(
				'ACHAT_ELSE'	=> 'Vous ne pouvez pas disposez de plus de 15 ateliers de frappe par grade.'
			));
		}else{
			$template->assign_block_vars('achat',array(
				'PRIX'	=> number_format($prix, 0 , ',' , ''),
			));
		}
	if($infos['nbr'] > 1) { $possession = $infos['nbr'].' '.$infos['nom_pluriel']; }
	else{ $possession = $infos['nbr'].' '.$infos['nom'];}
	$template->assign_vars(array(
		'PRIX' => number_format($prix, 0 , ',' , ''),
		'ID'	=> $id,
		'NBR_POSSESSION' => $possession,
		'NAME_IMAGE' => $infos['nom_court'],
		'NOM'	=> $infos['nom'],
		'COMMENT' => $infos['comment']
	));
/////vente des bat///by guigui
if($infos['nbr'] > 0)
{
	if($id == 1)
	{
		$nbr_atelier = $infos['nbr'] - 1;
		$prix_atelier = prix_atelier($nbr_atelier);
		$new_prix2 = $prix_atelier * 0.70;
		$new_prix = ceil($new_prix2);
		$taux = '70%';
	}else{
		$new_prix = $infos['prix'] * 0.50; ////si le taux est a changer, le changer egalement dans le script de vente
		$taux = '50%';
	}
	$template->assign_block_vars('vente',array(
		'PERTE'	=> $taux,
		'NEW_PRIX' => $new_prix
	));
}else{
		$template->assign_vars(array(
		'VENTE_ELSE'	=> '<p>- Vous devez possedé au moins un bâtiment pour le vendre.</p>'
		));
}

		// début de la création de la conso
		if ( $infos['conso1_type'] == 'elec' ) { $conso_type = 'électricité'; }	else { $conso_type = $infos['conso1_type'];	};
		
		$conso = ' <img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$infos['conso1_type'].'.gif" alt="'.$conso_type.'" title="'.$conso_type.'"/> ';
		$conso .= $infos['conso1_nbr']; 
		
		if ($infos['conso2_nbr'] != 0) {
			$conso .= '<br />';
			if ( $infos['conso2_type'] == 'elec' ) { $conso_type2 = 'électricité'; } else { $conso_type2 = $infos['conso2_type']; };
			$conso .= ' <img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$conso_type2.'.gif" alt="'.$conso_type2.'" title="'.$conso_type2.'" /> ';
			$conso .= $infos['conso2_nbr']; 
		}
		// fin de la création de la conso
		
		$template->assign_vars(array(
			'CONSO'	=> $conso
		));
		
	if($infos['type'] == 'prod')
	{	
				//début de la création de la production
			if ( $infos['prod1_type'] == 'elec' ) { $prod_type = 'électricité'; }	else { $prod_type = $infos['prod1_type'];	};
		
			$prod = ' <img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$infos['prod1_type'].'.gif" alt="'.$infos['prod1_type'].'" title="'.$infos['prod1_type'].'" /> ';
			$prod .= $infos['prod1_nbr']; 
		
			if ($infos['prod2_nbr'] != 0) {
				$prod .= '<br />';
				if ( $infos['prod2_type'] == 'elec' ) { $prod .= 'électricité'; } else { $prod .= $infos['prod2_type']; };
				$prod .= ' <img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$infos['prod2_type'].'.gif" alt="'.$infos['prod2_type'].'" title="'.$infos['prod2_type'].'" /> ';
				$prod .= $infos['prod2_nbr']; 
			};
			// fin de la création de la production
			$template->assign_vars(array(
				'PROD'	=> $prod
			));
			$template->set_filenames(array(
			'conso_prod_capacite_attdef' => 'textes/bats_unit/info_bat_conso_prod.tpl'
			));
			$template->assign_var_from_handle('CONSO_PROD_CAPACITE_ATTDEF', 'conso_prod_capacite_attdef');
	}
	if($infos['type'] == 'stockage') {
	
		$cap = $infos['capacite'].' places / '.$infos['nom']; 
		$dispo = $infos['capacite'] * $infos['nbr'];
		$utilise = $infos['places_utilise'].' / '.$dispo ;
		$template->assign_vars(array(
			'CAPACITE'	=> $cap
		));
		if($infos['nbr'] >= 1) 
		{
			$template->assign_block_vars('nbr_bat_sup_1' , array(
				'UTILISE' => $utilise
			));
		}
		$template->set_filenames(array(
		'conso_prod_capacite_attdef' => 'textes/bats_unit/info_bat_conso_capacite.tpl'
		));
		$template->assign_var_from_handle('CONSO_PROD_CAPACITE_ATTDEF', 'conso_prod_capacite_attdef');
	}
	if($infos['type'] == 'def') {
		$template->assign_vars(array(
			'ATTAQUE'	=> $infos['attaque'],
			'DEFENSE'	=> $infos['defense']
		));
		$template->set_filenames(array(
		'conso_prod_capacite_attdef' => 'textes/bats_unit/info_bat_conso_attdef.tpl'
		));
		$template->assign_var_from_handle('CONSO_PROD_CAPACITE_ATTDEF', 'conso_prod_capacite_attdef');
	}	
	if($infos['type'] == 'prototype') {
		if ( $infos['nbr'] != 0 ) 
		{
		$type_unit = array('homme' , 'capsule' , 'cyborg' , 'module');
			$sql2 = query("SELECT iduser FROM bt_proto_user WHERE iduser = '".$_SESSION['iduser']."' AND avance = 'debut' ");
			$num = mysql_num_rows($sql2);
			if($num > 0)
			{
			/////////////////////////////////////////////////////////////
			/////////////////////PROTO A DVPT//////////////////////////
			////////////////////////////////////////////////////////////
			
			//On les tri en 4 categories : homme , module , cyborg , capsule
			if($_SESSION['grade'] >= 2)
			{
			/////////////////////////////////////////////////////////////
			/////////////////////I ) LES HOMMES////////////////////////
			////////////////////////////////////////////////////////////
				$sql3 = query("SELECT
bt_proto_user.idunit , 
bt_proto_user.prix_aleatoire_proto ,
info_unit.nom_unit AS nom , 
info_unit.prix_proto_mini AS prix_proto_mini , 
info_unit.prix_proto_max AS prix_proto_max , 
info_unit.duree_proto AS duree_proto
FROM bt_proto_user 
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id
WHERE bt_proto_user.iduser = '".$_SESSION['iduser']."' AND bt_proto_user.avance = 'debut' AND type_unit = 'homme' 
");
				while($info_proto_homme = mysql_fetch_assoc($sql3) )
				{
						//le temps d'un proto a développer si inferieur a 2heures mettre en minutes
						$duree = round($info_proto_homme['duree_proto'] / 3600 , 1) ;
						//on met le prix du proto aleatoirement
							if($info_proto_homme['prix_aleatoire_proto'] == 0) {
								$prix = mt_rand($info_proto_homme['prix_proto_mini'] , $info_proto_homme['prix_proto_max']);
								query("UPDATE bt_proto_user SET prix_aleatoire_proto = '".$prix."' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$info_proto_homme['idunit']."' ");
							}else{
								$prix = $info_proto_homme['prix_aleatoire_proto'] ;
							}
							
							$template->assign_block_vars('list_unit_hommes',array(
								'ID'	=> $info_proto_homme['idunit'],
								'NOM'	=> $info_proto_homme['nom'],
								'PRIX'	=> $prix,
								'DUREE' => $duree
							));
				}
			}
			if($_SESSION['grade'] >= 3)
			{
				/////////////////////////////////////////////////////////////
				/////////////////////II ) LES CAPSULES///////////////////////
				////////////////////////////////////////////////////////////
				$sql4 = query("SELECT
bt_proto_user.idunit , 
bt_proto_user.prix_aleatoire_proto ,
info_unit.nom_unit AS nom , 
info_unit.prix_proto_mini AS prix_proto_mini , 
info_unit.prix_proto_max AS prix_proto_max , 
info_unit.duree_proto AS duree_proto
FROM bt_proto_user 
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id
WHERE bt_proto_user.iduser = '".$_SESSION['iduser']."' AND bt_proto_user.avance = 'debut' AND bt_proto_user.type_unit = 'capsule' 
");
				while($info_proto_capsule = mysql_fetch_assoc($sql4) )
				{
					//le temps d'un proto a développer si inferieur a 2heures mettre en minutes
					$duree = round($info_proto_capsule['duree_proto'] / 3600 , 1) ;
					//on met le prix du proto aleatoirement
					if($info_proto_capsule['prix_aleatoire_proto'] == 0) {
						$prix = mt_rand($info_proto_capsule['prix_proto_mini'] , $info_proto_capsule['prix_proto_max']);
						query("UPDATE bt_proto_user SET prix_aleatoire_proto = '".$prix."' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$info_proto_capsule['idunit']."' ");
					}else{
						$prix = $info_proto_capsule['prix_aleatoire_proto'] ;
					}
						
					$template->assign_block_vars('list_unit_capsules',array(
						'ID'	=> $info_proto_capsule['idunit'],
						'NOM'	=> $info_proto_capsule['nom'],
						'PRIX'	=> $prix,
						'DUREE' => $duree
					));
				}
			}
			if($_SESSION['grade'] >= 4)
			{
				/////////////////////////////////////////////////////////////
				/////////////////////III ) LES CYBORGS///////////////////////
				////////////////////////////////////////////////////////////
				$sql4 = query("SELECT
bt_proto_user.idunit , 
bt_proto_user.prix_aleatoire_proto ,
info_unit.nom_unit AS nom , 
info_unit.prix_proto_mini AS prix_proto_mini , 
info_unit.prix_proto_max AS prix_proto_max , 
info_unit.duree_proto AS duree_proto
FROM bt_proto_user 
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id
WHERE bt_proto_user.iduser = '".$_SESSION['iduser']."' AND bt_proto_user.avance = 'debut' AND type_unit = 'cyborg' 
");
				while($info_proto_cyborg = mysql_fetch_assoc($sql3) )
				{
					//le temps d'un proto a développer si inferieur a 2heures mettre en minutes
					$duree = round($info_proto_cyborg['duree_proto'] / 3600 , 1) ;
					//on met le prix du proto aleatoirement
					if($info_proto_cyborg['prix_aleatoire_proto'] == 0) {
						$prix = mt_rand($info_proto_cyborg['prix_proto_mini'] , $info_proto_cyborg['prix_proto_max']);
						query("UPDATE bt_proto_user SET prix_aleatoire_proto = '".$prix."' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$info_proto_cyborg['idunit']."' ");
					}else{
						$prix = $info_proto_cyborg['prix_aleatoire_proto'] ;
					}
						
					$template->assign_block_vars('list_unit_cyborgs',array(
						'ID'	=> $info_proto_cyborg['idunit'],
						'NOM'	=> $info_proto_cyborg['nom'],
						'PRIX'	=> $prix,
						'DUREE' => $duree
					));
				}
			}
			if($_SESSION['grade'] >= 5)
			{
				/////////////////////////////////////////////////////////////
				/////////////////////IV ) LES MODULES///////////////////////
				////////////////////////////////////////////////////////////
				$sql4 = query("SELECT
bt_proto_user.idunit , 
bt_proto_user.prix_aleatoire_proto ,
info_unit.nom_unit AS nom , 
info_unit.prix_proto_mini AS prix_proto_mini , 
info_unit.prix_proto_max AS prix_proto_max , 
info_unit.duree_proto AS duree_proto
FROM bt_proto_user 
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id
WHERE bt_proto_user.iduser = '".$_SESSION['iduser']."' AND bt_proto_user.avance = 'debut' AND type_unit = 'module' 
");
				while($info_proto_module = mysql_fetch_assoc($sql3) )
				{
					//le temps d'un proto a développer si inferieur a 2heures mettre en minutes
					$duree = round($info_proto_module['duree_proto'] / 3600 , 1) ;
					//on met le prix du proto aleatoirement
					if($info_proto_module['prix_aleatoire_proto'] == 0) {
						$prix = mt_rand($info_proto_module['prix_proto_mini'] , $info_proto_module['prix_proto_max']);
						query("UPDATE bt_proto_user SET prix_aleatoire_proto = '".$prix."' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$info_proto_module['idunit']."' ");
					}else{
						$prix = $info_proto_module['prix_aleatoire_proto'] ;
					}
						
					$template->assign_block_vars('list_unit_modules',array(
						'ID'	=> $info_proto_module['idunit'],
						'NOM'	=> $info_proto_module['nom'],
						'PRIX'	=> $prix,
						'DUREE' => $duree
					));
				}
			}
			}
				$template->set_filenames(array(
					'achat_prototype' => 'textes/bats_unit/info_bat_achat_prototype.tpl'
					));
				$template->assign_var_from_handle('ACHAT_PROTOTYPE', 'achat_prototype');
		}
			/////////////////////////////////////////////////////////
			///////////EN COURS DE DVPT////////////////////////////
			////////////////////////////////////////////////////////
			$sql3 = query("SELECT iduser FROM bt_proto_user WHERE iduser = '".$_SESSION['iduser']."' AND avance = 'en cours'");
			$nbr = mysql_num_rows($sql3);
			if($nbr != 0) 
			{
					$sql2 = query("SELECT 
bt_proto_user.fin_dvpt , 
bt_proto_user.debut_dvpt , 
info_unit.duree_proto AS duree_proto , 
info_unit.nom_unit AS nom 
FROM bt_proto_user 
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id
WHERE bt_proto_user.iduser = '".$_SESSION['iduser']."' AND bt_proto_user.avance = 'en cours' ORDER BY fin_dvpt DESC ");
				
					while($donnees = mysql_fetch_assoc($sql2)) {	
						
						$total_duree = $donnees['duree_proto'];
						$duree_restante2 = $donnees['fin_dvpt'] - time();
						$duree_restante = $duree_restante / 3600;
						
						//Pour gerer si on met en min ou bien en heures....
						if($duree_restante < 1)
						{
							$duree_restante = round( ($duree_restante2 / 60) , 2).' minute(s)'; //Temps en minutes 
						}else{
							$duree_restante = round($duree_restante , 1).' heure(s)';
						}
						$duree_effectue = time() - $donnees['debut_dvpt'];
						$pourcent_effectue = ( $duree_effectue * 100) / $total_duree ;
						$pourcent_effectue = round( $pourcent_effectue , 0);
						
						$template->assign_block_vars('proto_en_developement',array(
							'DUREE' => $duree_restante,
							'NOM' => $donnees['nom'],
							'POURCENTAGE' => $pourcent_effectue
						));	
					}
				$template->set_filenames(array(
					'proto_dvpt' => 'textes/bats_unit/info_bat_achat_proto_dvpt.tpl'
				));
				$template->assign_var_from_handle('PROTO_EN_COURS_DE_DEVELOPEMENT', 'proto_dvpt');
			}
		$template->set_filenames(array(
		'conso_prod_capacite_attdef' => 'textes/bats_unit/info_bat_conso.tpl'
		));
		$template->assign_var_from_handle('CONSO_PROD_CAPACITE_ATTDEF', 'conso_prod_capacite_attdef');
	}
	if($infos['type'] == 'clone') {
		if ($infos['nbr'] != 0 ) {
			$sql2 = query("SELECT 
info_unit.id AS idunit , 
info_unit.nom_unit AS nom_unit , 
info_unit.prix_clone AS prix_clone 
FROM bt_clone_user 
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
WHERE bt_clone_user.iduser = '".$_SESSION['iduser']."' AND bt_clone_user.type = 'clone' AND type_unit = '".$infos['type_unit']."' 
		");
		$type = ucwords($infos['type_unit']).'s';
			$template->assign_vars(array(
				'TYPE'	=> $type
			));
				
			$i = 0;
			while($info_unit = mysql_fetch_assoc($sql2))
			{
					$template->assign_block_vars('list_unit',array(
						'ID'	=> $info_unit['idunit'],
						'NOM'	=> $info_unit['nom_unit'],
						'PRIX'	=> $info_unit['prix_clone']
					));
				$i++;
			}
			if($i == 0)
			{
				$template->assign_vars(array(
					'ACHAT_CLONE_ELSE'	=> '<p>Aucune unité n\'est disponible, développer les dans le laboratoire de création !</p>' 
				));
			}
			$template->set_filenames(array(
				'achat_clone' => 'textes/bats_unit/info_bat_achat_clone.tpl'
			));	
				
			$template->assign_var_from_handle('ACHAT_CLONE', 'achat_clone');
		}
		$template->set_filenames(array(
			'conso_prod_capacite_attdef' => 'textes/bats_unit/info_bat_conso.tpl'
		));	
	}		
	$template->assign_var_from_handle('CONSO_PROD_CAPACITE_ATTDEF', 'conso_prod_capacite_attdef');
	$template->set_filenames(array(
	    'class' => 'textes/bats_unit/info_bat.tpl'
	));
}
elseif($class == 'unit') {
	$sql = query("SELECT 
bt_clone_user.type , 
bt_clone_user.nbr , 
info_unit.prix_clone AS prix_clone , 
info_unit.nom_unit AS nom , 
info_unit.nom_court AS nom_court , 
info_unit.comment AS comment , 
info_unit.type AS type_unit ,
info_unit.conso1_type AS conso1_type , 
info_unit.conso2_type AS conso2_type , 
info_unit.conso1_nbr AS conso1_nbr , 
info_unit.conso2_nbr AS conso2_nbr , 
info_unit.niv_attaque AS niv_attaque , 
info_unit.niv_defense AS niv_defense 
FROM bt_clone_user
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
WHERE bt_clone_user.iduser = '".$_SESSION['iduser']."' AND bt_clone_user.idunit = '".$id."'  
");
	$infos = mysql_fetch_assoc($sql);
	
	///FICHE TECHENIQUE de l'unité => consommation, attaque, defense
		$conso = ' <img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$infos['conso1_type'].'.gif" alt="'.$infos['conso1_type'].'" title="'.$infos['conso1_type'].'" /> ';
		$conso .= $infos['conso1_nbr']; 
		
		if ($infos['conso2_nbr'] != 0) {
			$conso .= '<br />';
			$conso .= ' <img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$infos['conso2_type'].'.gif" alt="'.$infos['conso2_type'].'" title="'.$infos['conso2_type'].'" /> ';
			$conso .= $infos['conso2_nbr']; 
		}
	
	$template->assign_vars(array(
		'CONSO'	=> $conso,
		'ATTAQUE' => $infos['niv_attaque'],
		'DEFENSE' => $infos['niv_defense']
	));
	
	$template->set_filenames(array(
		'conso_att_def' => 'textes/bats_unit/info_unit_conso_att_def.tpl'
	));
	$template->assign_var_from_handle('CONSO_ATT_DEF', 'conso_att_def');
	
	//INFO AUTRE//////
	$template->assign_vars(array(
		'ID'	=> $id,
		'NBR'	=> $infos['nbr'],
		'PRIX'	=> $infos['prix_clone'],
		'NAME_IMAGE' => $infos['nom_court'],
		'NOM'	=> $infos['nom'],
		'COMMENT' => $infos['comment']
	));
	if($infos['nbr'] >= 1)
	{
	$prix = $infos['prix_clone'] * 0.50 ;
		$template->assign_block_vars('vente_unit' , array(
			'NOM' => $infos['nom'], 
			'PRIX' => $prix,
			'ID' => $id, 
			'TAUX' => '50%'
		));
	}
	$template->set_filenames(array(
		'class' => 'textes/bats_unit/info_unit.tpl'
	));
	
	
		if($infos['type'] == 'clone') 
		{
		if($infos['type_unit'] == 'homme') { $id_bat = 8 ; }
		elseif($infos['type_unit'] == 'capsule') { $id_bat = 25 ; }
		elseif($infos['type_unit'] == 'cyborg') { $id_bat = 16 ; }
		elseif($infos['type_unit'] == 'module') { $id_bat = 26 ; }
			$sql3 = query("SELECT 
bt_bat_user.nbr , 
info_bat.nom 
FROM bt_bat_user 
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id 
WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.idbat = '".$id_bat."' ");
			$info_bat = mysql_fetch_assoc($sql3);
			
				if($info_bat['nbr'] == 0) 
				{
					$template->assign_vars(array(
						'ACHAT_CLONE_ELSE'	=> '<p>Vous devez posseder un(e) '.$info_bat['nom'].' pour acheter cette unité. Cliquez <a href="?page=info_batunit&class=bat&id='.$id_bat.'" >ici</a> pour en acheter une.</p>'
					));
				}else{
					$template->assign_block_vars( 'achat' , array(
						'ID'	=> $id,
						'PRIX'	=> $infos['prix_clone'],
						'NOM'	=> $infos['nom']
					));
				}
		}else{
			$template->assign_vars(array(
				'ACHAT_PROTO'	=> '<p>Vous devez d\'abord développer cette unité. Rendez vous dans <a href="?page=info_batunit&class=bat&id=12" title="Laboratoire de création" >le laboration de création</a> pour le développer.</p>'
			));
		}
}else {
	hack("Dans la partie unité/bat, la variable class n\'est pas définie !");
}
$template->assign_var_from_handle('PAGE', 'class');
?>