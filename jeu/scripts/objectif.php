<?php
$grade_vise = $_SESSION['grade'] + 1 ;
if($grade_vise <= 11 AND $grade_vise >= 2)
{
$sql_general = query("SELECT type , nbr , idbat FROM bt_grade WHERE grade = '".$grade_vise."' ");
$nbr_obj = mysql_num_rows($sql_general);
$nbr_obj_acc = 0;
	while($grade = mysql_fetch_assoc($sql_general))
	{
		$type = $grade['type'];
			if($type == 'victoire')
			{
				if($_SESSION['victoire'] >= $grade['nbr'])
				{
					$nbr_obj_acc += 1; 
				}
			}elseif($type == 'defaite')
			{
					if($_SESSION['defaite'] < $grade['nbr'])
					{
						$nbr_obj_acc += 1; 
					}
			}elseif($type == 'bat')
			{
			$verif = query("SELECT nbr FROM bt_bat_user WHERE iduser = '".$_SESSION['iduser']."' AND idbat = '".$grade['idbat']."' ");
			$base = mysql_fetch_assoc($verif);
				if($base['nbr'] >= $grade['nbr'])
				{
				$nbr_obj_acc += 1;
				}
			}
}
	if($nbr_obj_acc == $nbr_obj)
		{
			include('sql/g'.$grade_vise.'.php');
			query("UPDATE bt_users SET grade='".$grade_vise."' WHERE iduser='".$_SESSION['iduser']."' ");
			query("INSERT INTO bt_alerte_historique VALUES ('' , '".$_SESSION['iduser']."' , 'annonce' , 'passage en grade' , 0 , '".$grade_vise."' , '".time()."' , 'non' )");
			$_SESSION['grade'] = $grade_vise ;	
		}
}
?>