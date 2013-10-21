<?
///script pour changer le mdp
if(isset($_POST['ancien_mdp']) AND isset($_POST['new_mdp']) AND isset($_POST['new_mdp2']))
{
	if($_POST['ancien_mdp'] != '' AND $_POST['new_mdp'] != '' AND $_POST['new_mdp2'] != '') 
	{
		$ancien_mdp = $_POST['ancien_mdp'];
		$new_mdp = $_POST['new_mdp'];
		$verif_mdp = $_POST['new_mdp2'];
		//verification si lancien mdp est correct, on recupere d'abord l'ancien mdp
		$requete = query("SELECT pass FROM bt_users WHERE iduser='".$_SESSION['iduser']."' ");
		$donnees = mysql_fetch_assoc($requete);
				//on verifie maintenant que le mdp entré dans le formulaire est le meme que celui de la bdd
				if($ancien_mdp == $donnees['pass'])
				{
					if($new_mdp == $verif_mdp)
					{
						query("UPDATE bt_users SET pass='".$new_mdp."' WHERE iduser='".$_SESSION['iduser']."' ");
						redirection('msg_info.php?class=option&id=1');
					} else {
						redirection('msg_info.php?class=option&id=2');
					}
				} else {
					redirection('msg_info.php?class=option&id=3');
				}
	}else{
		redirection('msg_info.php?class=option&id=4');
	}
}

	$template->set_filenames(array(
		'page' => 'textes/options.tpl'
	));
		
	$template->assign_vars(array(
				'PAGE_ACCUEIL' =>  $adresse
	));

	include('textes/select_theme.php');
	$template->assign_var_from_handle('PAGE', 'page');
?>