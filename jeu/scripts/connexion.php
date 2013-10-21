<?
if((isset($_POST['user']) AND isset($_POST['pass'])) OR ( isset($_GET['user']) AND isset($_GET['pass'])))
{
if(isset($_POST['user'])) { $user = $_POST['user']; } else { $user = $_GET['user']; };
if(isset($_POST['pass'])) { $pass = $_POST['pass']; } else { $pass = $_GET['pass']; };

	if ( $user != '' OR $pass != '' ) 
	{

	$query = query("SELECT iduser , pass , actif , user , grade , theme , COUNT(*) AS nbr FROM bt_users WHERE user='".$user."' GROUP BY iduser");
	$table = mysql_fetch_array($query);
	if($table['nbr'] != 0)
	{
		if ($table['pass'] == $pass ) 
		{
			if ($table['actif'] == 0 or $table['actif'] == 2 ) 
			{
				if ($table['actif'] == 0 ) 
				{
					
					$_SESSION['iduser'] = $table['iduser'];
					$_SESSION['user'] = $table['user'];
					$_SESSION['theme'] = id2theme($table['theme']);
					$_SESSION['grade'] = $table['grade'];
					
					///////////////////pour le compteur de connecté
					$ip = $_SERVER['REMOTE_ADDR'];
					query("UPDATE bt_connectes SET session = '".$_SESSION['iduser']."' WHERE ip = '".$ip."' ");
					redirection('msg_info.php?class=membres&id=1' , 'header');
				}else{
					redirection('msg_info.php?class=membres&id=4' , 'header');
				}
			}else{
				redirection('msg_info.php?class=membres&id=3' , 'header');
			}
		}else{
			redirection('msg_info.php?class=membres&id=5' , 'header');
		}
	}else{
		redirection('msg_info.php?class=membres&id=6' , 'header');
	}
	}
	else{
		redirection('msg_info.php?class=divers&id=2' , 'header');
	}
}
?>