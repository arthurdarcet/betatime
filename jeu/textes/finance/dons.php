<?php
$nombre_dons_beta_max = 75000;
//script
//Securité : on verifie que c'est des nombres ou bien des chiffres
//I ) On verifie qu'il n'a pas fait ses dons
//II ) On déduit la ressources
//III ) On verse le dons au receveur
// IV ) On fait une entré dans la table de dons
// V ) On met dans l'historique des 2 personnes 
if(isset($_POST['nbr_dons_bt']) AND isset($_POST['destinataire_dons_bt']) )
{
	$desti = mysql_real_escape_string($_POST['destinataire_dons_bt']);
	$nbr = intval($_POST['nbr_dons_bt']);
	// I) Verification du nombre de dons//////
		$sql = query("SELECT `nombre` FROM bt_dons WHERE id_donneur = '".$_SESSION['iduser']."' AND date = '".date('d/m/Y')."'");
		$nbr_beta = 0;
		while($info = mysql_fetch_assoc($sql))
		{
			$nbr_beta += $info['nombre'] ;
		}
		$dons_restant = $nombre_dons_beta_max - $nbr_beta;
	if($nbr <= $dons_restant)
	{
		//II) On déduit les ressources/////////
		//les ressources du joueur avant
		$sql2 = query("SELECT beta FROM bt_ressources_utilisateurs WHERE iduser = '".$_SESSION['iduser']."' ");
		$info_ress = mysql_fetch_assoc($sql2);
		
		$new_beta = $info_ress['beta'] - $nbr;
			if($new_beta >= 0)
			{
				// III ) on verse le don au desti
				//recupere ce qu'avais avant le desti
				//1ere jointure de guigui hihi /////
				$sql3 = query("SELECT bt_users.iduser , bt_ressources_utilisateurs.beta AS beta , COUNT(*) AS num_verif FROM bt_users LEFT JOIN bt_ressources_utilisateurs ON bt_users.iduser = bt_ressources_utilisateurs.iduser WHERE bt_users.user = '".$desti."' GROUP BY iduser");
				$info_ress_desti = mysql_fetch_assoc($sql3);
				//si le pseudo existe pas les variables valent 0 ou sont nulles
				if($info_ress_desti['num_verif'] != 0 )
				{
					$new_beta_desti = $info_ress_desti['beta'] + $nbr ;
					
					query("UPDATE bt_ressources_utilisateurs SET beta = '".$new_beta."' WHERE iduser = '".$_SESSION['iduser']."' ");
					query("UPDATE bt_ressources_utilisateurs SET beta = '".$new_beta_desti."' WHERE iduser = '".$info_ress_desti['iduser']."'  ");
					query("INSERT INTO bt_dons VALUES('' , '".date('d/m/Y')."' , '".time()."' , '".$_SESSION['iduser']."' , '".$info_ress_desti['iduser']."' , '".$nbr."' , 'beta' )");
					$dernier_id = mysql_insert_id();
					
					query("INSERT INTO bt_alerte_historique VALUES
( '' , '".$_SESSION['iduser']."' , 'histo' , 'dons_effectue' , '".$dernier_id."' , '' , '".time()."' , 'oui' ) , 
( '' , '".$info_ress_desti['iduser']."' , 'annonce' , 'dons_recu' , '".$dernier_id."' , '' , '".time()."' , 'non' )
					");
				alert("Le don a été envoyé !");
				}else{
					alert("Le joueur n\'existe pas !");
				}
			}else{
				alert('Vous ne possedez pas assez de Beta !');
			}
	}else{
		alert('Vous avez déjà effectué tous vos dons aujourd\'hui !');
	}
}

//texte informatif
$template->assign_vars(array(
				'TEXTE_ACCEUIL' => 'Les dons s\'effectuent seulement en beta pour le moment, veuillez patientez pendant que ce temps là, les administrateurs proposent des regles.',
				'NBR_BETA'	=> $nombre_dons_beta_max
		)); 

//on verifie qu'il as pas effecuter un dons aujourdui
$sql = query("SELECT `nombre`, `id_receveur`, `time` FROM bt_dons WHERE id_donneur = '".$_SESSION['iduser']."' AND date = '".date('d/m/Y')."' ORDER BY `time` ");
$nbr_beta = 0;
while($info = mysql_fetch_assoc($sql))
{
	$nbr_beta += $info['nombre'] ;
	$heure = date('H', $info['time']).'h'.date('i', $info['time']).'min'.date('s' , $info['time']).'s';
		$template->assign_block_vars('liste',array(
				'RECEVEUR'	=> id2user($info['id_receveur']),
				'MONTANT' => $info['nombre'],
				'HEURE' => $heure
		)); 
}
if($nbr_beta < 75000)
{
	$template->assign_block_vars('form',array(
				'CIBLE'	=> '#'
		)); 
}else{
	$template->assign_vars(array(
				'TEXT'	=> 'Vous avez effectuer un total de dons de 75000. Vous devez attendre demain pour pouvoir effectuer un don.'
		)); 
} 

	$template->set_filenames(array(
		'page' => 'textes/finance/donnation_ressources.tpl'
	));

$template->assign_var_from_handle('PAGE', 'page');

?>