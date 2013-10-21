<?
if(isset($_POST['destinataire']) AND isset($_POST['titre']) AND isset($_POST['contenu'])) 
{
    if( $_POST['destinataire'] != '' AND $_POST['contenu'] != '' ) 
    {
		if($_POST['destinataire'] != $_SESSION['user'] ) 
		{
			$sql = query("SELECT iduser FROM bt_users WHERe user = '".$_POST['destinataire']."' ");
			$nbr = mysql_num_rows($sql);
			if($nbr == 1)
			{
			$info = mysql_fetch_assoc($sql);
		        query("INSERT INTO bt_messagerie VALUES('', '".$info['iduser']."', '".$_SESSION['iduser']."' , '".$_POST['contenu']."', '".$_POST['titre']."', '".time()."', 'non lu')");
		        alert("Votre message a bien été envoyé !");
			}else{
				alert("Le pseudo n\'existe pas !");
			}
		}else{
			alert("Ca sert a quoi de s\'envoyer un message ?");
		}
    }else{
        alert("Veuillez remplir les champs !");
    }
}

if($_GET['action'] == 'del_message')
{
	if(isset($_GET['id']))
	{
		if(is_numeric($_GET['id']))
		{
			$verif = query("SELECT * FROM bt_messagerie WHERE id = '".$_GET['id']."'");
			$num = mysql_num_rows($verif);
			if($num == 1)
			{
				query("UPDATE bt_messagerie SET statut = 'del' WHERE id='".$_GET['id']."'");
				alert('Votre message a bien été supprimé !');
			}else{
				hack("L\'id dans l\'url n\'existe pas dans la bdd !");
			}
		}else{
		hack("La variable GET dans url vaut \'".$_GET['id']."\' au lieu de chiffre.");
		}
	}else{
		hack("Il n\'y a pas l\'id du message dans l\'url.");
	}
}
?>