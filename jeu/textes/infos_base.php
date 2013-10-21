<?php
	$sql1 = query("SELECT 
	bt_bat_user.idbat ,
	bt_bat_user.nbr,
	info_bat.nom AS nom, 
	info_bat.prod1_type AS prod1_type ,
	info_bat.prod1_nbr AS prod1_nbr ,
	info_bat.prod2_type AS prod2_type ,
	info_bat.prod2_nbr AS prod2_nbr ,
	info_bat.conso1_type AS conso1_type ,
	info_bat.conso1_nbr AS conso1_nbr ,
	info_bat.conso2_type AS conso2_type ,
	info_bat.conso2_nbr AS conso2_nbr
	FROM bt_bat_user 
	LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
	WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.class = 3 AND bt_bat_user.nbr != '0' ");
	while ($donnees = mysql_fetch_assoc($sql1)) {

			$prod = '<img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees['prod1_type'].'.gif" alt="'.$donnees['prod1_type'].'" /> ';
			$prod .= $donnees['prod1_nbr'] * $donnees['nbr'];
			
			if ( $donnees['prod2_type'] != '') {
				$prod .= '<br /><img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees['prod2_type'].'.gif" alt="'.$donnees['prod2_type'].'" /> ';
				$prod .= $donnees['prod2_nbr'] * $donnees['nbr'];
			};
			
			$conso = '<img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees['conso1_type'].'.gif" alt="'.$donnees['conso1_type'].'" /> ';
			$conso .= $donnees['conso1_nbr'] * $donnees['nbr'];
			if ( $donnees['conso2_type'] != '') {
				$conso .= '<br /><img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees['conso2_type'].'.gif" alt="'.$donnees['conso2_type'].'" /> ';
				$conso .= $donnees['conso2_nbr'] * $donnees['nbr'];
			};
			
			$template->assign_block_vars('bats_prod', array(
					'ID' => $donnees['idbat'],
					'NBR' => $donnees['nbr'],
					'NOM' => $donnees['nom'],
					'PROD' => $prod,
					'CONSO' => $conso
			));
	}

	$sql4 = query("SELECT
	bt_bat_user.idbat , 
	bt_bat_user.nbr , 
	info_bat.nom AS nom ,  
	info_bat.attaque AS attaque ,
	info_bat.defense AS defense ,
	info_bat.conso1_type AS conso1_type ,
	info_bat.conso1_nbr AS conso1_nbr ,
	info_bat.conso2_type AS conso2_type ,
	info_bat.conso2_nbr AS conso2_nbr
	FROM bt_bat_user 
	LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
	WHERE bt_bat_user.class = 2 AND bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.nbr != 0 
	");
	while ($donnees4 = mysql_fetch_array($sql4)){
			
			$att_def = $donnees4['attaque'].' / '.ceil($donnees4['defense']);
			
			$conso4 = '<img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees4['conso1_type'].'.gif" alt="'.$donnees4['conso1_type'].'" /> ';
			$conso4 .= $donnees4['conso1_nbr'] * $donnees4['nbr'];
			if ( $donnees4['conso2_type'] != '') {
				$conso4 .= '<br /><img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees4['conso2_type'].'.gif" alt="'.$donnees4['conso2_type'].'" /> ';
				$conso4 .= $donnees4['conso2_nbr'] * $donnees4['nbr'];
			};
			
			$template->assign_block_vars('bats_militaires', array(
					'ID' => $donnees4['idbat'],
					'NBR' => $donnees4['nbr'],
					'NOM' => $donnees4['nom'],
					'ATT_DEF' => $att_def,
					'CONSO' => $conso4
			));
	}

	
	
	
if($_SESSION['grade'] >= 2)
{
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////						Partie II									/////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql2 = query("SELECT 
	bt_bat_user.idbat ,
	bt_bat_user.nbr,
	info_bat.nom AS nom, 
	info_bat.type_unit AS type_unit ,
	info_bat.capacite AS capacite, 
	info_bat.conso1_type AS conso1_type ,
	info_bat.conso1_nbr AS conso1_nbr ,
	info_bat.conso2_type AS conso2_type ,
	info_bat.conso2_nbr AS conso2_nbr 
	FROM bt_bat_user 
	LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
	WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.class = 4 AND bt_bat_user.nbr != 0 
	");
	// SUM() ET GROUP BY sont la pour donner la capacité occupe. SUM compte sur toutes les lignes(a verifier)
	while ($donnees2 = mysql_fetch_array($sql2)) {

		//////calcul le nbr de clones//////
			//occupe/////////////
			$sql_occ = query("SELECT 
	info_unit.type AS type , 
	bt_clone_user.nbr 
	FROM bt_clone_user 
	LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id 
	WHERE bt_clone_user.iduser = '".$_SESSION['iduser']."' AND bt_clone_user.type = 0 
	");
			$occupe = 0;
			while($donnees_unit = mysql_fetch_assoc($sql_occ))
			{
				if($donnees_unit['type'] == $donnees2['type_unit'])
				{
					$occupe += $donnees_unit['nbr'];
				}
			}
			
			$capacite_max = $donnees2['capacite'] * $donnees2['nbr'];
			$capacite = $occupe.' / '.$capacite_max;
			$conso2 = '<img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees2['conso1_type'].'.gif" alt="'.$donnees2['conso1_type'].'" /> ';
			$conso2 .= $donnees2['conso1_nbr'] * $donnees2['nbr'];
			if ( $donnees2['conso2_type'] != '') {
				$conso2 .= '<br /><img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees2['conso2_type'].'.gif" alt="'.$donnees2['conso2_type'].'" /> ';
				$conso2 .= $donnees2['conso2_nbr'] * $donnees2['nbr'];
			};
			$type = ucwords($donnees2['type_unit']);
			$template->assign_block_vars('bats_stockage', array(
					'ID' => $donnees2['idbat'],
					'NBR' => $donnees2['nbr'],
					'NOM' => $donnees2['nom'],
					'TYPE' => $type ,
					'CAPACITE' => $capacite,
					'CONSO' => $conso2
			));
	}

	$sql3 = query("SELECT 
	bt_bat_user.idbat , 
	bt_bat_user.nbr , 
	info_bat.nom AS nom , 
	info_bat.type_unit AS type , 
	info_bat.conso1_type AS conso1_type ,
	info_bat.conso1_nbr AS conso1_nbr ,
	info_bat.conso2_type AS conso2_type ,
	info_bat.conso2_nbr AS conso2_nbr , 
	info_bat.type_unit 
	FROM bt_bat_user 
	LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
	WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.nbr != 0 AND (bt_bat_user.class = 0 OR bt_bat_user.class = 1)
	");
	while ($donnees3 = mysql_fetch_assoc($sql3)){
			
			$conso3 = '<img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees3['conso1_type'].'.gif" alt="'.$donnees3['conso1_type'].'" /> ';
			$conso3 .= $donnees3['conso1_nbr'] * $donnees3['nbr'];
			if ( $donnees3['conso2_type'] != '') {
				$conso3 .= '<br /><img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees3['conso2_type'].'.gif" alt="'.$donnees3['conso2_type'].'" /> ';
				$conso3 .= $donnees3['conso2_nbr'] * $donnees3['nbr'];
			}
			$type = ucwords($donnees3['type_unit']).'s';
			$template->assign_block_vars('produc_units', array(
					'ID' => $donnees3['idbat'] ,
					'NBR' => $donnees3['nbr'] ,
					'NOM' => $donnees3['nom'] ,
					'PRODUC' =>  $type,
					'CONSO' => $conso3
			));
	}

	$sql5 = query("SELECT 
	bt_clone_user.idunit , 
	bt_clone_user.nbr , 
	info_unit.nom_unit AS nom ,  
	info_unit.niv_attaque AS attaque ,
	info_unit.niv_defense AS defense ,
	info_unit.conso1_type AS conso1_type ,
	info_unit.conso1_nbr AS conso1_nbr ,
	info_unit.conso2_type AS conso2_type ,
	info_unit.conso2_nbr AS conso2_nbr , 
	info_unit.type AS type 
	FROM bt_clone_user 
	LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
	WHERE bt_clone_user.iduser = '".$_SESSION['iduser']."' AND bt_clone_user.nbr != '0' AND bt_clone_user.type = 'clone' ");
	while ($donnees5 = mysql_fetch_array($sql5)){

	$att_def = $donnees5['attaque'].' / '.$donnees5['defense'];

		$conso5 = '<img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees5['conso1_type'].'.gif" alt="'.$donnees5['conso1_type'].'" /> ';
		$conso5 .= $donnees5['conso1_nbr'] * $donnees5['nbr'];
		if ( $donnees5['conso2_type'] != '') {
			$conso5 .= '<br /><img src="templates/'.$_SESSION['theme'].'/images/ressources/'.$donnees5['conso2_type'].'.gif" alt="'.$donnees5['conso2_type'].'" /> ';
			$conso5 .= $donnees5['conso2_nbr'] * $donnees5['nbr'];
		};
		
		$template->assign_block_vars('units', array(
				'ID' => $donnees5['idunit'],
				'NBR' => $donnees5['nbr'],
				'NOM' => $donnees5['nom'],
				'ATT_DEF' => $att_def,
				'CONSO' => $conso5, 
				'TYPE' => ucwords($donnees5['type'])
		));
	}
}
	
	if($_SESSION['grade'] == 1)
	{
		$template->set_filenames(array(
			'infos_base' => 'textes/infos_base_g1.tpl'
		));
	}else{
		$template->set_filenames(array(
			'infos_base' => 'textes/infos_base_ttg.tpl'
		));
	}

	$template->assign_var_from_handle('PAGE', 'infos_base');
?>