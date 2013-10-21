<?
if($_SESSION['grade'] < 2) { redirection('msg_info.php?class=divers&id=1' , 'php'); exit; }
include("scripts/commerce.php");
$sql = query("SELECT type , ajout , expire , nombre , prix_unit , id FROM bt_commerce WHERE vendeur = '".$_SESSION['iduser']."' AND statut = 'en attente' ");
while($donnees = mysql_fetch_assoc($sql))
{
	$now = time() + (3600 * 24) * 3 ;
	$prix = round($donnees['nombre'] * $donnees['prix_unit'] , 2);
	
		$template->assign_block_vars('commerce', array(
			'ICONES_RESSOURCES' => $donnees['type'],
			'NBR' => round($donnees['nombre'], 1),
			'PRIX_UNIT' => round($donnees['prix_unit'], 3),
			'PRIX_TOTAL' => $prix,
			'ID' => '<input name="id" type="hidden" value="'.$donnees['id'].'" />',
			'DATE' => data($donnees['expire'])
		));
}

$template->set_filenames(array(
	'page' => 'textes/finance/mes_ventes.tpl'
));
$template->assign_var_from_handle('PAGE', 'page');
?>