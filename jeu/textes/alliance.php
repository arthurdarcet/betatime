<?
$p = $_GET['p2'];
if(isset($_GET['p2'])) {
	$filename = 'textes/alliance/'.$p.'.php';
	if(file_exists($filename)) {
		include($filename);
	}else{
		hack('Tentative de hack par l include des alliances');
	}
}else{
	if($_SESSION['alliance'] != 'Aucune' ) {
		include("textes/alliance/info.php");
	}else{
		include("textes/alliance/liste_alliance.php");
	}
}
?>