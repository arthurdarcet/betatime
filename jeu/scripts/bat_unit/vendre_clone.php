<?
if(isset($_POST['nbr_unit_vendre']) ANd isset($_POST['id_unit']) )
{
$nbr = $_POST['nbr_unit_vendre'];
	if($nbr > 0)
	{
		if($nbr != '')
		{
			if(is_numeric($nbr) AND is_numeric($_POST['id_unit']))
			{
				$id = $_POST['id_unit'];
				$sql = query("SELECT 
bt_clone_user.nbr ,
info_unit.prix_clone AS prix ,
bt_ressources.beta AS beta 
FROM bt_clone_user 
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
LEFT JOIN bt_ressources ON bt_clone_user.iduser = bt_ressources.iduser 
WHERE bt_clone_user.iduser = '".$_SESSION['iduser']."' AND bt_clone_user.idunit = '".$id."'  ");
				$info = mysql_fetch_assoc($sql);
					if($nbr <= $info['nbr'])
					{
						//ETAPE 1 : on supprime le nbr de batiment que l'on souhaite vendre
						$new_nbr_bat = $info['nbr'] - $nbr;
						query("UPDATE bt_clone_user SET nbr = '".$new_nbr_bat."' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$id."' ");
						
								$rendre_pour_un_bat = $info['prix'] * 0.50; //50%
								$rendre_pour_total = $rendre_pour_un_bat * $nbr ;
							
							//ETAPE 3 : on met des beta sur le compte...actuellement 65% du prix a l'achat
							
							$beta_actuel = $info['beta'];
							$beta_apres = $beta_actuel + $rendre_pour_total;
							
							query("UPDATE bt_ressources SET beta = '".$beta_apres."' WHERE iduser = '".$_SESSION['iduser']."' ");
							alert("La vente s\est déroulée avec succès.");
					}else{
					alert("Vous ne pouvez pas vendre plus d\'unité que ce que vous possedez.");
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