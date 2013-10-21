<?
if(isset($_POST['vente_nbr_bat']) ANd isset($_POST['id']) )
{
$nbr = $_POST['vente_nbr_bat'];
	if($nbr > 0)
	{
		if($nbr != '')
		{
			if(is_numeric($nbr) AND is_numeric($_POST['id']))
			{
				$id = $_POST['id'];
				$sql = query("SELECT 
bt_bat_user.nbr ,
info_bat.prix AS prix ,
bt_ressources.beta AS beta 
FROM bt_bat_user 
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
LEFT JOIN bt_ressources ON bt_bat_user.iduser = bt_ressources.iduser 
WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.idbat = '".$id."'  ");
				$info = mysql_fetch_assoc($sql);
					if($nbr <= $info['nbr'])
					{
						//ETAPE 1 : on supprime le nbr de batiment que l'on souhaite vendre
						$new_nbr_bat = $info['nbr'] - $nbr;
						query("UPDATE bt_bat_user SET nbr = '".$new_nbr_bat."' WHERE iduser = '".$_SESSION['iduser']."' AND idbat = '".$id."' ");
						
						if($nbr != 1 AND $id == 1)
						{
							alert('Vous ne pouvez vendre que un seul Atelier de Frappe à la fois !');
						}else{
							//ETAPE 2 : on recupere le nbr de beta a mettre sur le compte
							if($id == 1) 
							{
								$nbr2 = $info['nbr'] - 1;
								$prix = prix_atelier($nbr2);
								$rendre_pour_total = $prix * 0.70;
							}else{
								$rendre_pour_un_bat = $info['prix'] * 0.50; //50%
								$rendre_pour_total = $rendre_pour_un_bat * $nbr ;
							}
							
							//ETAPE 3 : on met des beta sur le compte...actuellement 65% du prix a l'achat
							
							$beta_actuel = $info['beta'];
							$beta_apres = $beta_actuel + $rendre_pour_total;
							
							query("UPDATE bt_ressources SET beta = '".$beta_apres."' WHERE iduser = '".$_SESSION['iduser']."' ");
							alert("La vente s\est déroulée avec succès.");
					}
					}else{
					alert("Vous ne pouvez pas vendre plus de bâtiment que ce que vous possedez.");
					}
			}else{
				hack("Utilisation de lettres au lieu de chiffres pour la vente !");
			}
		}else{
			alert("Veuillez remplir le champs.");
		}
	}else{
		alert("Le nombre spécifié doit être superieur à 0.");
	}
}
?>