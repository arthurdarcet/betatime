<?
if(isset($_POST['id_achat_proto_dvpt']))
{
	$id = $_POST['id_achat_proto_dvpt'];
	$sql1 = query("SELECT 
bt_ressources.beta AS beta , 
bt_proto_user.prix_aleatoire_proto , 
info_unit.duree_proto AS duree_proto
FROM bt_proto_user 
LEFT JOIN bt_ressources ON bt_proto_user.iduser = bt_ressources.iduser 
LEFT JOIN info_unit ON bt_proto_user.idunit = info_unit.id 
WHERE bt_proto_user.iduser = '".$_SESSION['iduser']."' AND bt_proto_user.idunit = '".$id."' ");
	$info = mysql_fetch_assoc($sql1);
	
	//ETAPE 1 : on verifie si il y a assez de beta.

	$beta_actuel = $info['beta'];
	$prix = $info['prix_aleatoire_proto'];
	$beta_apres = $beta_actuel - $prix ;
		if($beta_apres >= 0)
		{
		//ETAPE 2 : on caclule le tps qd sera pret le proto et on modifie dans la bdd.
		
		$now = time();
		$fin_dvpt = $now + $info['duree_proto'];
		
		query("UPDATE bt_proto_user SET fin_dvpt = '".$fin_dvpt."' , debut_dvpt = '".time()."' ,  avance = 'en cours' WHERE iduser = '".$_SESSION['iduser']."' AND idunit = '".$id."' ") ;
		
		//on modifie les beta dans la bdd
		query("UPDATE bt_ressources SET beta = '".$beta_apres."' WHERE iduser = '".$_SESSION['iduser']."' ");
		
		alert("Vous venez de mettre un prototype en developpement. Il sera près bientôt.");
		}else{
			alert("Vous n\'avez pas assez de beta !");
		}
}
?>