<?
query("UPDATE bt_users SET derniere_connexion='".time()."', ip='".ip()."' WHERE iduser = '".$_SESSION['iduser']."' ");
if(isset($_GET['action']) AND $_GET['action'] == 'del')
{
	query("UPDATE bt_alerte_historique SET vu = 'oui' WHERE iduser = '".$_SESSION['iduser']."' ");
	alert('Toutes les alertes ont été supprimées');
}
	include("scripts/ressources.php");
	include("scripts/stat.php");
	include('menu_gauche.php');

//historique
$sql = query("SELECT * FROM bt_alerte_historique WHERE iduser = ".$_SESSION['iduser']." AND class = 'annonce' AND vu = 'non' ");
$nbr = mysql_num_rows($sql);
if($nbr != 0) {
include('textes/annonce.php');
}else{
    if(!empty($_GET['page'])) {
        if(file_exists('textes/' . $_GET['page'] . '.php')  AND !preg_match("/(\.|config|inc)/iU", $_GET['page']) ) {
        include('textes/'.$_GET['page'].'.php');
        }else{
            hack(1, "Inclusion d\'une page qui n\'existe pas !");
        }
    }
    else
    {
        include("textes/infos_base.php");
    }
include("scripts/messagerie_alerte.php");
}    
include("scripts/objectif.php");
include("scripts/bat_unit/proto_dvpt.php");

    $template->set_filenames(array(
        'body' => 'membres.tpl'
    ));

    $template->assign_var_from_handle('BODY', 'body');

?>
