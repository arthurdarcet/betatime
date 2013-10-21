<?php
	// début code de vérification
	if(isset($_POST['inc_user']) ANd isset($_POST['inc_pass']) AND isset($_POST['passverif']) ANd isset($_POST['mail']) )
	{
		if($_POST['inc_user'] != '' AND $_POST['inc_pass'] != '' AND $_POST['passverif'] != '' AND $_POST['mail'] != '')
			{
				if($_POST['inc_pass'] == $_POST['passverif'])
				{
					$user = $_POST['inc_user'];
					$pass = $_POST['inc_pass'];
					$mail = $_POST['mail'];
					if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $mail))
					{
						$sql = query("SELECT iduser FROM bt_users WHERE user='".$user."' ");
						$compte = mysql_num_rows($sql);
						if($compte == 0)
						{
							$sql2 = query("SELECT iduser FROM bt_users WHERE mail='".$mail."' ");
							$verif_mail = mysql_num_rows($sql2);
							if($verif_mail == 0)
							{
								$headers = 'MIME-Version: 1.0\n';
								$headers .= 'Content-type: text/html\n charset=iso-8859-1\n';
								$headers .= 'From: Beta Times<nepasrepondre@betatimes.info>\n';
								$sujet = 'Inscription à Beta Times, mail à conserver .';
								$msg = '
Merci de vous être inscrit à Beta Time.	

Votre inscription a bien été validée.

Rapel de vos identifiants :
Login: '.$user.'
Password: '.$pass.'

Toute l\'équipe de Beta Times vous souhaite un excellent jeu sur www.betatimes.info';
								if(mail($mail, $sujet, $msg, $header))
								{
									include('function/autres.inc.php');
									$ip = ip();
									query("INSERT INTO bt_users VALUES ('', '".$user."', '".$pass."', '".$ip."' , '".$mail."', 1, 1, 0, 0, 0, 0, 0, 0, 0, '".time()."' , '', 0, 0);");
									$id_query = mysql_insert_id();
									$_SESSION['iduser'] = $id_query;
									query("INSERT INTO bt_ressources VALUES( '".$id_query."', 0 , 0 , 0 , 22000 , 0 , 0 , 0 , 0 , '".$now."')");
									include('sql/g1.php');
									
									redirection('msg_info.php?class=inscription&id=1');
									}else{
									redirection('msg_info.php?class=inscription&id=2');
								}
							}else{
								redirection('msg_info.php?class=inscription&id=3');
							}
						}else{
							redirection('msg_info.php?class=inscription&id=4');
						}
					}else{
						redirection('msg_info.php?class=inscription&id=5');
					}
				}else{
					redirection('msg_info.php?class=inscription&id=6');
				}
			}else{
				redirection('msg_info.php?class=divers&id=2');
			}
	}

?>