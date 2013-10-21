<?php
//pour ajouter une alerte
//By Rafale
// Modif 30/11/06 -> utilisation des id a la place des user
	function ajouter_alerte($id , $class, $type, $id_type ,$text ){
		include('conf/config.php');
		//$id = user2id($user);
		$phrase = mysql_real_escape_string($text);
		query("INSERT INTO bt_alerte_historique VALUES('', '$id', '$class' , '$type', '$id_type','$phrase', '".time()."', 'non' )");
		return true;
	}

?>
