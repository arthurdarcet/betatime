<?

$sql = query("SELECT time , type , id_type , phrase , id  FROM bt_alerte_historique WHERE iduser= '".$_SESSION['iduser']."' AND class = 'annonce' AND vu = 'non'");
$info = mysql_fetch_assoc($sql);

	$date_j = date_j($info['time']);
		if($date_j != '')
		{
			$date = $date_j.' à '.date('H\hi', $info['time']);
		}else{
			$date = 'Le '.date('d', $info['time']).' '.substr(date('F', $info['time']),0,3).' '.date('y', $info['time']).' à '.date('H\hi', $info['time']);
		}
		
        if($info['type'] == 'rapport')
        {
            $template->assign_vars(array(
						'DATE' => $date,
                        'RAPPORT' => $info['phrase']
                ));
				
			$template->set_filenames(array(
                'type' => 'textes/annonce/rapport_attaque.tpl'
            ));
        }elseif($info['type'] == 'passage en grade')
		{
			$new_grade = affich_text($info['phrase']);
			//Chercher le nom du grade
			$sql2 = query("SELECT `nom` FROM info_grade WHERE grade = '".$new_grade."' ");
			$info_nom = mysql_fetch_assoc($sql2);
			
            $template->assign_vars(array(
						'DATE' => $date,
                        'NEW_GRADE_NBR' => $new_grade,
						'NEW_GRADE_NOM' => $info_nom['nom']
                ));
			//Liste des news batiments
			$sql3 = query("SELECT `id`, `nom` FROM info_bat WHERE level_min = '".$new_grade."' ");
				while($info_bat = mysql_fetch_assoc($sql3))
				{
					 $template->assign_block_vars('new_bat',array(
						'ID' => $info_bat['id'],
                        'NOM' => $info_bat['nom']
					));
				}
			$sql4 = query("SELECT `id`, `nom_unit` FROM info_unit WHERE level_min = '".$new_grade."' ");
				while($info_unit = mysql_fetch_assoc($sql4))
				{
					 $template->assign_block_vars('new_unit',array(
						'ID' => $info_unit['id'],
                        'NOM' => $info_unit['nom_unit']
					));
				}
			$grade2 = $new_grade + 1;
			$sql5 = query("SELECT `phrase` FROM bt_grade WHERE grade = '".$grade2."' ");
				while($info_obj = mysql_fetch_assoc($sql5))
				{
					 $template->assign_block_vars('new_obj',array(
						'NOM' => $info_obj['phrase']
					));
				}
			$template->set_filenames(array(
                'type' => 'textes/annonce/grade.tpl'
            ));
		}elseif($info['type'] == 'dons_recu')
		{
		//Besoins de celui qui a envoyé le dons, la somme du dons, le type de ressources
		$id_dons = $info['id_type'];
		$sql2 = query("SELECT 
bt_dons.nombre , 
bt_dons.type_ress , 
bt_dons.time ,
bt_users.user AS donneur
FROM bt_dons
LEFT JOIN bt_users ON bt_dons.id_donneur = bt_users.iduser
WHERE bt_dons.id = '".$id_dons."' 
		");
		$info_dons = mysql_fetch_assoc($sql2);
		
		$template->assign_block_vars('dons',array(
						'NOMBRE' => $info_dons['nombre'],
						'TYPE_RESS' => $info_dons['type_ress'],
						'DONNEUR' => $info_dons['donneur'],
						'DATE' => $date
					));
					
		$template->set_filenames(array(
                'type' => 'textes/annonce/dons_recu.tpl'
            ));
		}elseif($info['type'] == 'dvpt_proto')
		{
			$sql2 = query("SELECT 
bt_proto_user.idunit , 
info_unit.nom_unit AS nom , 
info_unit.prix_clone AS prix 
FROM bt_proto_user
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id
WHERE bt_proto_user.id = '".$info['id_type']."' AND bt_proto_user.iduser = '".$_SESSION['iduser']."' 
");
			$info_proto = mysql_fetch_assoc($sql2);
				
			$template->assign_vars(array(
				'IDUNIT' => $info_proto['idunit'],
				'NOM' => $info_proto['nom'],
				'PRIX' => $info_proto['prix'],
				'DATE' => $date
			));
			
			
			$template->set_filenames(array(
                'type' => 'textes/annonce/dvpt_proto.tpl'
            ));
		}elseif($info['type'] == 'commerce-lot vendu')
		{
			$sql = query("SELECT 
bt_commerce.achat, 
bt_users.user AS user , 
bt_commerce.type , 
bt_commerce.nombre , 
bt_commerce.prix_unit 
FROM bt_commerce 
LEFT JOIN bt_users ON bt_commerce.acheteur = bt_users.iduser 
WHERE bt_commerce.id = ".$info['id_type']." ");
			$donnees = mysql_fetch_assoc($sql);
			$template->assign_vars(array(
				'DATE' => data($donnees['achat']),
				'PSEUDO' => ucwords($donnees['user']),
				'TYPE' => $donnees['type'],
				'PRIX' => ($donnees['nombre'] * $donnees['prix_unit']),
				'NOMBRE' => $donnees['nombre']
			));
			$template->set_filenames(array(
	            'type' => 'textes/annonce/commerce-lot_vendu.tpl'
	        ));
		}
		elseif($info['type'] == 'alliance_dissoute')
		{
			$template->assign_vars(array(
				'DATE' => $date
			));
			
			
			$template->set_filenames(array(
                'type' => 'textes/annonce/alliance_dissoute.tpl'
            ));
		}elseif($info['type'] == 'alliance_chef_remplace')
		{
			$template->assign_vars(array(
				'DATE' => $date,
				'NEW_CHEF' => $info['phrase']
			));
			
			
			$template->set_filenames(array(
                'type' => 'textes/annonce/alliance_chef_remplace.tpl'
            ));
		}else{
			echo 'Alerte historique pas encore réalisé en Templates, présciser le sur le forum. Merci';
		}
	
	query("UPDATE bt_alerte_historique SET vu = 'oui' WHERE id = '".$info['id']."' ");
$template->assign_var_from_handle('TYPE', 'type');
$template->set_filenames(array(
    'page' => 'textes/annonce.tpl'
 ));

$template->assign_var_from_handle('PAGE', 'page');
?>
