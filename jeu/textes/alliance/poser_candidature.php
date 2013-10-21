<?
if(isset($_POST['id_alli'])){
	if($_SESSION['alliance'] == 'Aucune'){
		$s = query("SELECT COUNT(*) AS nbr FROM bt_alliance_member WHERE iduser = ".$_SESSION['iduser']);
		$d = mysql_fetch_assoc($s);
		if($d['nbr'] != 0){ hack('Essaye de rejoindre une alliance en ayant posé une candidature ailleurs.'); }

		$sql = query("SELECT id, nom FROM bt_alliance_list WHERE id = ".$_POST['id_alli']);
		$num = mysql_num_rows($sql);
		if($num == 1){
			$info = mysql_fetch_assoc($sql);
				
			query("UPDATE bt_users SET alliance=".$_POST['id_alli']." WHERE iduser=".$_SESSION['iduser']);
			query("INSERT INTO bt_alliance_member VALUES ('' , ".$_SESSION['iduser']." , ".$_POST['id_alli']." , 'false' , 'false' , 'false' , 'false' , 'false' )");
			query("UPDATE bt_alliance_list SET nbr_membre = nbr_membre + 1 WHERE id = ".$_POST['id_alli']);
			// pk pas le nombre de membre qui prend en compte les membres qui ont posé leur cnadidature...
			alert("Votre candidature a bien été déposé !");
				
		}else{
			hack('Essaye de rejoindre une alliance inexistante => modification d un POST');
		}
	}else{
		hack('Tente de rejoindre une alliance sans avoir quitter la sienne => modification du HTML');
	}
}
?>