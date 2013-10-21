<?
	if(isset($_POST['iduser'])){
		if(!is_numeric($_POST['iduser'])){hack('Champs non numérique dans un champs hidden numerique.');}
		$s = query("SELECT COUNT(*) AS nbr FROM bt_alliance_member WHERE iduser = ".$_POST['iduser']." AND accepte = 'false'");
		$d = mysql_fetch_assoc($s);
		if($d['nbr'] != 1){
			hack('Modification d un hidden dans les candidatures, iduser ne correspondant pas');
		}
		
		query("UPDATE bt_alliance_member SET accepte = 'true' WHERE iduser = ".$_POST['iduser']);
		alert('Vous avez bien accepté ce membre.');
	}
?>