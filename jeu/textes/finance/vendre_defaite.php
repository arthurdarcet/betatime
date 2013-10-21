<?
if(isset($_POST['nbr_defaite']))
{
	if($_SESSION['grade'] >= 2)
	{
		if(is_numeric($_POST['nbr_defaite']))
		{
			$defaite = $_POST['nbr_defaite'];
			if($defaite <= $_SESSION['defaite'])
			{
			//Petit bug de session, je fait la recherche du nbr de victoire et du nombre de defaite
			$sql = query("SELECT defaite , victoire FROM bt_users WHERE iduser = ".$_SESSION['iduser']);
			$info = mysql_fetch_assoc($sql);
			
				$nbr_victoires = 3;
				$vict_retire = $defaite * $nbr_victoires ;

				$victoire = $info['victoire'] - $vict_retire ;
				$defaites = $info['defaite'] - $defaite ;
				if($victoire >= 0)
				{
					query("UPDATE bt_users SET victoire = ".$victoire." , defaite = ".$defaites." WHERE iduser = ".$_SESSION['iduser']." ");
					$_SESSION['defaite'] = $defaites ;
					$_SESSION['victoire'] = $victoire ;
					redirection('msg_info.php?class=finance&id=1');
				}else{
					redirection('msg_info.php?class=finance&id=2&nbr='.$defaite);
				}
			}else{
				hack(1, 'Vente de plus de défaites que l\'on possede => Modification du code HTML');
			}
		}else{
			hack(1, 'Ceci correspond au formulaires, qui normalement contient des chiffres : '.$_POST['nbr_defaite']);
		}
	}else{
		redirection('msg_info.php?class=divers&id=1');
	}
}
	$defaite = $_SESSION['defaite']; 
	$grade = $_SESSION['grade'];
	if($grade >= 2) {
		$nbr_defaite = 0 ;
		while($nbr_defaite <= $defaite) {
			$template->assign_block_vars('defaites', array(
				'NBR_DEFAITE' => $nbr_defaite
			));
			$nbr_defaite++;
		}
		$template->assign_vars(array(
			'NBR_DEFAITE' => $defaite
		));
		$template->set_filenames(array(
			'page' => 'textes/finance/vendre_defaite.tpl'
		));
	}else{
		redirection('msg_info.php?class=divers&id=1' , 'php');
	}

$template->assign_var_from_handle('PAGE', 'page');
?>