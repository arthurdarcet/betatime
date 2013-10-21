<?php
session_start();
include('conf/config.php');
include("function/autres.inc.php");
include('function/hack.inc.php');
include('template.php');
	if(!isset($_SESSION['theme'])) { $_SESSION['theme'] = 'ciel'; }
$chemin = 'templates/'.$_SESSION['theme'];
$template = new Template($chemin);

$template->set_filenames(array(
	'index' => 'message_informatif.tpl'
));

$template->assign_vars(array(
    'META_TAGS' => '<title>Beta - Times | Oseras-tu affronter ton futur</title>
<meta name="description" content="Jeu en ligne gratuit qui se déroule dans un univers futuriste." />
<meta name="keywords" content="jeu en ligne, gratuit, futuriste, multijoueurs" />
<meta name="dc.keywords" content="jeu en ligne, gratuit, futuriste, multijoueurs" />
<meta name="author" content="Beta - Team" />
<meta name="revisit-after" content="20 days" />
<meta name="identifier-url" content="http://www.betatimes.info" />
<meta name="reply-to" content="postmaster@betatimes.info" />
<meta name="date-creation-ddmmyyyy" content="15022006" />
<meta name="Robots" content="all" />
<meta name="Rating" content="General" />
<meta name="Generator" content="notepad++, macromedia dreamweaver 8" />
<meta name="organization" content="Beta - Team" />
<meta name="contact" content="postmaster@betatimes.info" />
<meta name="Classification" content="fr" />
<meta http-equiv="Content-type" content="text/html;charset=iso-8859-1" />
<meta name="location" content="France, FRANCE" />
<meta name="expires" content="never" />
<meta name="date-revision-ddmmyyyy" content="18112006" />
<meta name="Distribution" content="Global" />
<meta name="Audience" content="General" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/ccs" />
<!--[if !IE]><--><link rel="icon" type="image/png" href="images/favicon.png" /><!--><![endif]-->
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /><![endif]-->',
	'GOOGLE_ANALYTICS' => '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584632-1";
urchinTracker();
</script>'
        ));    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* C'est pour afficher des messages de tout genre sur le site : On les trie d'abord par la variable "class" dans l'URL. Ensuite une autre var "id" dans l'URL également.
On fait des if et dansles if des array pour les messages qu'il y a eu. */
if(isset($_GET['class']) ANd (isset($_GET['id']) or isset($_GET['msg'])))
{
	$class = $_GET['class'];
	$id = $_GET['id'];
	if($class == 'membres')
	{
	//1er essai : Le joueur se connecte : Class = membres ; id = 1
	$message = array( '' , 
		/*connection du membre*/	'Vous êtes maintenant connecté(e) sur Beta Time' ,
		/*Deconnection */		'Vous venez de vous déconnecter de Beta Times', 
		/*Compte bloqué*/		'Votre compte est bloqué, vous ne pouvez pas vous connecter !',
		/*Compte invalide*/		'Votre compte n\'est pas valide, contactez un administrateur.',
		/* Mauvais mdp */		'Le mot de passe est incorrect !',
		/*Pseudo inconnu */		'Ce pseudo n\'existe pas !');
	$cible = array( '' , 
		'index.php',
		'index.php',
		'index.php',
		'index.php',
		'index.php',
		'index.php');
	}elseif($class == 'finance'){
		$message = array('' , 
						'Vous venez de vendre une/des défaite(s) !',
						'Vous ne possedez pas assez de victoire pour vendre '.$_GET['nbr'].' défaite(s) !');
		$type = array( '' , 
					'0',
					'0');
		$cible = array( '' , 
						'index.php?page=finance&p2=vendre_defaite',
						'index.php?page=finance&p2=vendre_defaite');
	}elseif($class == 'divers'){
		$message = array('' , 
						'Vous devez être Grade 2 !',
						'Veuillez remplir les champs !');
		$cible = array( '' , 
						'index.php',
						'index.php');
	}elseif($class == 'option'){
		$message = array('' , 
						'Le changement de mot de passe a été effectué avec succès !',
						'Les deux nouveaux mots de passes ne sont pas identiques.',
						'L\'ancien mot de passe entré dans le formulaire est différent du mot de passe actuel.',
						'Veuillez remplir tous les champs',
						'Thème changé avec succès !');
		$cible = array( '' , 
						'index.php?page=options',
						'index.php?page=options',
						'index.php?page=options',
						'index.php?page=options',
						'index.php?page=options');
	}elseif($class == 'inscription'){
		$message = array('' , 
						'Merci de vous être inscrit sur Beta Times. Un e-mail contenant le rappel de vos identifiants vous a été envoyé. Vous pouvez dès maintenant vous connecter.',
						'Votre adresse mail n\'existe pas ou n\'a pas pu etre contactée par nos serveur, merci d\'en indiquer une autre',
						'Cet e-mail est déjà utilisé !',
						'Ce pseudo est déjà utilisé !',
						'L\'adresse e-amil n\'est pas valide !',
						'Les deux mots de passes sont différents !');
		$cible = array( '' , 
						'index.php',
						'index.php',
						'index.php',
						'index.php',
						'index.php');
	}elseif($class == 'vide'){
		$id = 0;
		$cible = array($_GET['page']);
		$message = array($_GET['msg']);
	}

	//En templates
		$template->assign_vars(array(
			'MESSAGE' => $message[$id]
		));
		$template->assign_block_vars('redirection', array(
			'TEMPS' => '2',
			'CIBLE' => $cible[$id]
		));
}else{
	hack(0, 'Dans la page de messages informatifs, les variables class et id n\existe pas !');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
    mysql_close();
    $template->pparse('index', 'index');
?>