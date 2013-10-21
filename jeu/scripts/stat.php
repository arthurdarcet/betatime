<?php

$user = $_SESSION['iduser'];
$terrain = 0;
//Je met a jour le terrain pour les bats
$sql2 = query("SELECT 
bt_bat_user.nbr , 
info_bat.terrain AS terrain 
FROM bt_bat_user 
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
WHERE bt_bat_user.iduser = '".$user."' ");
while($donnees = mysql_fetch_assoc($sql2))
{
	$terrain += $donnees['terrain'] * $donnees['nbr'];
}
//Pour unit
$sql2 = query("SELECT 
bt_clone_user.nbr , 
info_unit.terrain AS terrain 
FROM bt_clone_user 
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
WHERE bt_clone_user.iduser = '".$user."' ");
while($donnees2 = mysql_fetch_assoc($sql2))
{
	$terrain += $donnees2['terrain'] * $donnees2['nbr'];
}
query("UPDATE bt_users SET terrain = '".$terrain."' WHERE iduser =".$user);

$sql = query("SELECT 
bt_users.iduser , 
bt_users.user , 
bt_users.grade , 
bt_users.victoire , 
bt_users.defaite , 
bt_users.theme , 
bt_users.alliance , 
bt_users.level , 
bt_users.lot_commerce , 
bt_theme.nom_long AS nom_theme , 
bt_ressources.beta AS beta 
FROM bt_users 
LEFT JOIN bt_theme ON bt_users.theme = bt_theme.id
LEFT JOIN bt_ressources ON bt_users.iduser = bt_ressources.iduser
WHERE bt_users.iduser = ".$user);
$info = mysql_fetch_assoc($sql);

$_SESSION['iduser'] = $info['iduser'];
$_SESSION['user'] = $info['user'];
$_SESSION['grade'] = $info['grade'];
$_SESSION['victoire'] = $info['victoire'];
$_SESSION['defaite'] = $info['defaite'];
$_SESSION['terrain'] = $terrain ;
$_SESSION['theme'] = id2theme($info['theme']);
$_SESSION['alliance'] = id2alli($info['alliance']);
$_SESSION['level'] = $info['level'];
$_SESSION['lotcommerce'] = $info['lot_commerce'];
$_SESSION['beta'] = $info['beta'];

$template->assign_block_vars('stat',array(
        'NOM' => $info['user'],
        'GRADE' => $_SESSION['grade'],
        'VICTOIRE' => $_SESSION['victoire'],
        'DEFAITE' => $_SESSION['defaite'],
        'ALLIANCE' => $_SESSION['alliance'],
		'TERRAIN' => $_SESSION['terrain'],
        'THEME' => $info['nom_theme']
));

$template->set_filenames(array(
        'stat' => 'scripts/stat.tpl'
));
$template->assign_var_from_handle('STAT', 'stat');
?>