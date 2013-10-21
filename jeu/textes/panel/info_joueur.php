<?php
if(isset($_GET['id']) ANd is_numeric($_GET['id']))
{
	//Différentes infos a montré : 
	//dons, commerce , attaques , ip sous lesquelles il s'est connecté
	//Alertes de hack
	
	$sql = query("SELECT COUNT(*) AS nbr , user FROM bt_users WHERE iduser = '".$_GET['id']."' GROUP BY user");
	$info = mysql_fetch_assoc($sql);
	
	if($info['nbr'] == 1)
	{
		$template->assign_vars(array(
			'PSEUDO' => $info['user']
		));
		//////////////// D'abord les DONS EFFECTUER
		$sql2 = query("SELECT 
bt_dons.nombre , 
bt_dons.type_ress , 
bt_dons.time , 
bt_users.user AS receveur , 
bt_dons.id_receveur 
FROM bt_dons
LEFT JOIN bt_users ON bt_dons.id_receveur = bt_users.iduser
WHERE bt_dons.id_donneur = '".$_GET['id']."' ");
		while($dons_eff = mysql_fetch_assoc($sql2))
		{
			$template->assign_block_vars('dons_eff',array(
				'DATE' => data($dons_eff['time']) , 
				'RECEVEUR' => ucwords($dons_eff['receveur']) , 
				'ID_RECEVEUR' => $dons_eff['id_receveur'],
				'TYPE' => $dons_eff['type_ress'] , 
				'NBR' => $dons_eff['nombre']
			));
		}
		/////////////////Pour les dons recus
		$sql3 = query("SELECT 
bt_dons.nombre , 
bt_dons.type_ress , 
bt_dons.time , 
bt_users.user AS donneur , 
bt_dons.id_donneur 
FROM bt_dons
LEFT JOIN bt_users ON bt_dons.id_donneur = bt_users.iduser
WHERE bt_dons.id_receveur = '".$_GET['id']."' ");
		while($dons_recu = mysql_fetch_assoc($sql3))
		{
			$template->assign_block_vars('dons_recu',array(
				'DATE' => data($dons_recu['time']) , 
				'DONNEUR' => ucwords($dons_recu['donneur']) , 
				'ID_DONNEUR' => $dons_recu['id_donneur'],
				'TYPE' => $dons_recu['type_ress'] , 
				'NBR' => $dons_recu['nombre']
			));
		}
		
		$template->set_filenames(array(
			'page' => 'textes/panel/info_joueur.tpl'
		));
		
		/////////////////Les attaques effectuées /////////////////
		$sql4 = query("SELECT 
bt_attaques_effectuees.id , 
bt_attaques_effectuees.timestamp , 
bt_attaques_effectuees.id_defenseur , 
bt_users.user AS defenseur , 
bt_attaques_effectuees.id_gagnant , 
t2.user AS gagnant 
FROM bt_attaques_effectuees 
LEFT JOIN bt_users ON bt_attaques_effectuees.id_defenseur = bt_users.iduser 
LEFT JOIN bt_users t2 ON bt_attaques_effectuees.id_gagnant = t2.iduser 
WHERE bt_attaques_effectuees.id_attaquant = '".$_GET['id']."' ");
		while($info_att_eff = mysql_fetch_assoc($sql4))
		{
			$template->assign_block_vars('attaque_eff',array(
				'ID' => $info_att_eff['id'] ,
				'DATE' => data($info_att_eff['timestamp']) , 
				'DEFENSEUR' => ucwords($info_att_eff['defenseur']) , 
				'ID_DEFENSEUR' => $info_att_eff['id_defenseur'],
				'GAGNANT' => ucwords($info_att_eff['gagnant']) , 
				'ID_GAGNANT' => $info_att_eff['id_gagnant']
			));	
		}
		
		$sql5 = query("SELECT 
bt_attaques_effectuees.id , 
bt_attaques_effectuees.timestamp , 
bt_attaques_effectuees.id_attaquant, 
bt_users.user AS attaquant , 
bt_attaques_effectuees.id_gagnant , 
t2.user AS gagnant 
FROM bt_attaques_effectuees 
LEFT JOIN bt_users ON bt_attaques_effectuees.id_attaquant = bt_users.iduser 
LEFT JOIN bt_users t2 ON bt_attaques_effectuees.id_gagnant = t2.iduser 
WHERE bt_attaques_effectuees.id_defenseur = '".$_GET['id']."' ");
		while($info_att_recu = mysql_fetch_assoc($sql5))
		{
			$template->assign_block_vars('attaque_recu',array(
				'ID' => $info_att_recu['id'] ,
				'DATE' => data($info_att_recu['timestamp']) , 
				'ATTAQUANT' => ucwords($info_att_recu['attaquant']) , 
				'ID_ATTAQUANT' => $info_att_recu['id_attaquant'],
				'GAGNANT' => ucwords($info_att_recu['gagnant']) , 
				'ID_GAGNANT' => $info_att_recu['id_gagnant']
			));	
		}
		////////////////////////Le commerce/////////////////////////////////
		//les lots vendus , les lots achetes 
		$sql6 = query("SELECT 
bt_commerce.id , 
bt_commerce.acheteur AS id_acheteur , 
bt_users.user AS acheteur , 
bt_commerce.type , 
bt_commerce.nombre , 
bt_commerce.prix_unit , 
bt_commerce.ajout , 
bt_commerce.achat 
FROM bt_commerce 
LEFT JOIN bt_users ON bt_commerce.acheteur = bt_users.iduser
WHERE bt_commerce.vendeur = '".$_GET['id']."' AND statut = 'vendu' ");
		while($info_commerce_vendu = mysql_fetch_assoc($sql6))
		{
		$prix = $info_commerce_vendu['prix_unit'] * $info_commerce_vendu['nombre'];
			$template->assign_block_vars('commerce_vendu',array(
				'ID' => $info_commerce_vendu['id'] ,
				'ACHETEUR' => ucwords($info_commerce_vendu['acheteur']) , 
				'ID_ACHETEUR' => $info_commerce_vendu['id_acheteur'],
				'TYPE' => $info_commerce_vendu['type'] , 
				'NBR' => ceil($info_commerce_vendu['nombre']) , 
				'PRIX' => ceil($prix) ,
				'PRIX_UNIT' => ceil($info_commerce_vendu['prix_unit']) , 
				'AJOUT' => data($info_commerce_vendu['ajout']) ,
				'ACHAT' => data($info_commerce_vendu['achat']) 
			));	
		}
		$sql7 = query("SELECT 
bt_commerce.id , 
bt_commerce.vendeur AS id_vendeur , 
bt_users.user AS vendeur , 
bt_commerce.type , 
bt_commerce.nombre , 
bt_commerce.prix_unit , 
bt_commerce.ajout , 
bt_commerce.achat 
FROM bt_commerce 
LEFT JOIN bt_users ON bt_commerce.vendeur = bt_users.iduser
WHERE bt_commerce.acheteur = '".$_GET['id']."' AND statut = 'vendu' ");
		while($info_commerce_vendu = mysql_fetch_assoc($sql6))
		{
		$prix = $info_commerce_vendu['prix_unit'] * $info_commerce_vendu['nombre'];
			$template->assign_block_vars('commerce_achete',array(
				'ID' => $info_commerce_vendu['id'] ,
				'VENDEUR' => ucwords($info_commerce_vendu['vendeur']) , 
				'ID_VENDEUR' => $info_commerce_vendu['id_vendeur'],
				'TYPE' => $info_commerce_vendu['type'] , 
				'NBR' => ceil($info_commerce_vendu['nombre']) , 
				'PRIX' => ceil($prix) ,
				'PRIX_UNIT' => ceil($info_commerce_vendu['prix_unit']) , 
				'AJOUT' => data($info_commerce_vendu['ajout']) ,
				'ACHAT' => data($info_commerce_vendu['achat']) 
			));	
		}
	////Les hacks 
	//seulement le nombre de d'alerte hack qu'il y a eu pour ce joueur
	$sql7 = query("SELECT user FROM bt_hack WHERE user = '".$_GET['id']."' ");
	$nbr = mysql_num_rows($sql7);
	
	$template->assign_vars(array(
		'HACK' => $nbr
	));
	
	}else{
		alert('Aucun pseudo ne correspond à cette ID !');
		$template->set_filenames(array(
			'page' => 'textes/panel/recherche_joueur_form.tpl'
		));
	}
}else{
	$template->set_filenames(array(
		'page' => 'textes/panel/recherche_joueur_form.tpl'
	));
}
$template->assign_var_from_handle('PAGE', 'page');
?>