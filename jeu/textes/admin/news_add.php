<?
if(isset($_POST['titre']) AND isset($_POST['contenu']))
{
	if($_POST['titre'] != '' AND $_POST['contenu'] != '' )
	{
		if(isset($_POST['id']))
		{
		$contenu = $_POST['contenu'];
		echo affich_text($contenu);
			//query("UPDATE bt_news SET contenu = '".$_POST['contenu']."' , titre = '".$_POST['titre']."' , edition='".time()."' , user_edition = '".$_SESSION['user']."' WHERE id = '".$_POST['id']."' ");
			alert('Votre news a été édité !!');
		}else{
			$now = time() ;
			$user = $_SESSION['user'];
			query("INSERT INTO bt_news VALUES('', '".$user."', '".$_POST['titre']."', '".$_POST['contenu']."', '".$now."', 'NULL', 'NULL')");
			alert('Votre news a correctement été envoyé!');
		}
	}else{
		alert('Veuillez remplir les champs');
	}
}
	if(isset($_GET['id']))
	{
		$sql = query("SELECT `titre`, `contenu` FROM bt_news WHERE id = '".$_GET['id']."' ");
		$info = mysql_fetch_assoc($sql);
		
		$template->assign_vars(array(
			'TITRE' =>  $info['titre'],
			'CONTENU' => $info['contenu'],
			'ID' => $_GET['id']
		));
	}
	$template->set_filenames(array(
		'page' => 'textes/admin/formulaire_news.tpl'
	));
	$template->assign_var_from_handle('PAGE', 'page');
?>