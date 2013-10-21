<?php
//pour calculer le prix des atelier de frappe selon le grade
//By Guigui le 02/08/06
// UP By Rafale le 17/11/06

function prix_atelier($n=0) { // permet d'éviter la requete sql (pour pouvoir mettre cette fonction dans une boucle sinon il y a une requette sql dans la boucle
session_start();
//ETAPE 1 : on recupere le grade
$grade = $_SESSION['grade']; // faut plus utiliser les session sinon la bdd crève

//ETAPE 2 : on recupere le taux
	switch($grade) { // Taux(n+1)=Taux(n) + 0.002n <--- Ca c'est des math lol // les taux des grades 8 9 et 10 sont pipé sinon c'est trop haut
	
	case 1 :
	 $taux = 1.01;
	 break;

	 case 2 :
	$taux = 1.03;
	 break;
	 
	 case 3 :
	 $taux = 1.05;
	 break;
	 
	 case 4 :
	 $taux = 1.07;
	 break;

	 case 5 :
	 $taux = 1.09;
	 break;

	 case 6 :
	 $taux = 1.12;
	 break;
	 
	 case 7 :
	 $taux = 1.15;
	 break;
	 
	 case 8 :
	 $taux = 1.17;
	 break;
	 
	 case 9 :
	 $taux = 1.20;
	 break;
	 
	 case 10 :
	 $taux = 1.22;
	 break;
	 
	 case 11 :
	 $taux = 1.0;
	 break;
	
	default:
	$taux = 100; // SI il a un mauvais grade tant pis pour sa geule
	break;
	}

if ($n == 0) {
//ETAPE 3a : on recupere le nbr datelier de frappe
	$sql2 = query("SELECT `nbr` FROM bt_bat_user WHERE iduser = '".$_SESSION['iduser']."' AND idbat = '1' ");
	$infobat = mysql_fetch_assoc($sql2);
	$nbr = $infobat['nbr'];
}else{ $nbr = $n; }

//ETAPE 4 : on decide le new prix
$prix = 10000; //le prix de depart est a 10 000

$count = 0;
	while($count <= $nbr) {
		$prix *= $taux;
		$count++;
	}
return $prix;
}
?>