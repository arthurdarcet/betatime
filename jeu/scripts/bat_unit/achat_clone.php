<?php
if(isset($_POST['nbr_unit']) AND isset($_POST['id_unit'])) {
	if(is_numeric($_POST['nbr_unit']) OR is_numeric($_POST['id_unit']) ) {
	$nbr = $_POST['nbr_unit'];
	$id = $_POST['id_unit'];
		if($nbr >= 0 ) {
			$sql = query("SELECT 
info_unit.prix_clone AS prix_clone , 
info_unit.level_min AS level_min , 
bt_ressources.beta AS beta , 
bt_clone_user.nbr , 
bt_clone_user.type , 
info_unit.type AS type_unit 
FROM bt_clone_user
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
LEFT JOIN bt_ressources ON bt_clone_user.iduser = bt_ressources.iduser
WHERE bt_clone_user.idunit = '".$id."' AND bt_clone_user.iduser = '".$_SESSION['iduser']."' ");
			$nbr2 = mysql_num_rows($sql);
			if($nbr2 == 1)
			{
				$info = mysql_fetch_assoc($sql);
					if($info['level_min'] <= $_SESSION['grade']) 
					{
					//compte la place dans le bat de stockage
					if($info['type_unit'] == 'homme' )
					{ 
						$id_bat_stockage = 7 ; 
						$sql_type = 'type_unit = \'homme\' ';
					}else{ 
						$id_bat_stockage = 27 ; 
						$sql_type = '(type = \'module\' OR type = \'cyborg\' OR type = \'capsule\')';
					}
					// I) Place total
					$sql2 = query("SELECT 
bt_bat_user.nbr , 
info_bat.capacite AS capacite 
FROM bt_bat_user
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.idbat = '".$id_bat_stockage."' ");
					$info_bat_stockage = mysql_fetch_assoc($sql2);
					$cap_total = $info_bat_stockage['nbr'] * $info_bat_stockage['capacite'];
					// II )Nombre d'unité 
					$sql3 = query("SELECT nbr FROM bt_clone_user WHERE type = 'clone' AND ".$sql_type." AND iduser = '".$_SESSION['iduser']."' ");
					$clone = 0;
					while($info_clone = mysql_fetch_assoc($sql3))
					{
						$clone += $info_clone['nbr'];
					}
					$clone_new = $clone + $nbr ;
						if($clone_new <= $cap_total)
						{
						$prix = $info['prix_clone'] * $nbr;
						$new_beta = $info['beta'] - $prix;
							if($new_beta >= 0) {
								if($info['type'] == 'clone' )
								{
									query("UPDATE bt_ressources SET beta = '".$new_beta."' WHERE iduser = '".$_SESSION['iduser']."' ");
									
									$new_nbr = $info['nbr'] + $nbr;
									query("UPDATE bt_clone_user SET nbr = '".$new_nbr."' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$id."'");
									alert("Votre achat s\'est effectué avec succès !");
								}else{
									alert('L\'unité doit être un clone pour le développer !');
								}
							}else{
								alert("Vous ne possedez pas assez de beta pour acheter cette unité !");	
							}
						}else{
							alert("Vous devez construire des bâtiments de stockage !");
						}
					}else{
						alert("Votre grade n\'est pas assez élevé pour acheter cette unité !");
					}
			}else{
				hack("Souhaite acheter un clone mais l\ID de l\'unité n\'existe pas !");
			}
		}else{
			alert("Vous avez entré de fausses informations !");
		}
	}else{
	hack("Chiffres dans un formulaire caché ou de texte.");
	}
}
?>