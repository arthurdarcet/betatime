<?
if(is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	query("UPDATE bt_messagerie SET statut = 'lu' WHERE id ='".$id."' ");
	$requete = query("SELECT 
bt_users.user AS expediteur , 
bt_messagerie.date , 
bt_messagerie.titre , 
bt_messagerie.contenu 
FROM bt_messagerie 
LEFT JOIN bt_users ON bt_users.iduser = bt_messagerie.expediteur 
WHERE bt_messagerie.id ='".$id."' ");
	$donnees = mysql_fetch_assoc($requete);
	
	
	$date_j = date_j($donnees['date']);
	$h = date('H',$donnees['date']);
	$m = date('i',$donnees['date']);
	$s = date('s',$donnees['date']);
		if($date_j == "Aujourd'hui")
		{
			$template->assign_vars(array(
				'DATE' => 'Aujourd\'hui à '.$h.'h'.$m.'min'.$s.'s'
			));
		}elseif($date_j == "Hier")
		{
			$template->assign_vars(array(
				'DATE' => 'Hier à '.$h.'h'.$m.'min'.$s.'s'
			));		
		}else{
			$j = date('d',$donnees['date']);
			$mois = date('m',$donnees['date']);
			$y = date('y',$donnees['date']);
				$template->assign_vars(array(
					'DATE' => 'Le '.$j.'/'.$mois.'/'.$y.' à '.$h.'h'.$m.'min'.$s.'s'
				));	
		}
	$template->assign_vars(array(
		'TITRE' => affich_text($donnees['titre']),
		'ID' => $id,
		'EXPEDITEUR' => affich_text($donnees['expediteur']),
		'CONTENU' => affich_text($donnees['contenu'])
	));
	
	$template->set_filenames(array(
		'page' => 'textes/messagerie/lire_msg.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'page');
}else{
	hack("Id du message correspond à '".$_GET['id']."' au lieu d\'un nombre");
}
?>