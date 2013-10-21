<?
    session_start();
    /////////////si la page de maintenance existe on fait une redirection
    function microtime_float() {
    return array_sum(explode(' ', microtime()));
	}
	$debut = microtime_float();
    $nbquery = 0; // On déclare la variable qui sera incrémentée à chaque fois que la fonction query() sera appelée
	include("function/autres.inc.php");
	include("function/affich_text.inc.php");
    $popup = affich_text($_GET['popup']);
    if ( $popup != '' ) {
        $popup = '
            <script type="text/javascript">
            alert("'.$popup.'");
            </script>';
    };

    include('template.php');
    if(!isset($_SESSION['theme'])) { $_SESSION['theme'] = 'ciel'; }
    $chemin = 'templates/'.$_SESSION['theme'];
    $template = new Template($chemin);
    $template->set_filenames(array(
        'index' => 'index.tpl'
    ));
	
	include('function/_2_.inc.php');
    include("function/hack.inc.php");
	include("function/date.inc.php");
	include("function/ajouter_alerte.inc.php");
	include('scripts/connecte.php');
	include('function/attaque.inc.php');
	include('scripts/connexion.php');

    if (isset($_SESSION['iduser'])) { include("membres.php"); } else { include('public.php'); };

            $template->assign_vars(array(
            'META_TAGS' => '<title>Beta - Time | Oseras-tu affronter ton futur</title>
<meta name="description" content="Jeu en ligne gratuit dans un univers futuriste." />
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
<meta name="Classification" content="fr" />
<meta http-equiv="Content-type" content="text/html;charset=iso-8859-1" />
<meta name="location" content="France, FRANCE" />
<meta name="expires" content="never" />
<meta name="date-revision-ddmmyyyy" content="06052009" />
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

    $now = microtime_float();
    $time = round($now - $debut, 4);
	if($_SESSION['level'] == 5) {
        $template->assign_vars(array(
            'STAT_ADMIN' => '<p>Page éxécutée en '.$time.' secondes.<br />Il y a eu '.$nbquery.' requetes sur cette page.</p>'
        ));    
    }
    //mysql_close();
    $template->pparse('index', 'index');
?>