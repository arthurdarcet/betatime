<?
$p = $_GET['p2'];
if(isset($_GET['p2'])) {
$filename = 'textes/finance/'.$p.'.php';
	if(file_exists($filename)) {
include('textes/finance/'.$p.'.php');
	}else{
	hack("inclusion d'une page qui n'existe pas");
	}
}else{
	include("textes/finance/commerce.php");
}
?>