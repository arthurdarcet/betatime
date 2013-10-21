<?
if($_SESSION['grade'] < 2)
{
redirection('msg_info.php?class=divers&id=1' , 'php');
}else{
		include('scripts/commerce.php');
//pour les lots expiré
$sql = query("SELECT bt_commerce.* , r.* 
FROM bt_commerce 
LEFT JOIN bt_ressources_utilisateurs r ON bt_commerce.vendeur = r.iduser 
WHERE statut = 'en attente' AND expire < ".time()." ");
while($info = mysql_fetch_assoc($sql))
{
		$type = $info['type'];
		$rendre = $info['nombre'] * 0.9 ; //pour 10% de perte
		$rendre = $rendre + $info_ressources[$type];
		query("UPDATE bt_ressources_utilisateurs SET $type = ".$rendre." WHERE iduser = ".$info['vendeur']." ");
		query("UPDATE bt_commerce SET statut = 'expire' WHERE id = ".$info['id']." ");
}
		
if($_SESSION['lotcommerce'] < 10) {
		$template->assign_block_vars('vendre',array(
					'NOMBRE'	=> '<input name="nbr" type="text" size="5" maxlength="7" />',
					'TYPE'	=> '<select name="type">
		            <option selected="selected">Ressources</option>
		            <option value="uranium">Uranium</option>
		            <option value="eau">Eau</option>
		            <option value="H2">Dihydrog&egrave;ne</option>
		            <option value="O2">Dioxyg&egrave;ne</option>
												</select>',
					'PRIX_UNIT' =>'<input name="prix" type="text" size="4" maxlength="4" />'
				));
}else{
		$template->assign_vars(array(
					'ELSE_VENDRE' => 'Vous ne pouvez pas mettre en vente plus de 10 lots en même temps.'
		));
}	
		
		$sql = query("SELECT 
bt_commerce.vendeur , 
bt_users.user AS nom_vendeur , 
bt_commerce.type , 
bt_commerce.nombre , 
bt_commerce.prix_unit ,  
bt_commerce.id 
FROM bt_commerce 
LEFT JOIN bt_users ON bt_commerce.vendeur = bt_users.iduser
WHERE statut = 'en attente'");
		$num = mysql_num_rows($sql) ;
		if($num == 0){
			$template->assign_vars(array(
				'NO_LOT' => '<p align="center" style="font-weight:bold;">Aucun lot en vente actuellement sur le commerce.</p>'
			));
		}else{
			while($donnees = mysql_fetch_assoc($sql)) {
			
				if($donnees['vendeur'] == $_SESSION['iduser'])
	 			{
					$button = '<input type="submit" name="Submit" value="Racheter" />';
					$cible = '?page=finance&p2=commerce&action=rachat';
				}else{
					$button = '<input type="submit" name="Submit" value="Acheter" />';
					$cible = '?page=finance&p2=commerce&action=acheter';
				}
				$prix = round($donnees['nombre'] * $donnees['prix_unit'] , 2);
				$template->assign_block_vars('commerce', array(
					'VENDEUR'	=> $donnees['nom_vendeur'],
					'ICONES_RESSOURCES' => $donnees['type'],
					'NBR' => round($donnees['nombre'] , 1),
					'PRIX_UNIT' => round($donnees['prix_unit'] , 3),
					'PRIX_TOTAL' => $prix,
					'CIBLE_ACHAT' => $cible,
					'BOUTON' => $button,
					'ID' => '<input name="id" type="hidden" value="'.$donnees['id'].'" />'
				));
			}
		}
	$template->set_filenames(array(
		'page' => 'textes/finance/commerce.tpl'
	));
}
$template->assign_var_from_handle('PAGE', 'page');
?>