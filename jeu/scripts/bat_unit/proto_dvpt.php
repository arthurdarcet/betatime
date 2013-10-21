<?
$now = time();
$sql = query("SELECT id , idunit FROM bt_proto_user WHERE fin_dvpt <= ".$now." AND avance = 'en cours' ANd iduser = '".$_SESSION['iduser']."' ");
while($info = mysql_fetch_assoc($sql)) {
	query("UPDATE bt_clone_user SET type = 'clone' WHERE idunit = '".$info['idunit']."' AND iduser = '".$_SESSION['iduser']."' ");
	query("UPDATE bt_proto_user SET avance = 'fin' WHERE idunit = '".$info['idunit']."' AND iduser = '".$_SESSION['iduser']."'  ");
	query("INSERT INTO bt_alerte_historique VALUES ('' , '".$_SESSION['iduser']."' , 'annonce' , 'dvpt_proto' , '".$info['id']."' , '' , '".time()."' , 'non') ");
}
?>