<?
	if (isset($_POST['mess'])) {
		$nbr1 = $_GET['nbr1'];
		$nbr2 = $_GET['nbr2'];
		$result = $nbr1 * $nbr2;
		if($_POST['anti-spam'] != '' AND $_POST['mess'] != '' AND $_POST['mail'] != '' AND $_POST['pseudo'] != '' AND $_POST['sujet'] != '' )
		{
			if($result == $_POST['anti-spam'])
			{
				$mess = stripslashes($_POST['mess']) ;
				$mail = stripslashes($_POST['mail']) ;
				$pseudo = stripslashes($_POST['pseudo']);
				$sujet = stripslashes($_POST['sujet']);
				$sujet2 = stripslashes($_POST['sujet2']);
				$sujetf = $sujet;
				$sujetf .= "    /    ";
				$sujetf .= $sujet2;
				$header = "From: ".$mail;
				if(mail( "postmaster@betatimes.info", $sujetf, $mess, $header ))
				{
					alert("Votre message nous a bien été envoye");
				}else{
					alert("une erreur est survenue");
				}
			}else{
				alert("Le resultat de l\'anti-spam est incorrect");
			}
		}else{
			alert("Vous devez remplir les champs !");
		}
	}

	$template->set_filenames(array(
		'contact' => 'textes/contact.tpl'
	));
	$template->assign_vars(array(
		'SESSION_USER' => $_SESSION['user'],
		'NBR1' => mt_rand(0, 5),
		'NBR2' => mt_rand(0, 3)
	));
	$template->assign_var_from_handle('PAGE', 'contact');
?>