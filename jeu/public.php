<?
	$page = $_GET['page'];
	if ( $page == "news" OR $page == "credit" OR $page == 'list_connect' OR $page == "mdp_perdu" OR $page == "inscription" OR $page == "contact" OR $page == "presentation" OR $page == "tchat") {
		include ("textes/".$page.".php");
	}	
	else {
		if($page != '') { hack(1, 'Tente d\'ouvrir une page inexistante à l\'aide du $_GET'); }
		include ("textes/accueil.php");
	}
		include('textes/news_accueil.php');
		include("textes/connexion.php");
		include("textes/select_theme.php");
		$template->set_filenames(array(
			'body' => 'public.tpl'
		));
		$template->assign_var_from_handle('BODY', 'body');
?>