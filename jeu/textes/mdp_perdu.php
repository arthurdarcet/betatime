<?
if(isset($_POST['pseudo']) AND $_POST['pseudo'] != '')
{
$pseudo = $_POST['pseudo'];
$sql1 = query("SELECT * FROM bt_users WHERE user = '".$pseudo."' ");
$nbr = mysql_num_rows($sql1);
	if($nbr != 0 )
	{
		$info = mysql_fetch_assoc($sql1);
		
	$destinataire = $info['mail'] ;
	$objet = 'Demande du mot de passe pour le pseudo '.$info['user'].' : ';
	$message = 'Bonjour,

Suite la demande de votre mot de passe effectu�e sur le jeu Betatimes, voici vos identifiants : 

	Pseudo : '.$info['user'].'
	Mot de passe : '.$info['pass'].'

A bient�t sur Betatimes ! 
Cette e-mail vous est envoy� par un robot, veuillez ne pas y r�pondre. ' ;
	$message2 = stripslashes($message);
	$from="From: postmaster@betatimes.info";
	
	$envoi = mail($destinataire,$objet,$message,$from) ;
		if($envoi)
		{
			alert("Un e-mail contenant le mot de passe vous a �t� envoy� !");
		}else{
			alert("Une erreur s'est produite. Veuillez en parlez aux administrateurs !");
		}
	}else{
		alert("Ce pseudo n'existe pas !");
	}
}
	$template->set_filenames(array(
		'page' => 'textes/mdp_perdu.tpl'
	));
	
	$template->assign_vars(array(
			'FORM' => '<input type="text" name ="pseudo"/>'
	));
	$template->assign_var_from_handle('PAGE', 'page');
?>