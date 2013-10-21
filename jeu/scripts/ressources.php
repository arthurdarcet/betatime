<?php

include("conf/config.php");
// on verifie que la personne est bien conectée
if (!isset($_SESSION['user'])) {
header("loaction: index.php?popup=Vous n'etes plus connecté.");
exit;
};

$user = $_SESSION['iduser'];
// si oui on met a jour les ressource et on les afiche

$requete_sql = query("SELECT * FROM bt_ressources WHERE iduser = '".$user."'");
$result = mysql_fetch_array($requete_sql);
$last_update = $result['last_update'];


// Initialisation des tableaux
$stockable = array(true, true, true, true, false, false , true, false); 
$ress= array('uranium', 'H2', 'eau', 'beta', 'elec' ,  'nourriture', 'O2', 'pillule');
$rev = array('uranium' => 0, 'H2' => 1, 'eau' => 2, 'beta' => 3, 'elec' => 4, 'nourriture' => 5, 'O2' => 6, 'pillule' => 7);
$conso = array(0,0,0,0,0,0,0,0);
$prod = array(0,0,0,0,0,0,0,0);
$format = array(0,0,0,0,0,0,0,0);
$diff = array(0,0,0,0,0,0,0,0);
$img = array(0,0,0,0,0,0,0,0);
$valeur = array(0,0,0,0,0,0,0,0);
for($i=0; $i < sizeof($ress); $i++) { $valeur[$i] = $result[$ress[$i]]; };


$date_actuelle = time(); 				// timestamp actuel
$temps = $date_actuelle - $last_update; //tps en seconde ecoulé depuis la derniere maj des ressources
$temps = $temps / ( 3600 * 24 );   		// on prend le tps en jour

$select = query("SELECT 
bt_bat_user.nbr , 
info_bat.* 
FROM bt_bat_user 
LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id
WHERE bt_bat_user.iduser = '".$_SESSION['iduser']."' AND bt_bat_user.nbr != 0");
while($result = mysql_fetch_assoc($select)) 
{
	$nbr = $result['nbr'];

	$conso[$rev[$result['conso1_type']]] += $result['conso1_nbr'] * $nbr;
	$conso[$rev[$result['conso2_type']]] += $result['conso2_nbr'] * $nbr;

	$prod[$rev[$result['prod1_type']]] += $result['prod1_nbr'] * $nbr;
	$prod[$rev[$result['prod2_type']]] += $result['prod2_nbr'] * $nbr;
}

/////////////////////////////////////////////
///////POUR UNITS//////////////////////////
////////////////////////////////////////////
$select2 = query("SELECT 
bt_clone_user.nbr , 
info_unit.* 
FROM bt_clone_user 
LEFT JOIN info_unit ON bt_clone_user.idunit = info_unit.id
WHERE bt_clone_user.iduser = '".$_SESSION['iduser']."' AND bt_clone_user.nbr != 0");
while($result = mysql_fetch_assoc($select2)) 
{
	$nbr = $result['nbr'];

	$conso[$rev[$result['conso1_type']]] += $result['conso1_nbr'] * $nbr;
	$conso[$rev[$result['conso2_type']]] += $result['conso2_nbr'] * $nbr;

	$prod[$rev[$result['prod1_type']]] += $result['prod1_nbr'] * $nbr;
	$prod[$rev[$result['prod2_type']]] += $result['prod2_nbr'] * $nbr;
}
$template->set_filenames(array(
		'ressources' => 'scripts/ressources.tpl'
));

$req ='';
for($i=0;$i < sizeof($ress);$i++) { // bouvle qui efectu la meme action pour toute les ligne de $ressources
	// Valeur actuelles des ressources :
	$diff[$i] = $prod[$i] - $conso[$i];

	if (!$stockable[$i]) { $valeur[$i] = $diff[$i]; }
	else { $valeur[$i] += $diff[$i] * $temps; }
	
	// Mise à jour des SESSION
	$_SESSION[$ressources[$i]] = $valeur[$i];
	$dec = 1;  // Nombre de décimales à afficher
	$format[$i] = number_format($valeur[$i], $dec, ',' ,' ');

	if($stockable[$i]){
		if( $diff[$i] >= 1 AND $diff[$i] <=  15000)		{ $img[$i] = 'niveau+1.gif'; } 
		elseif($diff[$i] >= 15000 )						{ $img[$i] = 'niveau+2.gif'; } 
		elseif($diff[$i] <= -15000 )					{ $img[$i] = 'niveau-2.gif'; } 
		elseif($diff[$i] <= -1 AND $diff[$i] >= -15000)	{ $img[$i] = 'niveau-1.gif'; }
		elseif($diff[$i] == 0)							{ $img[$i] = 'niveau-0.gif'; }
	}else{ $img[$i] = 'niveau-0.gif'; }
	$req .= $ress[$i].'='.$valeur[$i].', ';
	
	$template->assign_block_vars('ressources', array(
		'NOM_IMG'			=> $ress[$i],
		'RESSOURCE_NOM' 	=> ucfirst($ress[$i]),
		'RESSOURCE_NBR' 	=> $format[$i],
		'RESSOURCE_AUG_IMG' => $img[$i]
	));
	$template->assign_var_from_handle('RESSOURCES', 'ressources');
}

$user = $_SESSION['iduser'];
$sql = "UPDATE bt_ressources SET $req last_update=$date_actuelle WHERE iduser=$user";
query($sql);


mysql_close();
?>
