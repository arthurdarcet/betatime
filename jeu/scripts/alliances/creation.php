<?

if(isset($_POST['nom']) AND isset($_POST['type']) AND isset($_POST['site_web']) AND isset($_POST['description'])){
	if($_SESSION['alliance'] != 'Aucune'){ hack('Tentative de Creation d une alliance en étant déja dans une.'); }
	if($_SESSION['grade'] < 5){ hack('Tentative de creation d une alliance sous le grade 1 => recherche de faille'); }

	$user = $_SESSION['iduser'];
	$nom = $_POST['nom'];
	$type = $_POST['type'];
	$max_grade = $_SESSION['grade'];
	$site_web = $_POST['site_web'];
	$description = $_POST['description'];
	$total_mbr = ceil($grade * 2.5) ;
	
	if(!empty($nom) AND !empty($type) AND !empty($description))	{

		$sql = query("SELECT COUNT(*) AS nbr_nom FROM bt_alliance_list WHERE nom = '".$nom."' ");
		$nbr_nom = mysql_fetch_assoc($sql) ;
		if($nbr_nom['nbr_nom'] == 0){
			query("INSERT INTO bt_alliance_list VALUES('', '$nom', '$type', 1, '$total_mbr', $max_grade, '$user' , '".time()."' ,'$description' ,'', 2500,  '$site_web' , '$user')");
			$id = alli2id($nom);
			query("UPDATE bt_users SET alliance='$id' WHERE iduser='$user'");
			query("INSERT INTO bt_alliance_member VALUES ('', '$user', '$id', 'true', 'false', 'false', 'false', 'true')");
			$_SESSION['alliance'] = $nom ;
			header('location: index.php?page=alliance');
			echo "<script> alert('Votre alliance a été crée!');	</script>";
		}else{
			echo "<script> alert('Ce nom d'alliance existe déjà!'); </script>";
		}
	}else{
		echo "<script> alert('Veuillez remplir tous les champs demandées.'); </script>";
	}
}
echo $nom;
?>