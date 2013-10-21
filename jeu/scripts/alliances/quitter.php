<?php
if($_GET['action'] == 'dissoudre'){
//On doit virer tout les membres, les alerter que l'alliance a été dissoute et qu'ils ont été expulsés.
//Garder l'alliance pendant un moment, type = dissout
	if(isset($_POST['id_alliance'])){
		if(is_numeric($_POST['id_alliance'])){
			$id = $_POST['id_alliance'] ;
			$sql_nom = query("SELECT nom FROM bt_alliance_list WHERE id = ".$id);
			$info_nom = mysql_fetch_assoc($sql_nom);
			
			$sql = query("SELECT iduser, id FROM bt_alliance_member WHERE alliance = ".$id." AND iduser != '".$_SESSION['iduser']."' ");
			while($info_member = mysql_fetch_assoc($sql)){
				query("INSERT INTO bt_alerte_historique VALUES('' , '".$info_member['iduser']."' , 'annonce' , 'alliance_dissout' , '0' , '".$info_nom['nom']."' , '".time()."' , 'non' )");
				query("UPDATE bt_users SET alliance = 0 WHERE iduser = '".$info_member['iduser']."' ");
				query("DELETE FROM bt_alliance_member WHERE id = '".$info_member['id']."' ");
			}
			query("DELETE FROM bt_alliance_member WHERE iduser = '".$_SESSION['iduser']."' ");
			query("INSERT INTO bt_alerte_historique VALUES('' , '".$_SESSION['iduser']."' , 'histo' , 'alliance_dissout_chef' , '0' , '".$info_nom['nom']."' , '".time()."' , 'non' )");
			query("UPDATE bt_users SET alliance = 0 WHERE iduser = '".$_SESSION['iduser']."' ");
			
			//on met le type de l'alliance en dissout
			query("DELETE FROM bt_alliance_list WHERE id = '".$id."' ");
			$_SESSION['alliance'] = 'Aucune';
			alert("L\'alliance a été dissoute !");
		}else{
			hack('Lettres au lieu de chiffres dans un formulaire !');
		}
	}else{
		hack('Un champ caché a été supprimé !');
	}
}elseif($_GET['action'] == 'quitter'){
	if(isset($_POST['id_alliance'])){
		$id = $_POST['id_alliance'];
		if(is_numeric($id))
		{
			$sql = query("SELECT COUNT(*) AS nbr_ally FROM bt_alliance_list WHERE id = ".$id);
			$info = mysql_fetch_assoc($sql);
			if($info['nbr_ally'] == 1)
			{
			
			}else{
				hack("l\'id n\'existe pas");
			}
		}else{
			hack("Le champ caché contient des lettres, initialement des chiffres : modification du code source !");
		}
	}
}
?>