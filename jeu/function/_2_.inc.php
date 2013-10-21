<?php
	function user2id($user) {
		include('conf/config.php');
		$q = query("SELECT iduser FROM bt_users WHERE user = '".$user."'");
		$tmp = mysql_fetch_assoc($q);$
		$nbr = mysql_num_rows($q);
			if($nbr != 1)
			{
				hack(3, "Appel à la fonction \' user2id() \' : Le pseudo demandé existe pas !");
			}
		mysql_close();
		return $tmp['iduser'];
	}
	function id2user($id) {
		include('conf/config.php');
		$q = query("SELECT user FROM bt_users WHERE iduser = $id");
		$tmp = mysql_fetch_assoc($q);
		mysql_close();
		return $tmp['user'];
	}
	
	function alli2id($nom) {
			$s = query("SELECT id FROM bt_alliance_list WHERE nom = '$nom'");
			$d = mysql_fetch_assoc($s);
			return $d['id'];
	}
	function id2alli($id) {
		if($id == 0){return 'Aucune';}
		else{
			$s = query("SELECT nom FROM bt_alliance_list WHERE id = $id");
			$d = mysql_fetch_assoc($s);
			return $d['nom'];
		}
	}
	
	function id2theme($id) {
		$q = query("SELECT nom_court FROM bt_theme WHERE id = ".$id);
		$r = mysql_fetch_assoc($q);
		return $r['nom_court'];
	}
?>
